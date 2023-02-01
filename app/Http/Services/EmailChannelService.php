<?php
namespace App\Http\Services;

use App\Models\Message;
use App\Models\User;

/* use components for email sending */

class EmailChannelService implements ChannelServiceInterface
{
    public function send(Message $model, User $user): bool{
        // Implement here
        return true;
    }
}