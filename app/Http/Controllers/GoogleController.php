<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function signInwithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callbackToGoogle()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = Admin::where('gauth_id', $user->id)->first();

            if($finduser){

                Auth::guard('admin')->login($finduser);

                return redirect('/dashboard');

            }else{
                $newUser = Admin::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id'=> $user->id,
                    'gauth_type'=> 'google',
                    'password' => Hash::make('password')
                ]);

                Auth::login($newUser);

                return redirect('/admin');
            }

        } catch (Exception $e) {
            dd($e->getMessage(),$e->getLine(),$e->getFile());
        }
    }
}
