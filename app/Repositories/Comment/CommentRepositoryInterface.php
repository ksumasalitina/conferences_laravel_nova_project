<?php

namespace App\Repositories\Comment;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

interface CommentRepositoryInterface
{
    public function createComment(CommentRequest $request): Comment;
    public function getComments($id): Collection;
    public function updateComment(CommentRequest $request,$id): int;
    public function deleteComment($id): int;
    public function sendNewCommentEmail($request): void;
}
