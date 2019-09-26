<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(Category::class);
    }
}
