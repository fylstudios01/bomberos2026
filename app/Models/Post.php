<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use Lang;

class Post extends Model
{
    use HasFactory, Sluggable, SluggableScopeHelpers;

    protected $dates = ['published_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'category_id',
        'content',
        'user_id',
        'publish',
        'published_at',
        'author_name'      // ← AGREGADO ACÁ
    ];

    public function getIsPublishedAttribute()
    {
        return Lang::get('app.boolean')[$this->publish];
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function photos(){
        return $this->hasMany(PostPhoto::class, 'post_id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
