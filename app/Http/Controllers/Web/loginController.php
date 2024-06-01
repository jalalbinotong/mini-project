<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class loginController extends Controller
{
    public function register()
    {
        return view('dashboard.register');
    }

    public function doneRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return redirect()->route('login')
                ->with('success', 'Create success, you can login right now!');
        } else {
            return redirect()->route('register')
                ->with('error', 'Failed to create user');
        }
    }
    
    public function login()
    {
        return view('dashboard.login');
    }

    public function doneLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            // $user = User::find(Auth::user()->id);
            // if ($user->hasRole('superadmin')){
            //     return redirect()->route('admin_table');
            // } else {
            //     return redirect()->route('product');
            // }
            
            return redirect('/');
        } else {
            return redirect()->route('login')
                ->with('error', 'Login failed username or password is incorrect');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
