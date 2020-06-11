<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Collection;

final class PostController extends Controller
{
    public function index(): Collection
    {
        return Post::all();
    }

    public function show(Post $post): Post
    {
        return $post;
    }
}
