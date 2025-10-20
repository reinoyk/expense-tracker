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
        $categories = [
            ['name' => 'Food & Drinks', 'icon' => '🍔'],
            ['name' => 'Transportation', 'icon' => '🚗'],
            ['name' => 'Groceries', 'icon' => '🛒'],
            ['name' => 'Entertainment', 'icon' => '🎬'],
            ['name' => 'Bills & Utilities', 'icon' => '💡'],
            ['name' => 'Health', 'icon' => '💊'],
            ['name' => 'Education', 'icon' => '📚'],
            ['name' => 'Others', 'icon' => '📦'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name']], $category);
        }
    }
}

