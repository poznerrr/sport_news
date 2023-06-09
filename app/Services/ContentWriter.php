<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Category;
use App\Models\ParsedContent;
use App\Models\Post;
use App\Models\User;

class ContentWriter
{
    private ParsedContent $parsedContent;

    public function __construct(ParsedContent $parsedContent)
    {
        $this->parsedContent = $parsedContent;
    }

    public function writeAdminBasketballNews(): void
    {
        $userId = User::where('name', 'Administrator')->first()->id;
        $categoryId = Category::where('name', 'Basketball')->first()->id;
        $post = Post::create([
            'title' => $this->parsedContent->getTitle(),
            'content' => $this->parsedContent->getText(),
            'user_id' => $userId,
            'category_id' => $categoryId,
            'image' => null
        ]);
    }

}
