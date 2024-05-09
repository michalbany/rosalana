<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPrivacySettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'privacy_key',
        'privacy_value',
    ];


    public static function defaults()
    {
        return [
            'profile_visibility' => 'public',
            'email_visibility' => 'public',
            'facebook_connect' => false,
            'twitter_connect' => false,
            'google_connect' => false,
            'activity_status' => true,
            'newsletter' => true,
            'email_notifications' => true,
            'push_notifications' => true,
        ];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
