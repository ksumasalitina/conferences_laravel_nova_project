<?php

namespace App\Repositories\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function addCategory(CategoryRequest $request): Category
    {
        return Category::create($request->all());
    }

    public function getCategories(): Collection
    {
        $categories = Category::where('parent_id',null)->get();
        foreach ($categories as $category){
            $category->children = $category->children;
        }
        return $categories;
    }

    public function getCategoryList(): Collection
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

    public function deleteCategory(Request $request): int
    {
        return Category::destroy($request['id']);
    }

    public function updateCategory(CategoryRequest $request, $id): int
    {
        $data = $request->only([
            'name',
            'parent_id'
        ]);

        return Category::query()->where('id', $id)->update($data);
    }
}
