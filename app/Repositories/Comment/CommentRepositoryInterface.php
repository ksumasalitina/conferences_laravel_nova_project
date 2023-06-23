<?php

namespace App\Repositories\Comment;

use App\Http\Requests\CommentRequest;

interface CommentRepositoryInterface
{
    public function createComment(CommentRequest $request);
    public function getComments($id);
    public function updateComment(CommentRequest $request,$id);
    public function deleteComment($id);
    public function sendNewCommentEmail($request);
}
