<?php

namespace User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable =[
        'organization_name',
        'organization_phone_no',
        'organization_email',
        'organization_website',
        'organization_address',
        'organization_pan_no',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
