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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['human_created_at'];

    /**
     * Get the created_at date in a human-readable format.
     *
     * @return string
     */
    public function getHumanCreatedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
