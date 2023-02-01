<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    use HasFactory;
    protected $table = 'user_message';
    //public $timestamps = false;

    public function channels(){
        return $this->belongsToMany(Channel::class, 'user_message_channel');
    }

    public function messages(){
        return $this->belongsTo(Message::class);
    }
}
