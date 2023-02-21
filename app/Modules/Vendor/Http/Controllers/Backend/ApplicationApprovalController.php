<?php

namespace Vendor\Http\Controllers\Backend;

use App\GlobalServices\ResponseService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplicationNotification;
use App\Models\PaymentNotification;
use App\Notifications\ApplicationSendNotification;
use App\Notifications\ApplicationVerifiedNotification;
use App\Notifications\PaymentSendNotification;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use User\Models\User;
use Vendor\Models\Booking;
use Venue\Models\Venue;

class ApplicationApprovalController extends Controller
{

    protected $response;
    public function __construct(ResponseService $response)
    {
        $this->response = $response;
    }


    public function approvalLists(){
        try{
            $bookinglists = Booking::with(['venues', 'applications'])->latest()->paginate(10);
            return view('Vendor::backend.approvalLists', compact('bookinglists'));
        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }


    public function changeStatus($id, Request $request){
        // try{

            if($request->ajax()){


                $booking = Booking::where('id', $id)->with('venues')->first();
                if($booking){
                    $user = User::where('id', $booking->vendor_id)->first();
                    $booking->status = $request->status;

                    if($request->status == "Cancelled"){
                        foreach($booking->venues as $venue){
                            $venue = Venue::where('id', $venue->id)->first();
                            $venue->status = "Available";
                            $venue->update();
                        }
                    }

                    if($booking->update()){

                        $details= [
                            'booking_id' => $booking->id,
                            'status' => $booking->status,
                            'from_date' => $booking->from_date,
                            'end_date' => $booking->end_date,
                            'type' => 'application'
                          ];

                          if($booking->status == "Approved" || $booking->status == "Declined"){
                              Notification::send($user, new ApplicationVerifiedNotification($details));
                          }

                         return $this->response->responseSuccessMsg("Successfully updated");
                    }
                    return $this->response->responseError("Something went wrong");
                }
            }

        // }catch(\Exception $e){
        //     $this->response->responseError($e->getMessage());
        // }
    }








    public function paymentChangeStatus($id, Request $request){
        // try{

            if($request->ajax()){


                $booking = Booking::where('id', $id)->with('venues')->first();
                if($booking){
                    $user = User::where('id', $booking->vendor_id)->first();
                    $booking->payment_status = $request->status;

                    if($request->status == "Cancelled"){
                        foreach($booking->venues as $venue){
                            $venue = Venue::where('id', $venue->id)->first();
                            $venue->status = "Available";
                            $venue->update();
                        }
                    }
                    if($booking->update()){

                        $details= [
                            'booking_id' => $booking->id,
                            'status' => $booking->status,
                            'from_date' => $booking->from_date,
                            'end_date' => $booking->end_date,
                            'type' => 'payment'
                          ];

                          if($booking->payment_status == "Approved" || $booking->payment_status == "Declined"){
                            Notification::send($user, new ApplicationVerifiedNotification($details));
                        }

                         return $this->response->responseSuccessMsg("Successfully updated");
                    }
                    return $this->response->responseError("Something went wrong");
                }
            }

        // }catch(\Exception $e){
        //     $this->response->responseError($e->getMessage());
        // }
    }



    public function changeVenueStatus($id, Request $request){
        // try{
            if($request->ajax()){


                $venue = Venue::where('id', $id)->first();
                if($venue){
                    $venue->status = $request->status;
                    if($venue->update()){
                        return $this->response->responseSuccessMsg("Successfully updated");

                    }
                    return $this->response->responseError("Something went wrong");


                }
            }

        // }catch(\Exception $e){
        //     $this->response->responseError($e->getMessage());
        // }
    }



    public function view($id, Request $request){
        // try{

            $booking =Booking::where('id', $id)->with(['venues', 'applications', 'payments'])->first();
            $data = [
                'view' => view('Vendor::backend.appendViewPayments', compact('booking'))->render()
            ];
            return $this->response->responseSuccess($data, "Success", 200);

        // }catch(\Exception $e){
        //     $this->response->responseError($e->getMessage());
        // }
    }



    public function sendApplicationNotification($id, $bookingid, Request $request){
        try{


            $vendor = User::where('id', $id)->first();
            $booking = Booking::where('id', $bookingid)->first();
            $data = [
                'view' => view('Vendor::backend.appendApplicationMessage', compact('vendor', 'booking'))->render()
            ];
            return $this->response->responseSuccess($data, "Success", 200);

        }catch(\Exception $e){
            $this->response->responseError($e->getMessage());
        }
    }


    public function submitApplicationNotification($id, Request $request){
        try{

            $vendor = User::where('id', $id)->first();

            $applicationnotification = new ApplicationNotification();
            $applicationnotification->send_user = $vendor->id;
            $applicationnotification->from_user = auth()->user()->id;
            $applicationnotification->message = $request->message;
            if($applicationnotification->save()){
                $details = [
                    'message' => $request->message,
                    'booking_id' => $request->booking_id,
                ];
                Notification::send($vendor, new ApplicationSendNotification($details));
            };


            Toastr::success("Successfully Sent");
            return redirect()->back();

        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }





    public function sendPaymentNotification($id, $bookingid, Request $request){
        try{


            $vendor = User::where('id', $id)->first();
            $booking = Booking::where('id', $bookingid)->first();
            $data = [
                'view' => view('Vendor::backend.appendPaymentMessage', compact('vendor', 'booking'))->render()
            ];
            return $this->response->responseSuccess($data, "Success", 200);

        }catch(\Exception $e){
            $this->response->responseError($e->getMessage());
        }
    }


    public function submitPaymentNotification($id, Request $request){
        try{

            $vendor = User::where('id', $id)->first();

            $paymentnotification = new PaymentNotification();
            $paymentnotification->send_user = $vendor->id;
            $paymentnotification->from_user = auth()->user()->id;
            $paymentnotification->message = $request->message;
            if($paymentnotification->save()){
                $details = [
                    'message' => $request->message,
                    'booking_id' => $request->booking_id,
                ];
                Notification::send($vendor, new PaymentSendNotification($details));
            };


            Toastr::success("Successfully Sent");
            return redirect()->back();

        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }



    public function viewCancellation($id, Request $request){
        try{

            // dd("fdhjkashfkjds");
            $booking =Booking::where('id', $id)->with(['cancellation'])->first();
            $data = [
                'view' => view('Vendor::backend.appendCancellationReasonModal', compact('booking'))->render()
            ];
            return $this->response->responseSuccess($data, "Success", 200);

        }catch(\Exception $e){
            $this->response->responseError($e->getMessage());
        }
    }







}
