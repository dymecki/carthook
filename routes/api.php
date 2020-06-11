<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Route;

Route::middleware('api')
    ->prefix('v1')
    ->group(static function(): void {

        Route::get('users', 'UserController@index')->name('users.index');
        Route::get('users/{user}', 'UserController@show')->name('users.show');
        Route::get('users/{user}/posts', 'UserPostsController@index')->name('user.posts');

        Route::get('posts/{posts}/comments', 'PostCommentsController@index')->name('post.comments');

    });
