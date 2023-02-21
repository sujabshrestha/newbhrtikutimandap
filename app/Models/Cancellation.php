<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancellation extends Model
{
    use HasFactory;


    public function cancellationApplications(){
        return $this->hasMany(CancellationFiles::class, 'cancellation_id');
    }


}
