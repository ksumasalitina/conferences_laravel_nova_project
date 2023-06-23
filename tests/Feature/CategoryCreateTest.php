<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\GenerateData\CategoryTrait;
use Tests\Traits\GenerateData\UserTrait;

class CategoryCreateTest extends TestCase
{
    use CategoryTrait, UserTrait;

    public function test_category_created_successfully()
    {
        $category = self::newCategory();
        $user = self::fakeAdmin();

        $response = $this->actingAs($user)->postJson(self::URL_CREATE_CATEGORY, $category);

        $response->assertStatus(200);
        $response->assertJson(self::successMessageCategoryCreate());
    }

    public function test_not_admin_cannot_create_category()
    {
        $category = self::newCategory();
        $user = self::fakeListener();

        $response = $this->actingAs($user)->postJson(self::URL_CREATE_CATEGORY, $category);

        $response->assertStatus(403);
    }

    public function test_category_data_invalid()
    {
        $category = self::newInvalidCategory();
        $user = self::fakeAdmin();

        $response = $this->actingAs($user)->postJson(self::URL_CREATE_CATEGORY, $category);

        $response->assertStatus(422);
    }
}
