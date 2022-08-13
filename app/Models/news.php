<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    use HasFactory;

    function topics()
    {
        return $this->belongsTo(Topics::class, 'topic_id', 'id');
    }

    function tags()
    {
        return $this->hashMany(Tags::class, 'news_id', 'tag_id');
    }

    protected $fillable = [
        'title', 'body', 'images', 'status'
    ];
}
