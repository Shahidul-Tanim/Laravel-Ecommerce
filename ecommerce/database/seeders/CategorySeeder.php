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
            [
                'category' => "furniture",
                'slug' => "furniture",
                'icon' => 'demo/product/categories/furni-1.png',
            ],
            [
                'category' => "Jewelry",
                'slug' => "jewelry",
                'icon' => 'demo/product/categories/jewelry-2.png',
            ],
            [
                'category' => "Electronics",
                'slug' => "electronics",
                'icon' => 'demo/product/categories/elec-4.png',
            ]
        ];

        foreach($categories as $category){
            Category::create($category);
        }
    }
}
