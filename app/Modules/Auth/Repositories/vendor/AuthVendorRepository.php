<?php

namespace Auth\Repositories\vendor;

use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use User\Models\User;

class AuthVendorRepository implements AuthVendorInterface
{


    public function loginSubmit($request, $fieldType, $field)
    {

        $user = User::where($fieldType, $field)->first();
        if ($user) {
            if ($user->hasRole('vendor')) {
                if ($user->email_verified_at != null) {
                    $credentials = [
                        $fieldType => $field,
                        'password' => $request->password
                    ];

                    if (Auth::attempt($credentials)) {
                        return true;
                    }
                    throw new Exception("Credentials does't match");
                }
                throw new Exception("Please verify your email");
            }
            throw new Exception("You donot have permission");
        }
        throw new Exception("User not found");
    }


    public function registerSubmit($request)
    {


        $user = User::where('email', $request->email)->first();
        if(!$user){
            $user = new User();

            $user->name = $request->name;
            //   if(is_numeric($request->email)){
            //     $user->phone = $request->email;
            //   }else{
            $user->email = $request->email;
            $user->email_verified_at = Carbon::now();
            //   }
            $user->password = bcrypt($request->password);
            if ($user->save()) {
                $user->assignRole('vendor');
                return $user;
            }
            throw new Exception("Something went wrong please try again later");
        }
        throw new Exception("This email has already been taken. Please try another one.");



    }
}
