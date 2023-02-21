<?php

namespace Vendor\Http\Controllers;


use App\GlobalServices\ResponseService;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Files\Repositories\FileInterface;
use Venue\Repositories\VenueInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vendor\Models\Booking;
use Venue\Models\Venue;

class VendorBookingController extends Controller
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

    public function bookingFilter(Request $request){



        $bookinglist = Booking::whereRaw('"'.Carbon::parse($request->from_date).'" between `from_date` and `to_date`')
        ->whereRaw('"'.Carbon::parse($request->to_date).'" between `from_date` and `to_date`')
        ->with('venues', function($q){
            $q->where('status', '!=', 'Reserved');
        })->get();

        if($bookinglist->isNotEmpty()){
            $lists = [];
            foreach($bookinglist as $list){
                // dd($list->venues->pluck('id'));
                if(!in_array($list->venues->pluck('id'), $lists, true)){

                    foreach($list->venues->pluck('id') as $item){

                        array_push($lists,$item);
                    }
                }

                // dd($list->venues->pluck('id'));
                // array_push($lists,$list->venues->pluck('id'));
            }

            
            //booked
    // dd($lists);
            $venues = Venue::whereNotIn('id', $lists)->where('status', '!=', 'Reserved')->get();
            // $venues = Venue::whereNotIn('id', $bookinglist->venues->pluck('id'))->get();
            // dd();
            // $venues = Venue::with('bookings', function)
            // dd($bookinglists->pluck('id'));

        }else{
            $venues = Venue::where('status', '!=', 'Reserved')->get();
            // dd("not booked");

            // $venues = $venues->whereHas('bookings',function($q) use ($request){
            //     $q->whereRaw('"'.Carbon::parse($request->from_date).'" between `from_date` and `to_date`')
            //     ->where('to_date', '>', $toDate);
            // })->with('bookings')->get();


        }



        // dd($bookinglists);
        // whereBetween(Carbon::parse($request->from_date),['from_date', 'to_date'])->first();

        // $fromDate = $request->from_date;
        // $toDate = $request->to_date;
        // $venues = Venue::with('bookings')->get();
        // $bookedVenues = Venue::whereHas('bookings',function($q) use ($fromDate,$toDate){
        //                     $q->where('from_date',  '<', $fromDate)
        //                     ->where('to_date', '>', $toDate);
        //                 })->with('bookings')->get();


        // dd($venues,$booked_venues);
        // $venues = Venue::whereHas('bookings',function($q) use ($fromDate,$toDate){
        //                 $q->where('from_date',  '<', $fromDate)
        //                 ->where('to_date', '>', $toDate);
        //             })->get();

        // dd($venues);

        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $data = [
            'view' => view('Vendor::frontend.vendor.appendVenueList', compact('venues', 'from_date', 'to_date'))->render()
        ];
        return $this->response->responseSuccess($data,"Successfully Filtered", 200);
    }

    public function bookingStore(Request $request){
        try{
            // dd($request->all());
            $booking = new Booking();
            $booking->vendor_id = Auth::id();
            $booking->status = "Pending";
            $booking->payment_status = "Pending";
            $booking->from_date = Carbon::parse($request->from_date);
            $booking->to_date = Carbon::parse($request->to_date);
            if($booking->save()){
                $booking->venues()->attach($request->venue);
                Toastr::success('Successfully Applied');

                return redirect()->route('vendor.application.index', $booking->id);
            }
            Toastr::error("Something Weng Wrong. Please Try Again.");
            return redirect()->back();
        }catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }






}
