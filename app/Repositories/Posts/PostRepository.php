<?php

declare(strict_types = 1);

namespace App\Repositories\Posts;

use Illuminate\Support\Collection;

interface PostRepository
{
    public function byUserId(int $userId): Collection;

    public function get(int $id);
}