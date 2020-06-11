<?php

declare(strict_types = 1);

namespace App\Repositories\Posts;

use App\Models\Post;
use App\Models\User;
use App\Repositories\Users\ApiUserRepository;
use App\Repositories\Users\DbUserRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class DbPostRepository implements PostRepository
{
    private ApiPostRepository $postApi;
    private ApiUserRepository $userApi;
    private DbUserRepository  $users;

    public function __construct(
        ApiPostRepository $postApi,
        ApiUserRepository $userApi,
        DbUserRepository $users
    )
    {
        $this->postApi = $postApi;
        $this->userApi = $userApi;
        $this->users   = $users;
    }

    public function get(int $id): Post
    {
        $post = Post::find($id);

        if ($post) {
            return $post;
        }

        $post   = $this->postApi->get($id);
        $userId = $post['user_id'];
        $user   = $this->users->get($userId);

        if (!$user) {
            $user = $this->userApi->get($userId);

            User::create($user);
        }

        $post = Post::create($this->postApi->get($id));

        return $post;
    }

    public function byUserId(int $userId): Collection
    {
        $posts = Post::where('user_id', $userId)->get();

        if ($posts->isEmpty()) {
            $posts = $this->postApi->byUserId($userId);

            DB::table('posts')->insert($posts->toArray());
        }

        return $posts;
    }
}