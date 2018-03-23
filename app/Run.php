<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Run extends Model
{
    public function user()
    {
    	return $this->belongsTo("App\User", "user_id", "id");
    }

    public function jars()
   	{
   		return $this->hasMany("App\Jar");
   	}
}
