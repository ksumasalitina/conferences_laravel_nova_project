<?php

namespace Tests\Traits\GenerateData;

trait FilterTrait
{
    protected static function meetingFilterdata(): array
    {
        return [
            'category' => [1,2],
            'lectures' => 1
        ];
    }

    protected static function lectureFilterdata(): array
    {
        return [
            'id' => 1,
            'start_time' => '10:00'
        ];
    }

    protected static function structureApiFilterMeetings(): array
    {
        return [
            'current_page',
            'data',
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ];
    }

    protected static function structureApiFilterLectures(): array
    {
        return [
            '*'=>[
                'id',
                'user_id',
                'meeting_id',
                'theme',
                'description',
                'presentation',
                'created_at',
                'updated_at',
                'slot_id',
                'zoom_id',
                'start',
                'end',
                'is_favorite'
        ]];
    }
}
