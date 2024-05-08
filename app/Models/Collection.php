<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'title',
        'description',
        'share_type',
        'price',
        'contribution_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contributors()
    {
        return $this->belongsToMany(User::class, 'collection_contributors');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /** polymorfni vztahy */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }

    // public function bookmarks()
    // {
    //     return $this->morphMany(Bookmark::class, 'bookmarkable');
    // }
}
