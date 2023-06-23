<?php

namespace App\Repositories\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function addCategory(CategoryRequest $request)
    {
        return Category::create($request->all());
    }

    public function getCategories()
    {
        $categories = Category::where('parent_id',null)->get();
        foreach ($categories as $category){
            $category->children = $category->children;
        }
        return $categories;
    }

    public function getCategoryList()
    {
        $categories = Category::all();

        foreach($categories as $category) {
            $parentPath = [];
            if($category->parent!=null){
                $parent = $category->parent;
                array_push($parentPath,$parent->name);
                while($parent->parent!=null) {
                    $parent = $parent->parent;
                    array_push($parentPath,$parent->name);
                }
            $category->parent_path = implode('->',array_reverse($parentPath));
            }
        }
        return $categories;
    }

    public function deleteCategory(Request $request)
    {
        return Category::destroy($request['id']);
    }

    public function updateCategory(CategoryRequest $request, $id)
    {
        $data = $request->only([
            'name',
            'parent_id'
        ]);

        return Category::query()->where('id', $id)->update($data);
    }
}
