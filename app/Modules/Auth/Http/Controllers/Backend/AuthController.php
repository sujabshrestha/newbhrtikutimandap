<?php

namespace Auth\Http\Controllers\Backend;

use App\GlobalServices\ResponseService;

use App\Http\Controllers\Controller;

use User\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Auth\Http\Requests\LoginRequest;
use Auth\Jobs\VerifyVendorJob;
use Auth\Mail\UserForgetPasswordMail;
use Auth\Models\PasswordReset;
use Auth\Repositories\backend\AuthInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use Files\Repositories\FileInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Vendor\Models\Booking;

class AuthController extends Controller
{
    protected $response, $file, $auth;

    public function __construct(ResponseService $response, FileInterface $file, AuthInterface $auth)
    {
        $this->response = $response;
        $this->file = $file;
        $this->auth = $auth;
    }

    public function login()
    {
        try {
            if (Auth::check()) {
                return redirect()->route('backend.dashboard');
            }
            return view('Auth::backend.login');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function loginSubmit(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if ($user) {

                if ($user->hasAnyRole(['admin'])) {

                    $credentials = [
                        'email' => $request->email,
                        'password' => $request->password,
                    ];

                    if (Auth::attempt($credentials)) {
                        Toastr::success('Successfully Logged In.');

                        return redirect()->route('backend.dashboard');
                    }
                    Toastr::error("Credentails Don't Match!!");
                    return redirect()->back()->with('error', "Something went wrong")->withInput($request->input());
                }
                Toastr::error("You Do Not Have Permission To LogIn.");
                return redirect()->back()->with('error', "You Do Not Have Permission To LogIn.")->withInput($request->input());;
            }
            Toastr::error("User Not Found.");
            return redirect()->back()->with('error', "User not found")->withInput($request->input());
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }


    public function dashboard()
    {
        try {
            $todaybookings = Booking::with(['venues',
            'vendor'])
            ->whereDate('created_at', Carbon::today())
            ->latest()
            ->take(5)
            ->get();


            return view(
                'Auth::backend.dashboard',
                compact('todaybookings')
            );
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    // public function register()
    // {
    //     try {
    //         return view('Auth::backend.register');
    //     } catch (\Exception $e) {
    //         Toastr::error($e->getMessage());
    //         return redirect()->back();
    //     }
    // }

    // public function registerSubmit(Request $request)
    // {
    //     try {
    //         $user = $this->auth->registerSubmit($request);
    //         if ($user) {
    //             $data=[
    //                 'email'=>$user->email,
    //                 'name'=>$user->name,
    //                 'phone_no'=>$user->phone_no,
    //                 'id'=>$user->id,
    //             ];
    //             $sendVerificationUserMailJob=(new VerifyVendorJob($data))
    //                                             ->delay(Carbon::now()->addSeconds(3));
    //             dispatch($sendVerificationUserMailJob);
    //             Toastr::success('Registration Success !');
    //             return redirect()->route('backend.login');
    //         }
    //         Toastr::error('Something went wrong');
    //         return redirect()->route('backend.register');
    //     } catch (\Exception $e) {
    //         Toastr::error($e->getMessage());
    //         return redirect()->back();
    //     }
    // }



    public function logout()
    {
        try {
            Auth::logout();
            Toastr::success("Successfully Logout");
            return redirect()->route('backend.login');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }


    public function forgetPassword()
    {
        try {
            return view('Auth::backend.passwordReset');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function forgetPasswordSubmit(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {

                $token = Str::random(20);


                $details = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'token' => $token,
                ];


                PasswordReset::create([
                    'email' => $user->email,
                    'token' => $token
                ]);

                $forgetpasswordmail = new UserForgetPasswordMail($details);
                Mail::to($user->email)->send($forgetpasswordmail);

                Toastr::success('A reset link has been send to your email. Please check your mail');
                return redirect()->route('backend.auth.login');
            }
            Toastr::error("User not found");
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }



    public function resetPassword($email, $token)
    {
        try {
            $passwordreset = PasswordReset::where('email', $email)
                ->where('token', $token)->first();
            $token = $passwordreset->token;
            if ($passwordreset) {
                return view('Auth::backend.passwordResetForm', compact('email', 'token'));
            }
            Toastr::error("Token doesn't match");
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }



    public function recoverPassword($email, Request $request)
    {
        try {
            $user = User::where('email', $email)->first();
            $passwordreset = PasswordReset::where('email', $email)->where('token', $request->token)->first();

            if ($user) {
                $user->password = bcrypt($request->password);
                $user->save();

                Toastr::success('Successfully Changed');
                return redirect()->route('backend.auth.login');
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }
}
