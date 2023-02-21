<?php

namespace Venue\Http\Controllers\Backend;

use App\GlobalServices\ResponseService;
use Venue\Models\Venue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Files\Repositories\FileInterface;
use Venue\Repositories\VenueInterface;
use Yajra\DataTables\Facades\DataTables;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $file, $venue, $response;
    public function __construct(FileInterface $file, ResponseService $response, VenueInterface $venue)
    {
        $this->file = $file;
        $this->response = $response;
        $this->venue = $venue;
    }

    public function index(Request $request)
    {
        // try {

        if ($request->ajax()) {
            $datas = Venue::get();
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    if($row->status == "Available"){
                       return '<span class="badge badge-primary">Available</span>';
                    }
                    elseif($row->status == "Booked"){
                        return '<span class="badge badge-secondary">Booked</span>';

                    }
                    else{
                       return '<span class="badge badge-danger">Cancelled</span>';
                    }
               })
                // ->addColumn('status', function ($row) {
                //     return '<select id="select" class="form-control" name"select">
                //                       <option >Available</option>
                //                       <option>Pending</option>
                //                       <option>Completed</option>
                //                 </select> ';
                // })
                ->addColumn('image', function ($row) {
                    $url= url('/').getOrginalUrl($row->image_id);
                    return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-url="'. route('backend.venue.edit', $row->id) .'" data-id=' . $row->id . ' class="editVenue btn btn-info btn-sm" title="Edit"><i class="far fa-edit"></i></a>
                                <a href="javascript:void(0)" id="" data-url="'. route('backend.venue.delete', $row->id) .'"  data-id=' . $row->id . ' class="delete btn btn-danger btn-sm" title="Delete"><i class="far fa-trash-alt"></i></a>
                                ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'image'])
                ->make(true);
        }


        return view('Venue::backend.venue.index');
        // } catch (\Exception $e) {
        //     Toastr::error($e->getMessage());
        //     return redirect()->back();
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $data = [
                'view' => view('Venue::backend.venue.create')->render()
            ];

            return $this->response->responseSuccess($data, "Success", 200);
        } catch (\Exception $e) {
            return $this->response->responseError($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     private function ent_to_nepali_num_convert($number){
        $eng_number = [ "0", "1","2", "3", "4", "5", "6", "7", "8", "9"];

        $nep_number = ["०", "१", "२", "३", "४", "५", "६", "७", "८", "९"];

        return str_replace($eng_number, $nep_number, $number);
    }


    public function store(Request $request)
    {
        // try {
        if ($request->ajax()) {

            $venue = new Venue();
            $venue->title = $request->title;
            $venue->price = $request->price;
            $venue->np_price = $this->ent_to_nepali_num_convert((float)$request->price);
            $venue->description = $request->description;
            if ($request->image) {
                $uploaded = $this->file->storeFile($request->image);
                $venue->image_id = $uploaded->id;
            }
            if ($venue->save()) {
                return $this->response->responseSuccessMsg("Successfully Stored", 200);
            }
            return $this->response->responseError("Something went wrong");
        }
        // } catch (\Exception $e) {
        //     return $this->response->responseError($e->getMessage());
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function show(proposal $proposal)
    {
        try {
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $venue = Venue::where('id', $id)->first();
            if ($venue) {
                $data = [
                    'image' => url('/').getOrginalUrl($venue->image_id),
                    'view' => view('Venue::backend.venue.edit', compact('venue'))->render()
                ];

                return $this->response->responseSuccess($data, "Success", 200);
            }

            return $this->response->responseError("Something went wrong");
        } catch (\Exception $e) {
            return $this->response->responseError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if ($request->ajax()) {
                $venue =  Venue::where('id', $id)->first();
                $venue->title = $request->title;
                $venue->price = $request->price;
                $venue->np_price = $this->ent_to_nepali_num_convert((float)$request->price);
                $venue->status = $request->status;
                $venue->description = $request->description;
                if ($request->image) {
                    if(checkFileExists($venue->image_id)){
                        $this->file->delete($venue->image_id);
                    }
                    $uploaded = $this->file->storeFile($request->image);
                    $venue->image_id = $uploaded->id;
                }
                if ($venue->update()) {
                    return $this->response->responseSuccessMsg("Successfully Stored", 200);
                }
                return $this->response->responseError("Something went wrong");
            }
        } catch (\Exception $e) {
            return $this->response->responseError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $venue =  Venue::where('id', $id)->first();
            if($venue){
                if(checkFileExists($venue->image_id)){
                    $this->file->delete($venue->image_id);
                }
                $venue->delete();
                return $this->response->responseSuccessMsg("Successfully Deleted", 200);
            }
            return $this->response->responseError("Something went wrong", 200);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }
}
