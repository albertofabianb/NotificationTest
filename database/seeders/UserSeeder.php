<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Alan', 'email' => 'alan@gilasoftware.com', 'phone_number' => '17158899655'],
            ['name' => 'Robert', 'email' => 'robert@gilasoftware.com', 'phone_number' => '121288996550'],
            ['name' => 'Julia', 'email' => 'julia@gilasoftware.com', 'phone_number' => '331145578988']
        ];

        foreach ($users as $user_details) {
            $user = new User($user_details);
            $user->save();
        }
    }
}
