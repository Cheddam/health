<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
	public $timestamps = false;

	protected $dates = ['completed_on'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function goal()
    {
    	return $this->belongsTo('App\Goal');
    }
}
