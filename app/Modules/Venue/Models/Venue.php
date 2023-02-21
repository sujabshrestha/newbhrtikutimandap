<?php

namespace Venue\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Vendor\Models\Booking;

class Venue extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'description',
        'image_id',
        'price'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function scopeNotreserved($q)
    {
        return $q->where('status', '!=', 'reserved');
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'venue_bookings', 'venue_id', 'booking_id');
    }
}
