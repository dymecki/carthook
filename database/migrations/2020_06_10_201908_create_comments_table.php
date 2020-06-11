<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', static function(Blueprint $table): void {
//            $table->id();
//            $table->bigInteger('comment_id')->unsigned()->unique();
            $table->bigInteger('id')->unsigned()->primary();
            $table->bigInteger('post_id')->unsigned()->index();
            $table->string('name');
            $table->string('email');
            $table->text('body');
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
}
