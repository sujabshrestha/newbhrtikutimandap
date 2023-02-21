<?php

namespace Vendor\Http\Controllers;

use App\GlobalServices\ResponseService;
use Venue\Models\Venue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cancellation;
use App\Models\CancellationFiles;
use Brian2694\Toastr\Facades\Toastr;
use CMS\Models\Gallery;
use Files\Repositories\FileInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use User\Models\Organization;
use User\Models\User;
use Vendor\Models\Booking;
use Venue\Repositories\VenueInterface;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $file, $venue, $response;
    public function __construct(FileInterface $file, ResponseService $response, VenueInterface $venue)
    {
        $this->file = $file;
        $this->response = $response;
        $this->venue = $venue;
    }

    public function home()
    {
        // try {
        $venues = Venue::get();
        // $booked_venues = Venue::whereHas('bookings')->with('bookings')->get();
        // dd($venues,$booked_venues);
        return view('Vendor::frontend.vendor.home', compact('venues'));
        // } catch (\Exception $e) {
        //     Toastr::error($e->getMessage());
        //     return redirect()->back();
        // }
    }

    public function about()
    {
        try {
            return view('Vendor::frontend.others.about');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }


    public function termsAndCondition(){
        try {
            return view('Auth::vendor.termsAndCondition');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function gallery()
    {
        try {
            $gallery = Gallery::latest()->get();
            return view('Vendor::frontend.others.gallery', compact('gallery'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function rules()
    {
        try {
            return view('Vendor::frontend.others.rules');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function myAccount()
    {
        try {
            $user = User::where('id', Auth::id())->with('organization')->first();
            return view('Vendor::frontend.userProfile.myAccount', compact('user'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }


    public function myBooking()
    {
        try {
            $bookings = Booking::where('vendor_id', Auth::id())->with('venues')->latest()->get();
            return view('Vendor::frontend.userProfile.myBooking', compact('bookings'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function myBookingDetails($id)
    {
        try {
            $booking = Booking::where('id', $id)->with('venues')->first();
            if ($booking) {
                $data = [
                    'view' => view('Vendor::frontend.userProfile.myBookingDetails', compact('booking'))->render()
                ];
                return $this->response->responseSuccess($data, "Success", 200);
            }
            return $this->response->responseError("Booking Not Found.");
        } catch (\Exception $e) {
            return $this->response->responseError($e->getMessage());
        }
    }

    public function profileUpdate(Request $request)
    {
        try {
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->description = $request->description;
            if ($user->update()) {
                Organization::updateOrCreate(
                    [
                        'user_id' => $user->id
                    ],
                    [
                        'organization_name' => $request->organization_name,
                        'organization_phone_no' => $request->organization_phone_no,
                        'organization_email' => $request->organization_email,
                        'organization_website' => $request->organization_website,
                        'organization_address' => $request->organization_address,
                        'organization_pan_no' => $request->organization_pan_no,

                    ]
                );
                Toastr::success('User Profile Successfully Updated');
                return redirect()->route('vendor.myAccount');
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }


    public function markNotificationRead()
    {
        try {
            auth()->user()->unreadNotifications->markAsRead();
            return $this->response->responseSuccessMsg("Successfully Marked as read");
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }




    public function downloadZip(Request $request, $id)
    {
        // if($request->has('download')) {

        $booking = Booking::where('id', $id)->with('applications')->first();
        $public_dir = public_path();
        $zipFileName = 'download.zip';
        $zip = new \ZipArchive;
        if ($zip->open($public_dir . '/' . $zipFileName, \ZipArchive::CREATE) === TRUE) {
            // Add File in ZipArchive

            foreach ($booking->applications as $application) {
                if (Storage::exists(getFilePath($application->file_id))) {
                    $zip->addFile(public_path('storage' . DIRECTORY_SEPARATOR . getFilePath($application->file_id)), getFilePath($application->file_id));
                }
                // $zip->addFile($public_dir . '/' . $invoice_file, $invoice_file);
            }
            $zip->close();
        }
        // Set Header
        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );
        $filetopath = $public_dir . '/' . $zipFileName;
        // Create Download Response
        if (file_exists($filetopath)) {
            ob_end_clean();
            return response()->download($filetopath, $zipFileName, $headers);
        }
        // }
    }


    public function bookingCancelModal($id){
        try{
            $booking = Booking::where('id', $id)->first();
            $data = [
                'view' => view('Vendor::frontend.userProfile.cancelModal', compact('booking'))->render()
            ];
            return $this->response->responseSuccess($data, "Success", 200);

        }catch(\Exception $e){
            return $this->response->responseError($e->getMessage());
        }
    }


    public function bookingCancelSubmit(Request $request, $id){
        try{

            $booking = Booking::where('id', $id)->first();

            if($booking){
                $bookingcancellation = new Cancellation();
                $bookingcancellation->booking_id = $booking->id;
                $bookingcancellation->subject = $request->subject;
                $bookingcancellation->short_description = $request->reason;
                $bookingcancellation->user_id = auth()->user()->id;
                if($bookingcancellation->save()){
                    if($request->applications){
                        foreach($request->applications as $application){
                            $cancelledapplication = new CancellationFiles();
                            $cancelledapplication->cancellation_id = $bookingcancellation->id;
                            $uploaded = $this->file->storeFile($application);
                            $cancelledapplication->file_id = $uploaded->id;
                            $cancelledapplication->save();
                        }
                    }
                }
                Toastr::success("Your application has been successfully verified");
                return redirect()->back();

            }
            return $this->response->responseError("Booking not found");
        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }


    public function bookingDetailsViewModal($id){
        try{
            $venue = Venue::where('id', $id)->first();
            if($venue){
                $data = [
                    'view' => view('Vendor::frontend.vendor.venueDetailsModal', compact('venue'))->render()
                ];
                return $this->response->responseSuccess($data, "Success", 200);
            }
            return $this->response->responseError("Venue not found");

        }catch(\Exception $e){
            return $this->response->responseError($e->getMessage());
        }
    }




    public function profileImageUpdate(Request $request){
        try{
            $user = User::where('id', auth()->user()->id)->first();
            if($user){
                if(($user->image_id != null) && checkFileExists($user->image_id)){
                    $this->file->delete($user->image_id);
                }

                $uploaded = $this->file->storeFile($request->profile_image);
                $user->image_id =$uploaded->id;

                if($user->update() == true){

                    return $this->response->responseSuccessMsg("successfully Updated");
                }
                return $this->response->responseSuccessMsg("Something went wrong please try again later");

            }
            return $this->response->responseError("User not found");
        }catch(\Exception $e){
            return $this->response->responseError($e->getMessage());
        }
    }


}
