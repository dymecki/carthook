<?php

declare(strict_types = 1);

namespace App\Repositories\Users;

use Illuminate\Support\Collection;

interface UserRepository
{
    public function all(): Collection;

    public function get(int $id);
}