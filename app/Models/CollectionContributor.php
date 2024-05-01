<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionContributor extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_id',
        'user_id',
        'status'
    ];
}
