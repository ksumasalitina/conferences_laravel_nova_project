<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\GenerateData\CommentTrait;
use Tests\Traits\GenerateData\UserTrait;

class CommentCreateTest extends TestCase
{
    use UserTrait, CommentTrait;

    public function test_comment_created_successfully()
    {
        $user = self::fakeListener();
        $comment = self::newComment();

        $response = $this->actingAs($user)->postJson(self::URL_CREATE_COMMENT, $comment);

        $response->assertStatus(200);
        $response->assertJson(self::successMessageCreateComment());
    }

    public function test_unauthorized_user_cannot_comment()
    {
        self::fakeListener();
        $comment = self::newComment();

        $response = $this->postJson(self::URL_CREATE_COMMENT, $comment);

        $response->assertStatus(401);
    }

    public function test_comment_data_invalid()
    {
        $user = self::fakeListener();
        $comment = self::newInvalidComment();

        $response = $this->actingAs($user)->postJson(self::URL_CREATE_COMMENT, $comment);

        $response->assertStatus(422);
    }
}
