<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $fillable = ['translation_language','translation_of','slug','photo','active'];

    public function scopeActive($query){
        return $query->where('active',1);
    }

    public function getActive(){
        return   $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
    }

    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/'.$val) : "";
    }

    public function categories(){
        return $this->hasMany(self::class,'translation_of');
    }

    public function vendors()
    {
        return $this->hasMany('App\Vendor', 'category_id', 'id');
    }
}
