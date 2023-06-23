<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\GenerateData\FilterTrait;
use Tests\Traits\GenerateData\LectureTrait;
use Tests\Traits\GenerateData\MeetingTrait;
use Tests\Traits\GenerateData\UserTrait;

class FilterTest extends TestCase
{
    use UserTrait, MeetingTrait, LectureTrait, FilterTrait;

    public function test_filter_meetings()
    {
        $user = self::fakeListener();
        self::fakeMeeting();

        $response = $this->actingAs($user)->getJson(self::URL_FILTER_MEETINGS, self::meetingFilterdata());

        $response->assertStatus(200);
        $response->assertJsonStructure(self::structureApiFilterMeetings());
    }

    public function test_filter_lectures()
    {
        $user = self::fakeListener();
        self::fakeLecture();

        $response = $this->actingAs($user)->getJson(self::URL_FILTER_LECTURES, self::lectureFilterdata());

        $response->assertStatus(200);
        $response->assertJsonStructure(self::structureApiFilterLectures());
    }

    public function test_unauthorized_user_cannot_filter()
    {
        self::fakeMeeting();

        $response = $this->getJson(self::URL_FILTER_LECTURES, self::meetingFilterdata());

        $response->assertStatus(401);
    }
}
