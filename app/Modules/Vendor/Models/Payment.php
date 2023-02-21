<?php

namespace Vendor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_id', 'booking_id'
    ];

    protected $appends = [
        'image'
    ];

    public function getImageAttribute(){
        return url('/').getOrgianlUrl($this->image_id);
    }


}
