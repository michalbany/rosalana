<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'settings_key',
        'settings_value',
    ];

    public static function defaults()
    {
        return [
            'theme' => 'light',
            'accessibility' => 'normal', // @add: Přidáme accessibility
            'language' => 'en', // @todo: Přepíšeme aplikaci do en pravděpodobně v defaults
            'currency' => 'EUR',
            'locale' => 'en',
            'timezone' => 'UTC',
            'newsletter' => true,
            'email_notifications' => true,
            'push_notifications' => true,
        ];
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
