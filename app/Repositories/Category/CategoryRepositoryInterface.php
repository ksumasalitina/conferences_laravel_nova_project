<?php

namespace App\Repositories\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface CategoryRepositoryInterface
{
    public function addCategory(CategoryRequest $request): Category;
    public function getCategoryList(): Collection;
    public function getCategories(): Collection;
    public function deleteCategory(Request $request): int;
    public function updateCategory(CategoryRequest $request, $id): int;
}
