<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['username','email','home_page','text','parent_id'];

    protected $casts = [
        'username' => 'string',
        'email' => 'string',
        'home_page' => 'integer',
        'text' => 'string',
        'parent_id' => 'integer',
    ];


    public function childs(): HasMany {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function files(): HasMany {
        return $this->hasMany(File::class, 'comment_id');

    }

}

