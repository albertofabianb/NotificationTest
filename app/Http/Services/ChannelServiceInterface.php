<?php

namespace App\Http\Services;

use App\Models\Message;
use App\Models\User;

interface ChannelServiceInterface
{
    public function send(Message $model, User $user): bool;
}