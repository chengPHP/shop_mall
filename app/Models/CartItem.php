<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    /*
     * 购物车模型
    */
    public function Member(){
        return $this->belongsTo('App\Models\Member');
    }

    public function good(){
        return $this->belongsTo('App\Models\Good');
    }

    public function attr(){
        return $this->belongsTo('App\Models\Attr');
    }
}
