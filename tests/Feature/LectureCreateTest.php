<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Tests\Traits\GenerateData\LectureTrait;
use Tests\Traits\GenerateData\MeetingTrait;
use Tests\Traits\GenerateData\UserTrait;

class LectureCreateTest extends TestCase
{
    use UserTrait, LectureTrait;

    public function test_lecture_created_successfully_by_announcer()
    {
        Storage::fake('presentations');

        $user = self::fakeAnnouncer();

        $lecture = self::newLecture();

        $response = $this->actingAs($user)->postJson(self::URL_CREATE_LECTURE, $lecture);

        $response->assertStatus(200);
        $response->assertJson(self::successMessageCreateLecture());
        $this->assertDatabaseHas('lectures', self::structureDatabaseLecture());
    }

    public function test_lecture_created_successfully_by_admin()
    {
        $user = self::fakeAdmin();

        $lecture = self::newLecture();

        $response = $this->actingAs($user)->postJson(self::URL_CREATE_LECTURE, $lecture);

        $response->assertStatus(200);
        $response->assertJson(self::successMessageCreateLecture());
        $this->assertDatabaseHas('lectures', self::structureDatabaseLecture());
    }

    public function test_unauthorized_user_cannot_create_lecture()
    {
        $lecture = self::newLecture();

        $response = $this->postJson(self::URL_CREATE_LECTURE, $lecture);

        $response->assertStatus(401);
        $this->assertDatabaseMissing('lectures', self::structureDatabaseLecture());
    }

    public function test_lecture_data_is_not_valid()
    {
        $user = self::fakeAdmin();
        $lecture = self::newInvalidLecture();

        $response = $this->actingAs($user)->postJson(self::URL_CREATE_LECTURE, $lecture);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['theme']);
    }
}
