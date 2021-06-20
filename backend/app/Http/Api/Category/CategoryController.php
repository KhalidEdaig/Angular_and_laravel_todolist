<?php

namespace App\Http\Api\Category;

use App\Enums\eRespCode;
use App\Http\Api\Category\Resources\Base\CategoryResource;
use App\Http\Api\Category\Resources\Base\CategoryResourceCollection;
use App\Http\Api\ResponseController;
use App\Http\Api\Category\CategoryService;
use App\Http\Api\Category\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class CategoryController extends ResponseController
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->resp->ok(eRespCode::CAT_LISTED_200_00, new CategoryResourceCollection($this->categoryService->getAll()));
        } catch (Throwable $th) {
            Log::info($th);
            return $this->resp->guessResponse(eRespCode::_500_INTERNAL_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            return $this->resp->created(eRespCode::CAT_CREATED_201_00, new CategoryResource($this->categoryService->persist($request)));
        } catch (Throwable $th) {
            Log::info($th);
            return $this->resp->guessResponse(eRespCode::_500_INTERNAL_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
       return $this->categoryService->find($category->id)
            ? $this->resp->created(eRespCode::CAT_GET_200_03, new CategoryResource($category))
            : $this->resp->guessResponse(eRespCode::_404_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->categoryService->update($request, $category->id)
            ? $this->resp->created(eRespCode::CAT_UPDATED_200_01, new CategoryResource($this->categoryService->update($request, $category->id)))
            : $this->resp->guessResponse(eRespCode::_500_INTERNAL_ERROR);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->categoryService->remove($category->id)
            ? $this->resp->created(eRespCode::CAT_DELETED_200_02)
            : $this->resp->guessResponse(eRespCode::_500_INTERNAL_ERROR);
    }
}
