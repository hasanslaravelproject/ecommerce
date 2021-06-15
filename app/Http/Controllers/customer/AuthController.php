<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authentication(Request $request){
        $customer = User::where('email', $request->email)->where('type','customer')->first();
        if (!$customer){
            return redirect()->back()->withErrors(['failed'=> 'This is not a valid email']);
        }
    
                $credentials = $request->only('email', 'password');

                $isAuth = auth()->attempt($credentials);

                if ($isAuth) {
                    return redirect()->back()->with('success','Login Success');
                } else {
                    return redirect()->back()->withErrors(['fail' => 'Invalid Password']);
                }
           
       
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->back();
    }
}
