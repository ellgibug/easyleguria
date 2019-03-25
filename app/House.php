<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
