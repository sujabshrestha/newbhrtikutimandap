<?php

namespace Auth\Repositories\backend;

use Exception;
use Illuminate\Support\Facades\Auth;
use User\Models\User;

class AuthRepository implements AuthInterface
{


    public function loginSubmit($request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->email_verified_at != null) {
                return Auth::user();
            }
            throw new Exception("Please Verify your email in Mailtrap");
        }
        throw new Exception("Credentials donot match");


    }


    public function registerSubmit($request)
    {
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      if($user->save()){
        $user->assignRole('vendor');
        return true;
      }
      throw new Exception("Something went wrong");


    }



}
