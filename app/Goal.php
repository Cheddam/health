<?php

namespace App;

use App\Entry;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = ['name', 'category_id', 'points'];

    protected $appends = ['completed'];

    public $timestamps = false;

    public function category()
    {
    	return $this->hasOne('App\Category');
    }

    /**
     * @todo this is fucking gross
     */
    public function getCompletedAttribute()
    {
        if (\Auth::guest()) {
            return false;
        }

    	$entry = Entry::where('goal_id', $this->id)
    					->where('user_id', \Auth::user()->id)
    					->where('completed_on', Carbon::today())
    					->first();
    					
    	if ($entry) {
    		return true;
    	}

    	return false;
    }
}
