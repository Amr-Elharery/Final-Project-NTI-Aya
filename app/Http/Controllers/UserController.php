<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\User;

class UserController extends Controller
{
    public function create(){
        return view('users.create');
    }

    public function store(Request $request){
        $username = request()->username;
        $userphone = request()->userphone;
        $useremail = request()->useremail;
        $userpassword = request()->userpassword;
    

        User::create([
            'name' => $username,
            'phone' => $userphone,
            'email' => $useremail,
            'password' => bcrypt($userpassword),
        ]);

        return redirect()->route('login');//change this later, i'm just testing
    }
    
    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->route('doctors.index');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }
    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
}
