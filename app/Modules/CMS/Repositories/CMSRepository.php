<?php

namespace CMS\Repositories;

use CMS\Models\NagarikWadaPatra;
use CMS\Repositories\CMSInterface;
use Exception;
use Files\Repositories\FileInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class CMSRepository implements CMSInterface {

    protected $file =null;
    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }

    public function submit($request){
        // dd($request->all());
        $item = new NagarikWadaPatra();
        $item->title = $request->title;
        $item->time_taken = $request->time_taken;
        $item->service_department = $request->service_department;
        $item->responsible_body = $request->responsible_body;
        $item->status = 'Active';
        $item->important_process = $request->important_process;
        $item->location = $request->location;
        $item->required_document = $request->required_document;

        if($item->save()){
            return true;
        }
        throw new Exception("Something went wrong");

    }

    public function update($slug, $request){
        $item = NagarikWadaPatra::where('slug', $slug)->first();
        if($item){
            $item->title = $request->title;
            $item->time_taken = $request->time_taken;
            $item->service_department = $request->service_department;
            $item->responsible_body = $request->responsible_body;
            $item->status = 'Active';
            $item->important_process = $request->important_process;
            $item->location = $request->location;
            $item->required_document = $request->required_document;
            if($item->update() == true){
                return true;
            }
            throw new Exception("Something went wrong");
        }
        throw new Exception("item not found");
    }


}
