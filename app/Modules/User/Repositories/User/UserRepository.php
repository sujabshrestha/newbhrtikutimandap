<?php

namespace User\Repositories\User;

use Carbon\Carbon;
use User\Repositories\User\UserInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tender\Models\Tender;
use Tender\Models\UserTender;
use User\Models\User;
use User\Models\BudgetUser;
use User\Models\ProcurementCategoryUser;
use User\Models\ProjectTypeUser;
use User\Models\UserProfile;

class UserRepository implements UserInterface
{


    public function store($request){

        $user = new User();
        $current_date = Carbon::now();
        $user->name = ucwords($request->name);
        $user->email = $request->email;
        $user->phone = $request->phone_no;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
    
        $user->email_verified_at = $current_date;

        $user->assignRole($request->role_name);
        if($user->save() == true){
            return true;
        }
        throw new Exception("Error While Creating User!!!");
    }

    public function update($request){
        $user = $this->getById($request->id);
        $user->name = ucwords( $request->name);
        $user->email = $request->email;
        $user->status = $request->status;
        $user->phone = $request->phone_no;
        $user->syncRoles($request->role_name);

        if($user->update() == true){
            return true;
        }
        throw new Exception("Unable To Update User!!!");
    }

    public function getById($id){
        $user = User::where('id', $id)->first();
        if(!$user){
            throw new Exception("Use Not Found User");
        }
        return $user;
    }

    public function trashedDestroy($id){
        $user = User::withTrashed()->where('id', $id)->first();
        $user->forceDelete();
        return true;
    }

    public function trashedRecover($id){
        $user = User::withTrashed()->where('id', $id)->first();
        $user->restore();
        return true;
    }

    public function getUserByAuth(){
        $auth_id = Auth()->id();
        $user = User::where('id',$auth_id)->with('userProfile')->first();
        if($user){
            return $user;
        }
        throw new Exception('Unable To Find User.');
    }

    public function changeUserPassword($request){
        $user = $this->getUserByAuth();
        $user->password = Hash::make($request->password);
        if($user->update() == true){
            return true;
        }
        throw new Exception("Unable To Change Password");
    }

    public function changeUserPasswordSubmit($request){
      
        $auth_id = Auth::id();
        $user = User::where('id',$auth_id)->first();
        if($user){
            $user->password = Hash::make($request->password);
            if($user->update() == true){
                return true;
            }
            throw new Exception('Something Went Wrong');
        }
        throw new Exception('User Not Found',404);
    }

    public function userProfileSubmit($request){
        $user = User::where('id',Auth::id())->first();
        if($user){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            if ($request->profile_image) {
                $uploaded = $this->file->storeFile($request->profile_image);
                $user->profile_image_id = $uploaded->id;
            }
            if($user->update() == true){
                return true;
            }
            throw new Exception('Something Went Wrong');
        }
        throw new Exception('User Not Found',404);
       
    }



}
