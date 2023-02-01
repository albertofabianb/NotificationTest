<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Channel;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = [
            ['channel' => 'SMS'],
            ['channel' => 'E-Mail'],
            ['channel' => 'Push Notification']
        ];

        foreach ($channels as $channels_details) {
            $channel = new Channel($channels_details);
            $channel->save();
        }
    }
}
