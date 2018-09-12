<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //会员头像
    public function member_head(){
        return $this->belongsTo('App\Models\File','member_head');
    }

    public function rank(){
        return $this->belongsTo('App\Models\Rank');
    }
}
