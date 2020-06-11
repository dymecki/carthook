<?php

declare(strict_types = 1);

namespace App\Repositories\Comments;

use Illuminate\Support\Collection;

interface CommentRepository
{
    public function byPostId(int $postId): Collection;
}