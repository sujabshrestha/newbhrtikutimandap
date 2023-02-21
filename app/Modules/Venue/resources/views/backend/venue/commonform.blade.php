<div class="row col-md-12">

    <div class="col-md-12">
        <div class="form-group ">
            <label for="title">Title</label>
            <input type="text" name="title" value="{{ $venue->title ?? old('title') }}" class="form-control" placeholder="Enter Title">
            @if ($errors->has('title'))
                <small class="text-danger">{{ $errors->first('title') }}</small>
            @endif
        </div>
    </div>
    @if (isset($venue))
    <div class="col-md-12">
        <div class="form-group ">
            <label for="title">Status</label>
            <select name="status" class="form-control" id="">
                <option @if ($venue->status == 'Available')
                    selected
                @endif value="Available">Available</option>
                <option @if ($venue->status == 'Booked')
                    selected
                @endif value="Booked">Booked</option>
                <option @if ($venue->status == 'Cancelled')
                    selected
                @endif value="Cancelled">Cancelled</option>
            </select>
            @if ($errors->has('status'))
                <small class="text-danger">{{ $errors->first('status') }}</small>
            @endif
        </div>
    </div>
    @endif
    <div class="col-md-12">
        <div class="form-group">
            <label for="title">Price</label>
            <input type="text" name="price" value="{{ $venue->price ?? old('price') }}" class="form-control" placeholder="Enter Price">
            @if ($errors->has('title'))
                <small class="text-danger">{{ $errors->first('title') }}</small>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            @if (isset($venue))
            <div class="custom-file-container" data-upload-id="editFirstImage">

                <label>Image <code>*</code> <a href="javascript:void(0)"
                        class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                <label class="custom-file-container__custom-file">
                    <input type="file" name="image"
                        class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                </label>
                <div class="custom-file-container__image-preview"></div>
            </div>
            @else
            <div class="custom-file-container" data-upload-id="myFirstImage">

                <label>Image <code>*</code> <a href="javascript:void(0)"
                        class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                <label class="custom-file-container__custom-file">
                    <input type="file" name="image"
                        class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                </label>
                <div class="custom-file-container__image-preview"></div>
            </div>
            @endif


            @if ($errors->has('image'))
                <small class="text-danger">{{ $errors->first('image') }}</small>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <label for="">Description</label>
        <textarea name="description" class="form-control"  id="summernote" cols="30" rows="10">{{ $venue->description ?? old('description') }}</textarea>
    </div>
</div>




<button type="submit" class="btn btn-primary float-right mt-3 ml-2">Submit</a>
    <button class="btn btn-danger float-right mt-3 ml-2" data-dismiss="modal">Discard</button>





