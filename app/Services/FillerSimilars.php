<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Post;

class FillerSimilars
{
    public function fill(Post $post)
    {
        $similar = Post::whereFullText(['title', 'content'], $post->title)->where('id', '!=', $post->id)->limit(5)->get()->pluck('id');
        $post->similarPosts()->sync($similar);
        $post->fresh();
    }

}
