<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['name','logo','mobile','address','email','status','category_id'];

    protected $hidden = ['category_id'];

    public function scopeActive($query){
        return $query->where('active',1);
    }

    public function getLogoAttribute($val)
    {
        return ($val !== null) ? asset('assets/'.$val) : "";
    }

    public function category()
    {
        return $this->belongsTo('App\MainCategory', 'category_id', 'id');
    }

    public function getActive(){
        return   $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
    }
}
