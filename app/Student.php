<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
	protected $table = 'students';

    protected $fillable = ['name', 'course'];

    // to get teacher belonging to a student

    public function teacher(){

        return $this->belongsTo('App\Teacher');
    }
}
