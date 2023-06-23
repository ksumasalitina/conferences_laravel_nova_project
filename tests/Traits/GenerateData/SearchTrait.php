<?php

namespace Tests\Traits\GenerateData;

trait SearchTrait
{
    protected static function structureApiSearchMeeting():array
    {
        return [
            '*' => [
                'id',
                'title'
            ]
        ];
    }

    protected static function structureApiSearchLecture():array
    {
        return [
            '*' => [
                'id',
                'theme'
            ]
        ];
    }
}
