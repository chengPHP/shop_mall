<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attr extends Model
{
    public function color(){
        return $this->belongsTo('App\Models\Color');
    }

    public function files(){
        return $this->belongsToMany('App\Models\File');
    }

    public function good(){
        return $this->belongsToMany('App\Models\Good');
    }
}
