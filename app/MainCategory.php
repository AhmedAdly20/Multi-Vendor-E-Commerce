<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $fillable = ['translation_language','translation_of','slug','photo','active'];

    public function scopeActive($query){
        return $query->where('active',1);
    }
}
