<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'weight'];

    protected $with = ['goals'];

    public $timestamps = false;

    public function goals()
    {
    	return $this->hasMany('App\Goal');
    }
}
