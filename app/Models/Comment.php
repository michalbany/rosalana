<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'commentable_id',
        'commentable_type',
        'content',
        'quote',
        'mentions',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    /** polymorfni relace */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    // public function bookmarks()
    // {
    //     return $this->morphMany(Bookmark::class, 'bookmarkable');
    // }
}
