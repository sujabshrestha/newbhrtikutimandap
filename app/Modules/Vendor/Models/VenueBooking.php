<?php

namespace Vendor\Models;

use App\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenueBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_id',
        'booking_id',
    ];

    public function booking(){
        return $this->belongsTo(Booking::class);
    }
}
