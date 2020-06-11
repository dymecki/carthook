<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', static function(Blueprint $table): void {
//            $table->id();
//            $table->bigInteger('post_id')->unsigned()->unique();
            $table->bigInteger('id')->unsigned()->primary();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('title')->index();
            $table->string('body');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
}
