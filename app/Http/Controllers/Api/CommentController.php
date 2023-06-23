<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Http\Requests\CommentRequest;
use App\Traits\Export;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use Export;

    private CommentRepositoryInterface $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(CommentRequest $request)
    {
        $this->commentRepository->createComment($request);
        return response()->json([
            'message' => 'Comment added'
        ]);
    }

    public function show($id)
    {
        $comments = $this->commentRepository->getComments($id);
        return response()->json([
            'comments'=>$comments,
            'quantity'=>count($comments)]);
    }

    public function update(CommentRequest $request, $id)
    {
        $this->commentRepository->updateComment($request, $id);

        return response()->json([
            'message' => 'Comment updated'
        ]);
    }

    public function destroy($id)
    {
        $this->commentRepository->deleteComment($id);

        return response()->json([
            'message' => 'Comment deleted'
        ]);
    }

    public function export($id)
    {
        return $this->exportComments($id);
    }
}
