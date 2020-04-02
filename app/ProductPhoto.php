<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class ProductPhoto extends Model
{
    public function product(){
        return $this->belongsTo('App\Product');
    }
    public static function boot(){
        parent::boot();
        static::deleting(function($photo){
            Storage::delete('/public/'.$photo->path);
        });
    }
}
