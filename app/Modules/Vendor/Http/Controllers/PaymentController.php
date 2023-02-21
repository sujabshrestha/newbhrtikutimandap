<?php

namespace Vendor\Http\Controllers;

use Vendor\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentBookingimages;
use Brian2694\Toastr\Facades\Toastr;
use Files\Repositories\FileInterface;
use Vendor\Models\Booking;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $file;
    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }

    public function index()
    {
        try {
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        try {
            $payment = new Payment();
            $payment->booking_id = $id;
            $payment->deposited_amount = $request->deposited_amount;
            $payment->contact = $request->contact;
            $payment->deposited_by = $request->deposited_by;
            if ($payment->save()) {
                if ($request->uploadfiles) {

                    foreach ($request->uploadfiles as $uploadfile) {
                        $paymentbookingimages = new PaymentBookingimages();
                        $paymentbookingimages->booking_id = $payment->booking_id;
                        $paymentbookingimages->payment_id = $payment->id;
                        $uploaded = $this->file->storeFile($uploadfile);
                        $paymentbookingimages->file_id = $uploaded->id;
                        $paymentbookingimages->save();
                    }

                    $notification = auth()->user()->unreadNotifications->where('id', $request->notification_id)->markAsRead();

                    Toastr::success("Successfully Stored");
                    return view('Vendor::frontend.vendor.success');
                }
            }

            Toastr::error("Something went wrong while storing payments");
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
