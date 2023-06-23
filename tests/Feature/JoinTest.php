<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\GenerateData\JoinTrait;
use Tests\Traits\GenerateData\MeetingTrait;
use Tests\Traits\GenerateData\UserTrait;

class JoinTest extends TestCase
{
    use UserTrait, MeetingTrait, JoinTrait;

    public function test_announcer_join_successfully()
    {
        $user = self::fakeAnnouncer();
        $meeting = self::fakeMeeting();

        $response = $this->actingAs($user)->postJson(self::URL_JOIN . $meeting->id);

        $response->assertStatus(200);
        $this->assertDatabaseHas('meeting_user', self::structureDatabaseJoin());
    }

    public function test_listener_join_successfully()
    {
        $user = self::fakeListener();
        $meeting = self::fakeMeeting();

        $response = $this->actingAs($user)->postJson(self::URL_JOIN . $meeting->id);

        $response->assertStatus(200);
        $this->assertDatabaseHas('meeting_user', self::structureDatabaseJoin());
    }

    public function test_unauthenticated_user_cannot_join()
    {
        $meeting = self::fakeMeeting();

        $response = $this->postJson(self::URL_JOIN . $meeting->id);

        $response->assertStatus(401);
    }

    public function test_meeting_does_not_exist()
    {
        $user = self::fakeListener();

        $response = $this->actingAs($user)->postJson(self::URL_JOIN . 10);

        $response->assertStatus(404);
    }
}
