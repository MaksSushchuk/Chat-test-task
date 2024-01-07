<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['comment_id','path', 'file_name'];

    protected $casts = [
        'comment_id' => 'integer',
        'path' => 'string',
        'file_name' => 'string',
    ];
    
}
