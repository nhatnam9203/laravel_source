<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';
    public $timestamps = false;
    protected $guard = "admin";
    protected $fillable = ['email',  'password'];
    public $remember_token=false;


    // protected $hidden = ['password',  'remember_token'];


}