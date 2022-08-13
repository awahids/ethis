<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class topic extends Model
{
    use HasFactory;

    function news()
    {
        return $this->hasMany(News::class, 'topic_id', 'id');
    }

    protected $fillable = ['title'];
}
