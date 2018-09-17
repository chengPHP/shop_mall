<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function good(){
        return $this->belongsTo('App\Models\Good');
    }
    public function attr(){
        return $this->belongsTo('App\Models\attr');
    }
}
