<?php

namespace Goodwong\Category\Http\Controllers;

use Goodwong\Category\Entities\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 15);

        $query = Category::getModel();
        if ($request->vocabulary) {
            $query = $query->where('vocabulary', $request->vocabulary);
        }
        if ($request->parent_id) {
            $query = $query->where('parent_id', $request->parent_id);
        }
        if ($ids = $request->input('ids')) {
            $query = $query->whereIn('id', explode(',', $ids));
        }
        return $query->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $query = Category::getModel();
        if ($request->vocabulary) {
            $query = $query->where('vocabulary', $request->vocabulary);
        }
        if ($request->parent_id) {
            $query = $query->where('parent_id', $request->parent_id);
        }
        $exist = $query->where('name', $request->name)->first();

        // 恢复已经删除的
        if ($exist && $exist->trashed()) {
            $exist->restore();
            return $exist;
        }
        if ($exist) {
            abort(409, '不能重复创建');
        }
        // 新建
        $category = Category::create($request->all());
        $category = Category::find($category->id);
        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Goodwong\Category\Entities\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Goodwong\Category\Entities\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Goodwong\Category\Entities\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response('deleted!', 204);
    }
}
