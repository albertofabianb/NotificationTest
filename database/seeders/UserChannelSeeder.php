<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserChannel;

class UserChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_channels = [
            ['user_id' => '1', 'channel_id' => '1'],
            ['user_id' => '1', 'channel_id' => '3'],
            ['user_id' => '2', 'channel_id' => '1'],
            ['user_id' => '2', 'channel_id' => '2'],
            ['user_id' => '2', 'channel_id' => '3'],
            ['user_id' => '3', 'channel_id' => '2'],
            ['user_id' => '3', 'channel_id' => '3'],
        ];

        foreach ($user_channels as $user_channel_details) {
            $user_channel = new UserChannel($user_channel_details);
            $user_channel->save();
        }
    }
}
