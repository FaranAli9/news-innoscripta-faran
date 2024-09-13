<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedPreference extends Model
{
    protected $fillable = ['user_id', 'categories', 'authors', 'sources'];

    protected $casts = [
        'categories' => 'json',
        'authors'    => 'json',
        'sources'    => 'json',
    ];
}
