<?php

declare(strict_types = 1);

namespace App\Repositories\Users;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class DbUserRepository implements UserRepository
{
    private UserRepository $api;

    public function __construct(ApiUserRepository $api)
    {
        $this->api = $api;
    }

    public function all(): Collection
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $users = $this->api->all();

            DB::table('users')->insert($users->toArray());
        }

        return $users;
    }

    public function get(int $id)
    {
        $user = User::find($id);

        return $user ?: User::create($this->api->get($id));
    }
}