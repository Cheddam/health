<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use App\Goal;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.pages.goals')
            ->with('categories', Category::with('goals')->get());
    }

    public function create()
    {
        return view('back.pages.goal')
            ->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $goal = new Goal();

        $goal->name = $request->input('name');
        $goal->points = $request->input('points');
        $goal->category_id = $request->input('category');
        $goal->weight = $request->input('weight');

        $goal->save();

        return redirect('/back/goals');
    }

    public function edit(Request $request, $id)
    {
        return view('back.pages.goal')
            ->with('goal', Goal::find($id))
            ->with('categories', Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $goal = Goal::find($id);

        $goal->name = $request->input('name');
        $goal->points = $request->input('points');
        $goal->category_id = $request->input('category');

        $goal->save();

        return redirect('/back/goals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Goal::destroy($id);

        return redirect('/back/goals');
    }
}
