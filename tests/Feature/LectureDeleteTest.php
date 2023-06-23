<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\GenerateData\LectureTrait;
use Tests\Traits\GenerateData\UserTrait;

class LectureDeleteTest extends TestCase
{
    use UserTrait, LectureTrait;

    public function test_lecture_delete_successfully_by_announcer()
    {
        $user = self::fakeAnnouncer();
        $lecture = self::fakeLecture();

        $response = $this->actingAs($user)->deleteJson(self::URL_DELETE_LECTURE . $lecture->id);

        $response->assertStatus(200);
        $response->assertJson(self::successMessageDeleteLecture());
    }

    public function test_lecture_delete_successfully_by_admin()
    {
        $user = self::fakeAdmin();
        $lecture = self::fakeLecture();

        $response = $this->actingAs($user)->deleteJson(self::URL_DELETE_LECTURE . $lecture->id);

        $response->assertStatus(200);
        $response->assertJson(self::successMessageDeleteLecture());
    }

    public function test_unauthorized_user_cannot_delete_lecture()
    {
        self::fakeAdmin();
        $lecture = self::fakeLecture();

        $response = $this->deleteJson(self::URL_DELETE_LECTURE . $lecture->id);

        $response->assertStatus(401);
    }
}
