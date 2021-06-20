<?php

namespace App\Http\Api\Task;

use App\Enums\eRespCode;
use App\Http\Api\ResponseController;
use App\Http\Api\Task\Requests\ChangeStatusRequest;
use App\Http\Api\Task\Requests\StoreTaskRequest;
use App\Http\Api\Task\Resources\Base\TaskResource;
use App\Http\Api\Task\Resources\Base\TaskResourceCollection;
use App\Http\Api\Task\Resources\Pagination\TaskPaginationResourceCollection;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends ResponseController
{
  /**
   * The book repository instance.
   *
   * @var BookRepository
   */
  protected $taskService;

  
  public function __construct(TaskService $taskService)
  {
    parent::__construct();
    //$this->middleware('auth:api_user');
    $this->taskService = $taskService;
  }

  public function index()
  {
    return $this->resp->ok(eRespCode::T_LISTED_200_00, new TaskPaginationResourceCollection($this->taskService->getByPaginate()));
  }

 
  public function all()
  {
    return $this->resp->ok(eRespCode::T_LISTED_200_00, new TaskResourceCollection($this->taskService->getAll()));
  }

  public function filteredTasks(Request $request)
  {
    $status=$request->has('status') ? $request->status : null;
    $query=$request->has('query') ? $request->only('query') : null;
    return $this->resp->ok(eRespCode::T_LISTED_200_00, new TaskResourceCollection($this->taskService->filtered($status,$query ? $query['query'] : null)));
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreTaskRequest $request)
  {
    return $this->resp->created(eRespCode::T_CREATED_201_00, new TaskResource($this->taskService->persist($request)));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function show(Task $task)
  {
    return $this->taskService->find($task->id)
      ? $this->resp->ok(eRespCode::T_GET_200_03, new TaskResource($task))
      : $this->resp->guessResponse(eRespCode::_404_NOT_FOUND);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Task $task)
  {
    return $this->taskService->update($request, $task->id)
      ? $this->resp->ok(eRespCode::T_UPDATED_200_01, new TaskResource($this->taskService->update($request, $task->id)))
      : $this->resp->guessResponse(eRespCode::_500_INTERNAL_ERROR);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function destroy(Task $task)
  {
    return $this->taskService->remove($task->id)
      ? $this->resp->ok(eRespCode::T_DELETED_200_02)
      : $this->resp->guessResponse(eRespCode::_500_INTERNAL_ERROR);
  }

  public function changeStatus($taskId,ChangeStatusRequest $request)
  {
    Log::info($request->status);
    if ($request->status == 'Active') {
      $status = 'Done';
    } else {
      $status = 'Active';
    }
    $task= $this->taskService->updateStatus($status, $taskId);
    return $task
    ? $this->resp->ok(eRespCode::T_UPDATED_200_01, new TaskResource($task))
    : $this->resp->guessResponse(eRespCode::_500_INTERNAL_ERROR);
  }
}
