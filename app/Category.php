<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubCategory;

class Category extends Model
{
    protected $table = 'category';

    public $timestamps = false;

    public function category(){
        return $this->hasMany('App\SubCategory','idParent','id');
    }
}
