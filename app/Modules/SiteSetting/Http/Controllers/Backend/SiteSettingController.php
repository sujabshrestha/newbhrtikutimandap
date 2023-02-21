<?php

namespace SiteSetting\Http\Controllers\Backend;

use App\GlobalServices\ResponseService;
use Exception;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Files\Repositories\FileInterface;
use SiteSetting\Http\Requests\SiteSettingRequest;
use SiteSetting\Models\SiteSetting;

class SiteSettingController extends Controller
{
    protected $response, $file;

    public function __construct(ResponseService $response, FileInterface $file)
    {
        $this->response = $response;
        $this->file = $file;
    }


    public function create(){
        try{
            return view('SiteSetting::backend.create');
        }catch(Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function siteSettingSubmit(SiteSettingRequest $request){
        try{
            $inputs = $request->all();
            foreach ($inputs as $inputKey => $inputValue) {
                if ( $inputKey == 'logo') {
                    $sitesetting = SiteSetting::where('key', '=', $inputKey)->first();

                    if($sitesetting)
                    {
                        if(file_exists($sitesetting->value)){
                            unlink($sitesetting->value);
                        }
                    }
                    $uploaded = $this->file->storeFile($request->logo);
                    if ($uploaded) {
                        $imageid = $uploaded->id;
                    }

                    $inputValue = $imageid;
                }
                if ( $inputKey == 'about_us_image') {
                    $sitesetting = SiteSetting::where('key', '=', $inputKey)->first();

                    if($sitesetting)
                    {
                        if(file_exists($sitesetting->value)){
                            unlink($sitesetting->value);
                        }
                    }
                    $uploaded = $this->file->storeFile($request->about_us_image);
                    if ($uploaded) {
                        $about_us_image_id = $uploaded->id;
                    }

                    $inputValue = $about_us_image_id;
                }

                if ( $inputKey == 'aggrement_file') {
                    $sitesetting = SiteSetting::where('key', '=', $inputKey)->first();

                    if($sitesetting)
                    {
                        if(file_exists($sitesetting->value)){
                            unlink($sitesetting->value);
                        }
                    }
                    $uploaded = $this->file->storeFile($request->aggrement_file);
                    if ($uploaded) {
                        $agreement_file_id = $uploaded->id;
                    }

                    $inputValue = $agreement_file_id;
                }

                if ( $inputKey == 'favicon') {
                    $sitesetting = SiteSetting::where('key', '=', $inputKey)->first();

                    if($sitesetting)
                    {
                        if(file_exists($sitesetting->value)){
                            unlink($sitesetting->value);
                        }
                    }
                    $uploaded = $this->file->storeFile($request->favicon);
                    if ($uploaded) {
                        $favid = $uploaded->id;
                    }
                    $inputValue =  $favid;
                }
                if ( $inputKey == 'qr_image') {
                    $sitesetting = SiteSetting::where('key', '=', $inputKey)->first();

                    if($sitesetting)
                    {
                        if(file_exists($sitesetting->value)){
                            unlink($sitesetting->value);
                        }
                    }
                    $uploaded = $this->file->storeFile($request->qr_image);
                    if ($uploaded) {
                        $favid = $uploaded->id;
                    }
                    $inputValue =  $favid;
                }

                if ( $inputKey == 'venue_image') {
                    $sitesetting = SiteSetting::where('key', '=', $inputKey)->first();

                    if($sitesetting)
                    {
                        if(file_exists($sitesetting->value)){
                            unlink($sitesetting->value);
                        }
                    }
                    $uploaded = $this->file->storeFile($request->venue_image);
                    if ($uploaded) {
                        $favid = $uploaded->id;
                    }
                    $inputValue =  $favid;
                }
                if ( $inputKey == 'about_first_image') {
                    $sitesetting = SiteSetting::where('key', '=', $inputKey)->first();

                    if($sitesetting)
                    {
                        if(file_exists($sitesetting->value)){
                            unlink($sitesetting->value);
                        }
                    }
                    $uploaded = $this->file->storeFile($request->about_first_image);
                    if ($uploaded) {
                        $favid = $uploaded->id;
                    }
                    $inputValue =  $favid;
                }

                if ( $inputKey == 'about_second_image') {
                    $sitesetting = SiteSetting::where('key', '=', $inputKey)->first();

                    if($sitesetting)
                    {
                        if(file_exists($sitesetting->value)){
                            unlink($sitesetting->value);
                        }
                    }
                    $uploaded = $this->file->storeFile($request->about_second_image);
                    if ($uploaded) {
                        $favid = $uploaded->id;
                    }
                    $inputValue =  $favid;
                }
                if ( $inputKey == 'about_third_image') {
                    $sitesetting = SiteSetting::where('key', '=', $inputKey)->first();

                    if($sitesetting)
                    {
                        if(file_exists($sitesetting->value)){
                            unlink($sitesetting->value);
                        }
                    }
                    $uploaded = $this->file->storeFile($request->about_third_image);
                    if ($uploaded) {
                        $favid = $uploaded->id;
                    }
                    $inputValue =  $favid;
                }
                $sitesubmit = SiteSetting::updateOrCreate(['key'=>$inputKey],[
                    'value' => $inputValue,
                ]);

            }
            if($sitesubmit){
                Toastr::success('Successfully Updated');
                return redirect()->back();
            }
        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }

    }


}
