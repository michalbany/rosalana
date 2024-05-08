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

    /** @review: Tento model možná není potřeba */


    // public function collection()
    // {
    //     return $this->belongsTo(Collection::class);
    // }

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
}
