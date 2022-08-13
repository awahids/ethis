<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    function news()
    {
        return $this->belongsTo(News::class, 'news_id', 'id');
    }

    protected $fillable = [
        'name'
    ];
}
