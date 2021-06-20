<?php

namespace App\Http\Api\Task;

use App\Contracts\ReposetoryInterface;
use App\Http\Api\Task\Notifications\NotifyUsersAboutStatusTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class TaskService implements ReposetoryInterface
{

  /**
   * Get all tasks.
   *
   * @return \Illuminate\Database\Eloquent\Collection|static[]
   */
  public function getAll()
  {
    return Task::with('category')->get();
  }

    /**
   * Get all tasks.
   *
   * @return \Illuminate\Database\Eloquent\Collection|static[]
   */
  public function filtered($status=null,$query=null)
  {
    return Task::when($status,function(Builder $q) use($status){
      return $q->whereStatus($status);
    })->when($query,function(Builder $q) use($query){
      return $q->where('title','LIKE','%'.$query.'%');
    })->with('category')->get();
  }

  /**
   * Get all tasks.
   *
   * @return \Illuminate\Database\Eloquent\Collection|static[]
   */
  public function getByPaginate()
  {
    return Task::with('category')->paginate();
  }

  /**
   * Find a task by id.
   *
   * @param $id
   *
   * @return mixed
   */
  public function find($id)
  {
    return Task::with('category')->find($id);
  }


  /**
   * Create & store a new task.
   *
   * @param $request
   *
   * @return static
   */
  public function persist($request)
  {
    $params = $this->params($request);

    $task = Task::create($params);

    return $task->load('category');
  }

  /**
   * Delete a task by id.
   *
   * @param $id
   *
   * @return int
   */
  public function remove($id)
  {
    return Task::destroy($id);
  }

  /**
   * Update a task.
   *
   * @param $request
   * @param $id
   *
   * @return mixed
   */
  public function update($request, $taskId)
  {
    $params = $this->params($request);
    //$task = Task::whereId($id)->update($params);
    $task = Task::find($taskId);
    $task->update($params);
    return $task->load('category');
    //event(new TaskWasUpdated(Task::find($id)));

    return $task;
  }

  public function updateStatus($status,$taskId)
  {
    if($status==='Done'){
      Notification::send(User::whereEmail('hbusinesssquare@gmail.com')->first(), new NotifyUsersAboutStatusTask());
    }
    $task = Task::findOrFail($taskId);
    $task->status=$status;
    $task->save();
    
    return $task;
  }
  /**
   * Return only required params from request.
   *
   * @param $request
   *
   * @return mixed
   */
  private function params($request)
  {
    return Collect($request)->only('title', 'description', 'status', 'category_id')->toArray();
  }
}
