<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


class Admin extends Authenticatable
{
    //

    use HasApiTokens, Notifiable;

    protected $guard = 'adapi';

   // protected $table = 'Admins';

    protected $fillable = ['name', 'email', 'password'];

}
