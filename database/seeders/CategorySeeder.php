<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['category' => 'Sports'],
            ['category' => 'Finance'],
            ['category' => 'Movies']
        ];

        foreach ($categories as $category_details) {
            $category = new Category($category_details);
            $category->save();
        }
    }
}
