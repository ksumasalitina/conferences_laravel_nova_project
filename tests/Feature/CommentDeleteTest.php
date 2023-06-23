<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\GenerateData\CommentTrait;
use Tests\Traits\GenerateData\UserTrait;

class CommentDeleteTest extends TestCase
{
    use UserTrait, CommentTrait;

    public function test_comment_delete_successfully_by_user()
    {
        $user = self::fakeListener();
        $comment = self::fakeComment();

        $response = $this->actingAs($user)->deleteJson(self::URL_DELETE_COMMENT . $comment->id);

        $response->assertStatus(200);
        $response->assertJson(self::successMessageDeleteComment());
    }

    public function test_comment_delete_successfully_by_admin()
    {
        $user = self::fakeAdmin();
        $comment = self::fakeComment();

        $response = $this->actingAs($user)->deleteJson(self::URL_DELETE_COMMENT . $comment->id);

        $response->assertStatus(200);
        $response->assertJson(self::successMessageDeleteComment());
    }

    public function test_unauthorized_user_cannot_delete_comment()
    {
        self::fakeListener();
        $comment = self::fakeComment();

        $response = $this->deleteJson(self::URL_DELETE_COMMENT . $comment->id);

        $response->assertStatus(401);
    }
}
