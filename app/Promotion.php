<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotion'; 
    public $timestamps = false;
    public function subcategory(){
        return $this->belongsTo('App\SubCategory','subcategory_id','id');
    }
}
