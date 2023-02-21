<?php

namespace Vendor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User\Models\User;

class Application extends Model
{
    use HasFactory;

    protected $appends= [
        'file'
    ];

    protected $fillable = [
        'file_id',
        'booking_id',
        'type',
        'name'
    ];

    public function getFileAttribute(){
        return url('/').getOrginalUrl($this->file_id);
    }

    // public function vendor(){
    //     return $this->belongsTo(User::class, 'vendor_id');
    // }
}
