<?php

namespace App\Http\Controllers;


use App\Notification;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getIndex()
    {
        $user = \Auth::user();

        $notifications = Notification::where('enabled', true)->get();

        return view('front.pages.profile')->with([
            'user' => $user,
            'notifications' => $notifications
        ])->render();
    }

    public function postIndex(Request $request)
    {
        $user = \Auth::user();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->input('sub')) {
            $user->subscriptions()->sync(array_keys($request->input('sub')));
        }

        $user->save();

        $request->session()->flash('success', 'Successfully updated profile!');
        return redirect()->back();
    }
}