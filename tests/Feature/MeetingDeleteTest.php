<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\GenerateData\MeetingTrait;
use Tests\Traits\GenerateData\UserTrait;

class MeetingDeleteTest extends TestCase
{
    use MeetingTrait, UserTrait;

    public function test_admin_can_delete_meeting()
    {
        $user = self::fakeAdmin();
        $meeting = self::fakeMeeting();

        $response = $this->actingAs($user)->deleteJson(self::URL_DELETE_MEETING . $meeting->id);

        $response->assertStatus(200);
        $response->assertJson(self::successMessageDeleteMeeting());
        $this->assertDatabaseMissing('meetings', ['id' => $meeting->id]);
    }

    public function test_not_admin_cannot_delete_meeting()
    {
        $user = self::fakeAnnouncer();
        $meeting = self::fakeMeeting();

        $response = $this->actingAs($user)->deleteJson(self::URL_DELETE_MEETING . $meeting->id);

        $response->assertStatus(403);
    }

    public function test_delete_meeting_does_not_exists()
    {
        $user = self::fakeAdmin();

        $response = $this->actingAs($user)->deleteJson(self::URL_DELETE_MEETING . 10);

        $response->assertStatus(404);
    }
}
