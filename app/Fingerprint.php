<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fingerprint extends Model
{
    public function views(){
        return $this->hasMany('App\View');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
