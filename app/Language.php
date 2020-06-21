<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['abbr','locale','name','direction','active'];

    public function scopeActive($query){
        return $query->where('active',1);
    }

    public function getActive(){
        return   $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
    }
}
