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
        $request->validate([
            'username' => 'required|string|max:255',
            'userphone' => 'required|string|max:15',
            'useremail' => 'required|email|max:255|unique:users,email',
            'userpassword' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $username,
            'phone' => $userphone,
            'email' => $useremail,
            'password' => bcrypt($userpassword),
        ]);

        return redirect()->route('login');
    }
    
    public function login(Request $request){
        $credentials = $request->only('useremail', 'userpassword');
        $request->validate([
            'useremail' => 'required|email',
            'userpassword' => 'required|string|min:8',
        ]);

        if (auth()->attempt([
            'email' => $credentials['useremail'],
            'password' => $credentials['userpassword']
        ])) {
            return redirect()->route('doctors.index');
        }

        return redirect()->back()->withInput($request->only('useremail'))->withErrors(['email' => 'Invalid credentials']);
    }
    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
}
