<?php

namespace Tests\Traits\GenerateData;

use App\Models\Meeting;

trait MeetingTrait
{
    protected static function fakeMeeting()
    {
        return Meeting::factory()->create();
    }

    protected static function successMessageDeleteMeeting(): array
    {
        return [
            'message' => 'Meeting deleted successfully'
        ];
    }
}
