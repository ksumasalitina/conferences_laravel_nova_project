<?php

namespace Tests\Traits\GenerateData;

use App\Models\Category;

trait CategoryTrait
{
    protected static function fakeCategory()
    {
        return Category::factory()->create();
    }

    protected static function newCategory(): array
    {
        return [
            'name' => 'New category'
        ];
    }

    protected static function newInvalidCategory(): array
    {
        return [
            'name' => ''
        ];
    }

    protected static function successMessageCategoryCreate(): array
    {
        return [
            'message' => 'Category added'
        ];
    }

    protected static function successMessageCategoryUpdate(): array
    {
        return [
            'message' => 'Category updated'
        ];
    }
}
