<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Category::count() === 0) {
            $categories = ['Basketball', 'Football', 'Boxing'];
            foreach ($categories as $category) {
                Category::create([
                    'name' => $category,
                    'created_at' => time(),
                    'updated_at' => null
                ]);
            }
        }
    }
}
