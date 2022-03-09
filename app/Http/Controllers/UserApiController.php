<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\event_user;

class UserApiController extends Controller
{
    public function get_reset_password($id = null)
    {
        if($id)
        {
            return User::find($id);
        }
        return User::all();
    }

    public function post_reset_password(Request $req)
    {
        // dd($req->password);
        User::where('email' , $req->email)->update(['password'=>Hash::make($req->password)]);
        return ["status" => "Password Updated"];


    }

    public function listallevents()
    {
        $events = Event::paginate(5);
        foreach($events as $event)
        {
            $event->createdby = User::find($event->createdby);
        }
        return $events;
        
    }

    public function listeventinvitation()
    {
        $users = User::all();
        $event_userss = event_user::paginate(5)->groupby('event_id');
        foreach($event_userss as $event_users)
        {
            foreach($event_users as $event_user)
            {
                $event_user->user_id = User::find($event_user->user_id);
                
                $event_user->event_id = Event::find($event_user->event_id);
                $event_user->event_id->createdby = User::find($event_user->event_id->createdby);
            }
        }
        return $event_userss;

    }

    public function search($name = null)
    {
        if($name)
        {
            if(is_string($name))
            {
                if(User::where('name',$name)->count() > 0)
                {
                    // dd(User::all()->where('name',$name)->count());
                    $createdevents = User::where('name',$name)->get();
                    return User::where('name',$name)->get();
                }
                elseif(Event::where('name',$name)->count() > 0)
                {
                    $invitation = Event::where('name',$name)->get();
                    foreach($invitation as $invt)
                    {
                        $invt->createdby =  User::where('id', $invt->createdby)->get('name');
                    }
                    return $invitation;
                }
                else{
                    return ["Query" => "No Data Found"];
                }
            }
            else
            {

            }
        }
        return [
            "Request" => "Pass a query in search"
        ];
    }

    public function datefilter($filtertype =  null)
    {
        if($filtertype)
        {
            if(strcmp($filtertype,"new"))
            {
                return User::all()->orderBy('created_at', 'DESC');
            }
            elseif(strcmp($filtertype,"old"))
            {
                return User::all()->orderBy('created_at');
            }
            else{
                return [
                    "Filter Type" => "Invalid Filter Type"
                ];
            }
        }
        return ["Filter Type" => "Enter Filter Type New/Old"];
    }
}
