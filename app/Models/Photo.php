<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id', 'file_id', 'file_unique_id', 'file_size', 'width', 'height', 'file_path', 'local_path'
    ];
    
}
