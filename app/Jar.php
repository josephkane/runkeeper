<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jar extends Model
{
	public function run()
	{
		return $this->belongsTo("App\Run", "run_id", "id");
	}
}
