<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function photos(){
        return $this->hasMany('App\ProductPhoto');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
