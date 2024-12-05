<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostInteraction extends Model
{

    protected $fillable = ['user_id', 'post_id', 'interaction_id'];

    protected $table = 'user_post_interactions';

    public function post(){
        return $this->belongsTo(Post::class);
    }

}
