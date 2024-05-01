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
}
