<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';

    public function users(){
        return $this->belongsToMany(User::class, 'user_message');
    }

    public function categories(){
        return $this->belongsTo(Category::class);
    }

    public function userMessages(){
        return $this->hasMany(UserMessage::class);
    }

    protected $hidden = [
        'updated_at'
    ];
}
