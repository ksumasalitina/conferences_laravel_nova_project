<?php

namespace App\Repositories\Comment;

use App\Events\AddComment;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Lecture;
use App\Models\Meeting;
use App\Models\User;

class CommentRepository implements CommentRepositoryInterface
{

    public function createComment(CommentRequest $request)
    {
        $request['user_id'] = auth('sanctum')->id();
        $this->sendNewCommentEmail($request);

        return Comment::create($request->all());
    }

    public function getComments($id)
    {
        $comments = Comment::where('lecture_id',$id)->orderBy('created_at', 'desc')->get();
        foreach ($comments as $comment) {
            $user = User::findOrFail($comment->user_id);
            $comment->firstname = $user->first_name;
            $comment->lastname = $user->last_name;
        }
        return $comments;
    }

    public function updateComment(CommentRequest $request, $id)
    {
        $data = $request->only([
            'user_id',
            'lecture_id',
            'comment'
        ]);
        return Comment::where('id',$id)->update($data);
    }

    public function deleteComment($id)
    {
        return Comment::destroy($id);
    }

    public function sendNewCommentEmail($request)
    {
        $lecture = Lecture::findOrFail($request['lecture_id']);
        $meeting = Meeting::findOrFail($lecture->meeting_id);
        $user = User::findOrFail($request['user_id']);
        $recipient = User::findOrFail($lecture->user_id);

        event(new AddComment($meeting, $user, $lecture, $recipient->email));
    }
}
