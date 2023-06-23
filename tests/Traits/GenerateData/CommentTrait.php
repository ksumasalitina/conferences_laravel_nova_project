<?php

namespace Tests\Traits\GenerateData;

use App\Models\Comment;

trait CommentTrait
{
    use LectureTrait;

    protected static function fakeComment()
    {
        $lecture = self::fakeLecture();

        return Comment::factory()->create([ 'lecture_id'=>$lecture->id ]);
    }

    protected static function newComment()
    {
        $lecture = self::fakeLecture();

        return [
            'lecture_id' => $lecture->id,
            'user_id' => 1,
            'comment' => 'Some comment'
        ];
    }

    protected static function newInvalidComment()
    {
        $lecture = self::fakeLecture();

        return [
            'lecture_id' => $lecture->id,
            'user_id' => 1,
            'comment' => ''
        ];
    }

    protected static function successMessageCreateComment()
    {
        return [
            'message' => 'Comment added'
        ];
    }

    protected static function successMessageDeleteComment()
    {
        return [
            'message' => 'Comment deleted'
        ];
    }
}
