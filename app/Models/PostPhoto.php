<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPhoto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'title',
        'path',
        'filename',
        'user_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
