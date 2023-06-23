<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\GenerateData\LectureTrait;
use Tests\Traits\GenerateData\MeetingTrait;
use Tests\Traits\GenerateData\SearchTrait;
use Tests\Traits\GenerateData\UserTrait;

class SearchTest extends TestCase
{
    use UserTrait, MeetingTrait, LectureTrait, SearchTrait;

    public function test_meeting_search()
    {
        $user = self::fakeListener();
        $meeting = self::fakeMeeting();

        $response = $this->actingAs($user)->getJson(self::URL_SEARCH_MEETINGS, ['title' => $meeting->title]);

        $response->assertStatus(200);
        $response->assertJsonStructure(self::structureApiSearchMeeting());
    }

    public function test_lecture_search()
    {
        $user = self::fakeListener();
        $lecture = self::fakeLecture();

        $response = $this->actingAs($user)->getJson(self::URL_SEARCH_LECTURES, ['title' => $lecture->title]);

        $response->assertStatus(200);
        $response->assertJsonStructure(self::structureApiSearchLecture());
    }

    public function test_unauthorized_user_cannot_search()
    {
        $meeting = self::fakeMeeting();

        $response = $this->getJson(self::URL_SEARCH_MEETINGS, ['title' => $meeting->title]);

        $response->assertStatus(401);
    }
}
