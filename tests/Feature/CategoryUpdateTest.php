<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\GenerateData\CategoryTrait;
use Tests\Traits\GenerateData\UserTrait;

class CategoryUpdateTest extends TestCase
{
    use CategoryTrait, UserTrait;

    public function test_category_updated_successfully()
    {
        $category = self::fakeCategory();
        $user = self::fakeAdmin();

        $response = $this->actingAs($user)->putJson(self::URL_UPDATE_CATEGORY . $category->id, self::newCategory());

        $response->assertStatus(200);
        $response->assertJson(self::successMessageCategoryUpdate());
    }

    public function test_not_admin_cannot_create_category()
    {
        $category = self::fakeCategory();
        $user = self::fakeListener();

        $response = $this->actingAs($user)->putJson(self::URL_UPDATE_CATEGORY . $category->id, self::newCategory());

        $response->assertStatus(403);
    }

    public function test_category_data_invalid()
    {
        $category = self::fakeCategory();
        $user = self::fakeAdmin();

        $response = $this->actingAs($user)->putJson(self::URL_UPDATE_CATEGORY . $category->id, self::newInvalidCategory());

        $response->assertStatus(422);
    }
}
