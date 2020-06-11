<?php

namespace App\Http\Controllers;

use App\Repositories\Posts\PostRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Support\Collection;

final class UserPostsController extends Controller
{
    private UserRepository $users;
    private PostRepository $posts;

    public function __construct(UserRepository $users, PostRepository $posts)
    {
        $this->users = $users;
        $this->posts = $posts;
    }

    public function index(int $userId): Collection
    {
        $user = $this->users->get($userId);

        return $this->posts->byUserId($user->id);
    }
}
