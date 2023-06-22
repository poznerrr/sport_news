<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('similar_posts', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('similar_post_id');

            $table->primary(['post_id', 'similar_post_id']);

            $table->index('post_id', 'similar_posts_post_idx');
            $table->index('similar_post_id', 'similar_posts_similar_post_idx');

            $table->foreign('post_id', 'similar_posts_post_id_fk')->on('posts')->references('id');
            $table->foreign('similar_post_id', 'similar_posts_similar_post_id_fk')->on('posts')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simple_posts');
    }
};
