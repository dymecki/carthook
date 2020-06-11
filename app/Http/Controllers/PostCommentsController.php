<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Repositories\Comments\CommentRepository;
use App\Repositories\Posts\PostRepository;
use Illuminate\Support\Collection;

final class PostCommentsController extends Controller
{
    private PostRepository    $posts;
    private CommentRepository $comments;

    public function __construct(PostRepository $posts, CommentRepository $comments)
    {
        $this->posts    = $posts;
        $this->comments = $comments;
    }

    public function index(int $postId): Collection
    {
        $post = $this->posts->get($postId);

        return $this->comments->byPostId($post['id']);
    }
}
