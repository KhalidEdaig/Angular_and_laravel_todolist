<?php

namespace App\Http\Api\Category;

use App\Contracts\ReposetoryInterface;
use App\Models\Category;

class CategoryService implements ReposetoryInterface
{

  /**
   * Get all Categories.
   *
   * @return \Illuminate\Database\Eloquent\Collection|static[]
   */
  public function getAll()
  {
    return Category::all();
  }

  /**
   * Find a Category by id.
   *
   * @param $id
   *
   * @return mixed
   */
  public function find($id)
  {
    return Category::find($id);
  }


  /**
   * Create & store a new Category.
   *
   * @param $request
   *
   * @return static
   */
  public function persist($request)
  {
    $params = $this->params($request);

    return Category::create($params);

  }

  /**
   * Delete a Category by id.
   *
   * @param $id
   *
   * @return int
   */
  public function remove($id)
  {
    return Category::destroy($id);
  }

  /**
   * Update a Category.
   *
   * @param $request
   * @param $id
   *
   * @return mixed
   */
  public function update($request, $id)
  {
    $params = $this->params($request);
    $category=Category::find($id);

    $category->update($params);

    return $category;
   
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
    return Collect($request)->only('name')->toArray();
  }
}
