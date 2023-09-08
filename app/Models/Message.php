<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    // Define os campos que podem ser preenchidos em massa
    protected $fillable = [
        'message_id', 
        'from_id', 
        'from_name', 
        'chat_id', 
        'chat_name', 
        'text', 
        'date'
    ];
}
