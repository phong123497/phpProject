<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    /**
     *  show form register 
     *
     * @return void
     */
    public function create(){
        return view('auth.register');
    }


    public function store(Request $request){

        //check valid
        $request->validate([
            'name'=> 'required',
            'email'=>'required|email|unique:users',
            'password' =>'required|confirmed|min:8',
        ]);

        // Db insert
        $user= User::create([
            'name' =>$request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

    Auth::login($user);
    return redirect(RouteServiceProvider::HOME);
    }

}
