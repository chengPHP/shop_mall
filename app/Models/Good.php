<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    //商品属性
    public function attr(){
        return $this->belongsToMany('App\Models\Attr');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    //商品图片
    public function files(){
        return $this->belongsToMany('App\Models\File');
    }
}
