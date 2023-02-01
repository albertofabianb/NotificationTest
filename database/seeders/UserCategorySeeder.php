<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserCategory;
class UserCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_categories = [
            ['user_id' => '1', 'category_id' => '1'],
            ['user_id' => '1', 'category_id' => '3'],
            ['user_id' => '2', 'category_id' => '1'],
            ['user_id' => '2', 'category_id' => '2'],
            ['user_id' => '2', 'category_id' => '3'],
            ['user_id' => '3', 'category_id' => '2'],
            ['user_id' => '3', 'category_id' => '3'],
        ];

        foreach ($user_categories as $user_category_details) {
            $user_category_category = new UserCategory($user_category_details);
            $user_category_category->save();
        }
    }
}
