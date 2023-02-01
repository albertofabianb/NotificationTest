<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;
    protected $table = 'channels';
    public $timestamps = false;

    public function users(){
        return $this->belongsToMany(User::class, 'user_channel');
    }

    public function userMessage(){
        return $this->belongsToMany(UserMessage::class, 'user_message_channel');
    }
}
