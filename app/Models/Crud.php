<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'short_description',
        'long_description',
        'user_id',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
