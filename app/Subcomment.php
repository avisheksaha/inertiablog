<?php

namespace App;

use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Subcomment extends Model
{
    protected $uarded = [];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
