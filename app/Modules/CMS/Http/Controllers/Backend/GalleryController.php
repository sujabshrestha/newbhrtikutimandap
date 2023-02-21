<?php

namespace CMS\Http\Controllers\Backend;

use App\GlobalServices\ResponseService;
use CMS\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Files\Repositories\FileInterface;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $file, $venue, $response;
    public function __construct(FileInterface $file, ResponseService $response)
    {
        $this->file = $file;
        $this->response = $response;
    }

    public function index(Request $request)
    {
        // try {

        if ($request->ajax()) {
            $datas = Gallery::get();
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $url = url('/') . getOrginalUrl($row->image_id);
                    return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-url="' . route('backend.cms.gallery.edit', $row->id) . '" data-id=' . $row->id . ' class="editGallery btn btn-info btn-sm" title="Edit"><i class="far fa-edit"></i></a>
                                <a href="javascript:void(0)" id="" data-url="' . route('backend.cms.gallery.delete', $row->id) . '"  data-id=' . $row->id . ' class="delete btn btn-danger btn-sm" title="Delete"><i class="far fa-trash-alt"></i></a>
                                ';
                    return $actionBtn;
                })
                ->rawColumns(['action' ,'image'])
                ->make(true);
        }


        return view('CMS::Backend.gallery.index');
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
            // dd("hdkjshakjdsa");
            $data = [
                'view' => view('CMS::Backend.gallery.create')->render()
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
    public function store(Request $request)
    {
        // try {
        if ($request->ajax()) {
            $gallery = new Gallery();
            $gallery->title = $request->title;

            if ($request->image) {
                $uploaded = $this->file->storeFile($request->image);
                $gallery->image_id = $uploaded->id;
            }
            if ($gallery->save()) {
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
            $gallery = Gallery::where('id', $id)->first();
            if ($gallery) {
                $data = [

                    'view' => view('CMS::Backend.gallery.edit', compact('gallery'))->render()
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
                $gallery =  Gallery::where('id', $id)->first();
                $gallery->title = $request->title;
                if ($request->image) {
                    if (checkFileExists($gallery->image_id)) {
                        $this->file->delete($gallery->image_id);
                    }
                    $uploaded = $this->file->storeFile($request->image);
                    $gallery->image_id = $uploaded->id;
                }
                if ($gallery->update()) {
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
            $gallery =  Gallery::where('id', $id)->first();
            if ($gallery) {
                if (checkFileExists($gallery->image_id)) {
                    $this->file->delete($gallery->image_id);
                }
                $gallery->delete();
                return $this->response->responseSuccessMsg("Successfully Deleted", 200);
            }
            return $this->response->responseError("Something went wrong", 200);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }



}
