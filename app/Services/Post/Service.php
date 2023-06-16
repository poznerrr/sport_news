<?php
declare(strict_types=1);

namespace App\Services\Post;

use App\Models\Post;

class Service
{
    public function store(array $data): Post
    {
        return Post::create($data);
    }

    public function update(Post $post, array $data): void
    {
        $post->update($data);
        $post->fresh();
    }

}
