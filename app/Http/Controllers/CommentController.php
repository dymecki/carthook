<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Collection;

final class CommentController extends Controller
{
    public function index(): Collection
    {
        return Comment::all();
    }

    public function show(Comment $comment): Comment
    {
        return $comment;
    }
}
