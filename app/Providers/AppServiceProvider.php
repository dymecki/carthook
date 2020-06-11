<?php

namespace App\Providers;

use App\Repositories\Comments\CommentRepository;
use App\Repositories\Comments\DbCommentRepository;
use App\Repositories\Posts\DbPostRepository;
use App\Repositories\Posts\PostRepository;
use App\Repositories\Users\DbUserRepository;
use App\Repositories\Users\UserRepository;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /** Register any application services. */
    public function register(): void
    {
        $this->app->bind(Client::class, static function(): Client {
            return new Client([
                'base_uri' => 'http://jsonplaceholder.typicode.com',
            ]);
        });

        $this->app->bind(UserRepository::class, DbUserRepository::class);
        $this->app->bind(PostRepository::class, DbPostRepository::class);
        $this->app->bind(CommentRepository::class, DbCommentRepository::class);
    }

    /** Bootstrap any application services. */
    public function boot(): void
    {

    }
}
