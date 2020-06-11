<?php

namespace App\Http\Controllers;

use App\Repositories\Users\UserRepository;
use Illuminate\Support\Collection;

final class UserController extends Controller
{
    private UserRepository $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function index(): Collection
    {
        return $this->users->all();
    }

    public function show($user)
    {
        return $this->users->get($user);
    }
}
