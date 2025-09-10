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
        // Category::factory(3)->create();

        Category::create([
            "category"=> "Web Development",
            "slug" => "web-development",
            "color" => "green"
        ]);

        Category::create([
            "category"=> "Mobile Development",
            "slug" => "mobile-development",
            "color" => "blue"
        ]);

        Category::create([
            "category"=> "Desktop Development",
            "slug" => "desktop-development",
            "color" => "red"
        ]);

        Category::create([
            "category"=> "Full-Stack Development",
            "slug" => "full-stack-development",
            "color" => "yellow"
        ]);
    }
}
