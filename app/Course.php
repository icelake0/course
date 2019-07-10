<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The users registered for a course
     * 
     * @return App\User
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
