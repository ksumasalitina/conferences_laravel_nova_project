<?php

namespace Tests\Traits\GenerateData;

use App\Models\Lecture;
use App\Models\Meeting;

trait LectureTrait
{
    use MeetingTrait;

    protected static function fakeLecture()
    {
        self::fakeMeeting();

        return Lecture::factory()->create();
    }

    protected static function newLecture(): array
    {
        self::fakeMeeting();

        return [
            'id' => 1,
            'user_id' => 1,
            'meeting_id' => 1,
            'slot_id' => 1,
            'theme' => 'Theme',
            'description' => 'Description',
            'presentation' => \Illuminate\Http\UploadedFile::fake()->create('test.pptx')
        ];
    }

    protected static function newInvalidLecture(): array
    {
        self::fakeMeeting();

        return [
            'user_id' => 1,
            'meeting_id' => 1,
            'slot_id' => 1,
            'theme' => '',
            'description' => 'Description',
            'presentation' => \Illuminate\Http\UploadedFile::fake()->create('test.pptx')
        ];
    }

    protected static function updateLecture()
    {
        return [
            'id' => 1,
            'user_id' => 1,
            'meeting_id' => 1,
            'slot_id' => 1,
            'theme' => 'Theme',
            'description' => 'Description',
            'presentation' => \Illuminate\Http\UploadedFile::fake()->create('test.pptx')
        ];
    }

    protected static function structureDatabaseLecture(): array
    {
        return [
            'theme' => 'Theme',
            'meeting_id' => 1,
            'slot_id' => 1
        ];
    }

    protected static function structureDatabaseUpdateLecture(): array
    {
        return [
            'theme' => 'Theme',
            'description' => 'Description'
        ];
    }

    protected static function successMessageCreateLecture(): array
    {
        return [
            'message' => 'Lecture added successfully'
        ];
    }

    protected static function successMessageUpdateLecture(): array
    {
        return [
            'message' => 'Lecture updated successfully'
        ];
    }

    protected static function successMessageDeleteLecture(): array
    {
        return [
            'message' => 'Lecture deleted successfully'
        ];
    }
}
