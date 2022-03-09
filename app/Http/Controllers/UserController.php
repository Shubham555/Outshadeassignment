<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Event;
use App\Models\event_user;

class UserController extends Controller
{
    public function changepassword(Request $req)
    {
        $req->validate([
            'Password' => 'required'
        ]);
        User::where('id',Auth::id())->update([
            'password' => Hash::make($req->Password)
        ]);
        session()->flash('message','Password Has Been Change!');
        return redirect()->back();
    }

    public function opencreateevent(Request $req)
    {
        $users = User::all();
        return view('User.createevent',['users'=>$users]);
        
    }
    public function createevent(Request $req)
    {
        $req->validate([
            'Eventname' => 'required',
            'invitemem' => 'required'
        ]);
        $event = new Event();
        $event->createdby = Auth::id();
        $event->name = $req->Eventname;
        session()->flash('message','Event Has Been Created!');
        $event->save();
        $event->users()->attach($req->invitemem);
        return redirect()->back()->withInput();
    }
    public function dashboard()
    {
        $user = User::find(Auth::id());
        $invitations = $user->events;
        $allusers = User::all();
        $events = Event::where('createdby',Auth::id())->get();
        return view('User.dashboard',['events'=>$events,'invitations'=>$invitations,'allusers'=>$allusers]);
    }

    public function eventupdate($id)
    {
        $users = User::all();

        $eventdetail = Event::find($id);
        return view('User.eventupdate',['eventdetails'=>$eventdetail,'users'=>$users]);
    }

    public function updateevent(Request $req)
    {
        $req->validate([
            'Eventname' => 'required',
            'invitemem' => 'required'
        ]);

        $event = new Event();
        $event->createdby = Auth::id();
        $event->name = $req->Eventname;
        session()->flash('message','Event Has Been Updated!');
        $event->save();
        $event->users()->attach($req->invitemem);
        return redirect('/dashboard');
    }

    
}
