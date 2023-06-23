<?php

namespace Tests\Traits\GenerateData;

trait JoinTrait
{
    protected static function structureDatabaseJoin()
    {
        return [
            'user_id' => 1,
            'meeting_id' => 1
        ];
    }
}
