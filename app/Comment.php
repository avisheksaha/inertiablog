<?php

namespace App;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function toArray()
    {
        return parent::toArray() + [
            'created_at_formated' => $this->created_at->format('M d'),
        ];
    }
    
}
