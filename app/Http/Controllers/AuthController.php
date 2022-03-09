<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function submituser(Request $req)
    {
        // dd($req);

        $req->validate([
            'Name' => 'required',
            'Email' => 'required|email|unique:users',
            'Password' => 'required',
            'ConfirmPassword' => 'required'
        ]);
        // dd($req);
        $user = new User();
        $user->name = $req->Name;
        $user->email = $req->Email;
        $user->password = Hash::make($req->Password);
        $user->save();
         return redirect('/login');
    }
    
    public function logincheck(Request $req)
    {
        $credentials = $req->validate([
            
            'Email' => 'required|email',
            'Password' => 'required',
            
        ]);
        if (Auth::attempt(['email' => $req->Email, 'password' => $req->Password])) {
            $req->session()->regenerate();
            // Auth::login($credentials);
            return redirect('/dashboard');
        }
        else{
            return redirect()->back()->withInput();
        }
        
        
    }
}
