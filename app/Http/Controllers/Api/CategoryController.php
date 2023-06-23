<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function add(CategoryRequest $request)
    {
        Gate::authorize('category-crud');

        $this->categoryRepository->addCategory($request);

        return response()->json([
            'message' => 'Category added'
        ]);
    }

    public function update(CategoryRequest $request, $id)
    {
        Gate::authorize('category-crud');

        $this->categoryRepository->updateCategory($request, $id);

        return response()->json([
            'message' => 'Category updated'
        ]);
    }

    public function getCategoryList()
    {
        return response()->json($this->categoryRepository->getCategoryList());
    }

    public function getCategories()
    {
        return response()->json($this->categoryRepository->getCategories());
    }

    public function deleteCategory(Request $request)
    {
        Gate::authorize('category-crud');

        $this->categoryRepository->deleteCategory($request);

        return response()->json([
            'message' => 'Category deleted'
        ]);
    }
}
