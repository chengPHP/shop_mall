<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function files(){
        return $this->belongsToMany('App\Models\File');
    }
}
