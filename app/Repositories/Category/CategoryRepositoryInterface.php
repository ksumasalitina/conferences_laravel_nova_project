<?php

namespace App\Repositories\Category;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

interface CategoryRepositoryInterface
{
    public function addCategory(CategoryRequest $request);
    public function getCategoryList();
    public function getCategories();
    public function deleteCategory(Request $request);
    public function updateCategory(CategoryRequest $request, $id);
}
