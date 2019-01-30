<?php


namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'customer';
    public $timestamps = false;
    protected $guard = "customer";
    protected $fillable = ['email',  'password'];

    // protected $hidden = ['password',  'remember_token'];


}