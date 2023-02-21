<?php

namespace User\Http\Controllers\Backend;

use App\GlobalServices\ResponseService;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use User\Http\Requests\Backend\User\CreateUserRequest;
use User\Http\Requests\Backend\User\UpdateUserRequest;
use User\Http\Requests\Backend\User\UserPasswordChangeRequest;
use User\Http\Requests\Backend\User\UserProfileUpdateRequest;
use Yajra\DataTables\Facades\DataTables;
use User\Models\User;


use User\Repositories\User\UserInterface;

class UserController extends Controller
{
    public $response;
    public $user;

    public function __construct(ResponseService $response, UserInterface $user)
    {
        $this->response = $response;
        $this->user = $user;
    }
    /**
     * Display a lsisting of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('User::backend.user.index');
    }


    public function storeUser(CreateUserRequest $request )
    {
        try {
            dd('asdjhl');
            $user = $this->user->store($request);
            if($user == true) {
                return $this->response->responseSuccessMsg('Successfully Stored!!');
            }
        } catch (Exception $e) {
            return $this->response->responseError($e->getMessage());
        }
    }

    public function edit($id){
        try{
            $user = $this->user->getByID($id);
            return view('User::backend.user.edit',compact('user'));
        }catch(Exception $e){
            return $this->response->responseError($e->getMessage());
        }
    }


    public function show($id){
        try{
            $user = User::where('id', $id)->first();;
            return view('User::backend.user.show',compact('user'));
        }catch(Exception $e){
            return $this->response->responseError($e->getMessage());
        }
    }

    public function update(UpdateUserRequest $request, $id){
        try {
            $user = $this->user->update($request, $id);
            if ($user == true) {
                return $this->response->responseSuccessMsg('Successfully Updated!!');
            }
        } catch (Exception $e) {
            return $this->response->responseError($e->getMessage());
        }
    }

    public function destroy($id){
        try{
            $user = $this->user->getByID($id);
            $userDelete= $user->delete();

            if($userDelete == true){
                return $this->response->responseSuccessMsg('Successfully Deleted');
            }
            return $this->response->responseError('Cant be Deleted');

        }catch(Exception $e){
            return $this->response->responseError($e->getMessage());
        }
    }

    public function trashedIndex(){
        return view('User::backend.user.trashedIndex');
    }

    public function trashedDestroy($id){
        try{
            $user=$this->user->trashedDestroy($id);
            if($user == true){
                return $this->response->responseSuccessMsg('Deleted Permanently');
            }
        }catch(Exception $e){
            return $this->response->responseError($e->getMessage());
        }
    }


    public function changeUserPasswordForm(){
        return view('User::backend.user.changePassword');
    }



  

    public function trashedRecover($id){
        try{
            $userRestore=$this->user->trashedRecover($id);
            if($userRestore == true){
                return $this->response->responseSuccessMsg('Successfully Restored');
            }
        }catch(Exception $e){
            return $this->response->responseError($e->getMessage());
        }
    }

    public function getUserData(Request $request){
        try {
            if ($request->ajax()) {
                $data = User::select('*');
                $data = User::whereHas('roles', function ($query) {
                    $query->whereNotIn("name", ["admin"]); 
                });

                return DataTables::of($data)
                    ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="'. route('backend.user.edit',$row->id) .'" data-id=' . $row->id . ' class="edit btn btn-info btn-sm" title="Edit"><i class="far fa-edit"></i></a>
                                <a href="javascript:void(0)" id="'. route('backend.user.destroy',$row->id) .'" data-id='.$row->id.' class="delete btn btn-danger btn-sm" title="Delete"><i class="far fa-trash-alt"></i></a>
                                <a href="'. route('backend.user.userTenderDetails',$row->id) .'" id=' . $row->id . ' class=" btn btn-secondary btn-sm" title="View Details"><i class="far fa-eye"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        } catch (Exception $e) {
            return $this->response->responseError($e->getMessage());
        }
    }

    public function getTrashedUserData(Request $request){
        try {
            if ($request->ajax()) {
                $data = User::onlyTrashed()->get();
                return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="'. route('backend.user.trashedRecover',$row->id) .'" data-id=' . $row->id . ' class="restore btn btn-success btn-sm">Restore</a>
                                <a href="javascript:void(0)" id="'. route('backend.user.trashedDestroy',$row->id) .'" data-id=' . $row->id . ' class="permanentDelete btn btn-danger btn-sm">Permanent Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
                }
        } catch (Exception $e) {
            return $this->response->responseError($e->getMessage());
        }
    }


    public function userProfile(){
        try{
            return view('User::backend.user.profile.userProfile');
        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function userProfileUpdate(UserProfileUpdateRequest $request){
       try{
            $user = $this->user->userProfileSubmit($request);
            if($user == true){
                Toastr::success('Profile Successfully Updated');
                return redirect()->back();
            }
            Toastr::error("Something Went Wrong");
            return redirect()->back();
           
        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
       

    }

    public function userPasswordUpdate(UserPasswordChangeRequest $request){
        try{
            $user = $this->user->changeUserPasswordSubmit($request);
            if($user == true){
                Toastr::success('Password Changed Successfully.');
                return redirect()->back();
            }
            Toastr::error("Something Went Wrong");
            return redirect()->back();
           
        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }
   





    // For Future Reference Only.
    // public function allWebUsers(){
    //     try{
    //         return view('User::backend.webUser.allWebUser');
    //     }catch (Exception $e) {
    //         return $this->response->responseError($e->getMessage());
    //     }
    // }


    // public function adminProfile(){
    //     $user_id = Auth()->id();
    //     $user = User::where('id',$user_id)->with('userProfile')->first();
    //     return view('User::backend.user.userProfile',compact('user'));
    // }

    // public function adminProfileUpdate(){
    //     $user_id = Auth()->id();
    //     $user = User::where('id',$user_id)->with('userProfile')->first();
    //     return view('User::backend.user.userProfileUpdate',compact('user'));
    // }

}



