<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Shop extends Authenticatable
{
    use Notifiable;

    protected $table = 'shop';
    public $timestamps = false;
    protected $guard = "shop";
    protected $fillable = ['email',  'password'];

    // protected $hidden = ['password',  'remember_token'];


}