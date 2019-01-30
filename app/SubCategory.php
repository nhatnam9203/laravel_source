<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
class SubCategory extends Model
{
    protected $table = 'subcategory';
    public $timestamps = false;
    public function category(){
        return $this->belongsTo('App\Category','idParent','id');
    }
    public function promotion(){
        return $this->hasMany('App\Promotion','subcategory_id','id');
    }
}
