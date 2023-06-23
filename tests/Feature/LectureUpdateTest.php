<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\GenerateData\LectureTrait;
use Tests\Traits\GenerateData\MeetingTrait;
use Tests\Traits\GenerateData\UserTrait;

class LectureUpdateTest extends TestCase
{
    use UserTrait, LectureTrait;

    public function test_lecture_update_successfully_by_announcer()
    {
        $user = self::fakeAnnouncer();
        $lecture = self::fakeLecture();

        $response = $this->actingAs($user)->putJson(self::URL_UPDATE_LECTURE . $lecture->id, self::updateLecture());

        $response->assertStatus(200);
        $response->assertJson(self::successMessageUpdateLecture());
        $this->assertDatabaseHas('lectures', self::structureDatabaseUpdateLecture());
    }

    public function test_lecture_update_successfully_by_admin()
    {
        $user = self::fakeAdmin();
        $lecture = self::fakeLecture();

        $response = $this->actingAs($user)->putJson(self::URL_UPDATE_LECTURE . $lecture->id, self::updateLecture());

        $response->assertStatus(200);
        $response->assertJson(self::successMessageUpdateLecture());
        $this->assertDatabaseHas('lectures', self::structureDatabaseUpdateLecture());
    }

    public function test_unauthorized_user_cannot_update_lecture()
    {
        self::fakeListener();
        $lecture = self::fakeLecture();

        $response = $this->putJson(self::URL_UPDATE_LECTURE . $lecture->id, self::updateLecture());

        $response->assertStatus(401);
        $this->assertDatabaseMissing('lectures', self::structureDatabaseUpdateLecture());
    }
}
