<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Post::count() === 0) {
            $userId = User::where('name', 'Administrator')->get()->first()->id;
            $categoryId = Category::where('name', 'Basketball')->get()->first()->id;
            Post::create([
                'title' => 'Test title',
                'slug' => 'slug',
                'content' => 'test text',
                'category_id' => $categoryId,
                'user_id' => $userId,
                'image' => null,
                'created_at' => time(),
                'updated_at' => null
            ]);
        }
    }
}
