<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userReply_id');
            $table->unsignedBigInteger('postReply_id');
            $table->unsignedBigInteger('commentReply_id');
            $table->string('comment');
            $table->foreign('userReply_id')->references('id')->on('users');
            $table->foreign('postReply_id')->references('id')->on('posts');
            $table->foreign('commentReply_id')->references('id')->on('comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
