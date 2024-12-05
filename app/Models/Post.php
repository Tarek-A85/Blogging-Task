<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function likes()
    {
        return $this->hasMany(PostInteraction::class)->where('interaction_id',
                                                     Interaction::where('name', 'liked')->firstOrFail()->id);
    }

    public function saves()
    {
        return $this->hasMany(PostInteraction::class)->where('interaction_id',
                                                     Interaction::where('name', 'saved')->firstOrFail()->id);
    }
}
