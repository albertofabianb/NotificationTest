<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ChannelSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(UserChannelSeeder::class);
        $this->call(UserCategorySeeder::class);
    }
}
