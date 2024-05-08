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
            'connected_apps' => [
                'facebook' => false,
                'twitter' => false,
                'google' => false,
            ],
        ];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
