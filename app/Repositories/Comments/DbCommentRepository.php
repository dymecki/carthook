<?php

declare(strict_types = 1);

namespace App\Repositories\Comments;

use App\Models\Comment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class DbCommentRepository implements CommentRepository
{
    private CommentRepository $commentApi;

    public function __construct(ApiCommentRepository $api)
    {
        $this->commentApi = $api;
    }

    public function byPostId(int $postId): Collection
    {
        $comments = Comment::where('post_id', $postId)->get();

        if ($comments->isEmpty()) {
            $comments = $this->commentApi->byPostId($postId);

            DB::table('comments')->insert($comments->toArray());
        }

        return $comments;
    }

//    public function get(int $id): Comment
//    {
//        $comment = Comment::find($id);
//
//        return $comment ?: Comment::create($this->commentApi->get($id));
//    }
}