<?php

namespace CMS\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory, Sluggable;

    protected $fillable =[
        'title',
        'slug',
        'image_id'
    ];

    protected $appends = [
        'image'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getImageAttribute(){
        return url('/').getOrginalUrl($this->image_id);
    }

}
