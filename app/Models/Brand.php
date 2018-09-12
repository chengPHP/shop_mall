<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function get_brand_logo(){
        return $this->belongsTo('App\Models\File','brand_logo');
    }
}
