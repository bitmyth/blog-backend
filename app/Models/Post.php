<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function scopePublished($query)
    {
        return $query->where('status', 'publish');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'term_object', 'object_id', 'term_id')
            ->select(['id', 'name', 'slug', 'taxonomy'])
            ->where('terms.taxonomy', 'category');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'term_object', 'object_id', 'term_id')
            ->select(['id', 'name', 'slug', 'taxonomy'])
            ->where('terms.taxonomy', 'tag');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
