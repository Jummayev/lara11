<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'body',
        'author_id',
        'status',
        'type',
        'percentage',
        'view_count',
        'publish_at',
        'slug',
    ];
}
