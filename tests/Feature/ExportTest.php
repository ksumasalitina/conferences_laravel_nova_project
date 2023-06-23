<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\GenerateData\CommentTrait;
use Tests\Traits\GenerateData\LectureTrait;
use Tests\Traits\GenerateData\MeetingTrait;
use Tests\Traits\GenerateData\UserTrait;

class ExportTest extends TestCase
{
    use MeetingTrait, UserTrait, LectureTrait, CommentTrait;

    public function test_meetings_export_successful()
    {
        $user = self::fakeAdmin();

        $response = $this->actingAs($user)->getJson(self::URL_EXPORT_MEETINGS);

        $response->assertStatus(200);
        $response->assertDownload();
    }

    public function test_lectures_export_successful()
    {
        $user = self::fakeAdmin();
        $lecture = self::fakeLecture();

        $response = $this->actingAs($user)->getJson(self::URL_EXPORT_LECTURES . $lecture->meeting_id);

        $response->assertStatus(200);
        $response->assertDownload();
    }

    public function test_members_export_successful()
    {
        $user = self::fakeAdmin();
        $meeting = self::fakeMeeting();

        $response = $this->actingAs($user)->getJson(self::URL_EXPORT_MEMBERS . $meeting->id);

        $response->assertStatus(200);
        $response->assertDownload();
    }

    public function test_comment_export_successful()
    {
        $user = self::fakeAdmin();
        $lecture = self::fakeLecture();

        $response = $this->actingAs($user)->getJson(self::URL_EXPORT_COMMENTS . $lecture->id);

        $response->assertStatus(200);
        $response->assertDownload();
    }

    public function test_unauthorized_user_cannot_export()
    {
        $response = $this->getJson(self::URL_EXPORT_MEETINGS);

        $response->assertStatus(401);
    }
}
