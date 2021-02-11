<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Teacher extends Authenticatable
{
    //
    use HasApiTokens, Notifiable;

    protected $guard = 'teacherapi';

    protected $table = 'teachers';

    protected $fillable = ['firstName', 'lastName'];

    // get students belonging to a particular teacher

    public function student(){

        return $this->hasMany('App\Student');
    }
}
