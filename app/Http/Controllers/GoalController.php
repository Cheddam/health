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

    public function getGoals(Request $request)
    {
        return Goal::orderBy('weight', 'asc')->get();
    }

    /**
     * @todo Allow retrieving previous dates
     */
    public function getCompletedGoals(Request $request)
    {
    	return Entry::where('user_id', \Auth::user()->id)->where('completed_on', Carbon::today());
    }

    /**
     * Toggles a goal between completed and not (by adding or deleting a record)
     * @param  integer  $id      The ID of the goal to toggle.
     * @param  Request $request The request.
     * @return mixed           Either the newly created completion, or true (?)
     * @todo Make this code more concise.
     */
    public function toggleGoal($id, Request $request)
    {
        if ($entry = Entry::where('goal_id', $id)
                ->where('user_id', \Auth::user()->id)
                ->where('completed_on', Carbon::today())->first()) {
            $entry->delete();

            return json_encode('true');
        }

    	$entry = new Entry();

    	$entry->goal_id = $id; # TODO maybe use Laravel's relationships more here
    	$entry->user_id = \Auth::user()->id;
    	$entry->completed_on = Carbon::today();

    	$entry->save();

    	return $entry;
    }
}
