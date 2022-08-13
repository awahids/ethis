<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }

    protected $fillable = [
        'title', 'body', 'status', 'topic_id', 'images'
    ];
}
