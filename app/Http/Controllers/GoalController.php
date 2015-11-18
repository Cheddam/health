<?php

namespace App\Http\Controllers;

use App\Goal;
use App\Entry;
use App\Category;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GoalController extends Controller
{
	public function __construct()
	{
		// $this->middleware('auth');
	}

    public function getGoalsByCategory(Request $request)
    {
    	return Category::all();
    }

    /**
     * @todo Allow retrieving previous dates
     */
    public function getCompletedGoals(Request $request)
    {
    	return Entry::where('user_id', \Auth::user()->id)->where('completed_on', Carbon::today());
    }

    public function completeGoal($id, Request $request)
    {
    	$entry = new Entry();

    	$entry->goal_id = $id; # TODO maybe use Laravel's relationships more here
    	$entry->user_id = \Auth::user()->id;
    	$entry->completed_on = Carbon::today();

    	$entry->save();

    	return $entry;
    }
}
