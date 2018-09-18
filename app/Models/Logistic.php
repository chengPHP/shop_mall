<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logistic extends Model
{
    //商品图片
    public function order(){
        return $this->belongsToMany('App\Models\Order');
    }
}
