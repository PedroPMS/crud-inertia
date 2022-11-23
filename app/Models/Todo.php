<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'is_done',
        'user_id',
    ];

    protected $casts = [
        'is_done' => 'boolean',
        'user_id' => 'integer',
    ];
}
