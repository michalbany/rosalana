<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'avatar',
        'avatar_full',
        'avatar_original',
        'bio',
        'rank_points',
        'rank_modal_shown',
        'last_rank_shown',
        'tos_accepted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();

        $this->addMediaCollection('avatar_original')->singleFile();
   
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('compressed')
            ->performOnCollections('avatar')
            ->width(1920) // Max šířka obrázku
            ->height(1080) // Max výška obrázku
            ->sharpen(10)
            ->quality(20) // Nastavení kvality obrázku, což ovlivňuje kompresi
            ->optimize()
            ->nonQueued();

            // dd($media->getUrl());
    }

    /**
     * Elquent relationships
     */

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_user_id', 'user_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'followed_user_id');
    }

    /** polymorfni relace */

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedPosts()
    {
        return $this->morphedByMany(Post::class, 'likeable');
    }

    public function likedComments()
    {
        return $this->morphedByMany(Comment::class, 'likeable');
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function bookmarkedPosts()
    {
        return $this->morphedByMany(Post::class, 'bookmarkable');
    }

    // public function bookmarkedComments()
    // {
    //     return $this->morphedByMany(Comment::class, 'bookmarkable');
    // }

    /** settings */
    public function settings()
    {
        return $this->hasMany(UserSettings::class);
    }

    public function privacySettings()
    {
        return $this->hasMany(UserPrivacySettings::class);
    }

    public function allSettings()
    {
        return $this->hasMany(UserSettings::class)->union($this->hasMany(UserPrivacySettings::class));
    }

    public function blacklist()
    {
        return $this->hasMany(UserBlacklist::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
