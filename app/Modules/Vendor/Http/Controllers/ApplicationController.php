<?php

namespace Vendor\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Vendor\Repositories\application\ApplicationInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationStoreRequest;
use App\Models\ApplicationBookingimage;
use App\Models\CompanyregistrationApplicationimage;
use App\Models\OtherApplicationImage;
use App\Models\PanApplicationImage;
use Files\Repositories\FileInterface;
use Illuminate\Support\Facades\Auth;
use Vendor\Models\Application;
use Vendor\Models\Booking;

class ApplicationController extends Controller
{
    protected $application, $file;
    public function __construct(ApplicationInterface $application, FileInterface $file)
    {
        $this->application = $application;
        $this->file = $file;
    }

    public function application($id, $notificationid = null)
    {
        try {
            $booking = Booking::where('id', $id)->first();
            return view('Vendor::frontend.vendor.application', compact('booking', 'notificationid'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }


    public function applicationStore(ApplicationStoreRequest $request)
    {
        try {

            $application =  Application::updateOrCreate([
                'booking_id' => $request->booking_id
            ], [
               'name' => $request->name ?? auth()->user()->name,
               'contact' => $request->contact ?? auth()->user()->phone,
                'type' => $request->application_type
            ]);

            // $application = new Application();
            // $application->booking_id = $request->booking_id;
            // $application->name = $request->name;
            // $application->contact = $request->contact;
            // $application->save();

            if($request->applicationImages){
                foreach($request->applicationImages as $uploadfile){
                    $applicationbookingfiles = new ApplicationBookingimage();
                    $applicationbookingfiles->booking_id = $application->booking_id;
                    $uploaded = $this->file->storeFile($uploadfile);
                    $applicationbookingfiles->file_id = $uploaded->id;
                    $applicationbookingfiles->application_id = $application->id;
                    $applicationbookingfiles->save();
                }
            }


            if($request->otherImages){
                foreach($request->otherImages as $uploadfile){
                    $applicationbookingfiles = new OtherApplicationImage();
                    $applicationbookingfiles->booking_id = $application->booking_id;
                    $uploaded = $this->file->storeFile($uploadfile);
                    $applicationbookingfiles->file_id = $uploaded->id;
                    $applicationbookingfiles->application_id = $application->id;
                    $applicationbookingfiles->save();
                }
            }


            if($request->panNumberImages){
                foreach($request->panNumberImages as $uploadfile){
                    $applicationbookingfiles = new PanApplicationImage();
                    $applicationbookingfiles->booking_id = $application->booking_id;
                    $uploaded = $this->file->storeFile($uploadfile);
                    $applicationbookingfiles->file_id = $uploaded->id;
                    $applicationbookingfiles->application_id = $application->id;
                    $applicationbookingfiles->save();
                }
            }

            if($request->companyRegistrationImages){
                foreach($request->companyRegistrationImages as $uploadfile){
                    $applicationbookingfiles = new CompanyregistrationApplicationimage();
                    $applicationbookingfiles->booking_id = $application->booking_id;
                    $uploaded = $this->file->storeFile($uploadfile);
                    $applicationbookingfiles->file_id = $uploaded->id;
                    $applicationbookingfiles->application_id = $application->id;
                    $applicationbookingfiles->save();
                }
            }


            $notification = auth()->user()->unreadNotifications->where('id', $request->notification_id)->markAsRead();
            Toastr::success("Successfully Saved");
            return view('Vendor::frontend.vendor.applicationVerified');



            // if ($request->uploadfiles) {
            //     foreach($request->uploadfiles as $uploadfile){
            //         $applicationbookingfiles = new ApplicationBookingimage();
            //         $applicationbookingfiles->booking_id = $application->booking_id;
            //         $uploaded = $this->file->storeFile($uploadfile);
            //         $applicationbookingfiles->file_id = $uploaded->id;
            //         $applicationbookingfiles->application_id = $application->id;
            //         $applicationbookingfiles->save();
            //     }

            //     if($request->notification_id != null){

            //     }
            //     $notification = auth()->user()->unreadNotifications->where('id', $request->notification_id)->markAsRead();
            //     Toastr::success("Successfully Saved");
            //     return view('Vendor::frontend.vendor.applicationVerified');

            // }

        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function proceedToPayment($id, $notificationid){
        try {
            $booking = Booking::where('id', $id)->with(['venues', 'applications'])->withSum('venues','price')->first();

            return view('Vendor::frontend.vendor.payment', compact('booking', 'notificationid'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }


}
