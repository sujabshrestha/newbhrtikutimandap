<div class="row col-md-12">

    <div class="col-md-12">
        <div class="form-group ">
            <label for="title">Title</label>
            <input type="text" name="title" value="{{ $gallery->title ?? old('title') }}" class="form-control" placeholder="Enter Title">
            @if ($errors->has('title'))
                <small class="text-danger">{{ $errors->first('title') }}</small>
            @endif
        </div>
    </div>


    <div class="col-md-12">
        <div class="form-group">
            @if (isset($gallery))
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
</div>



<button type="submit" class="btn btn-primary float-right mt-2">Submit</a>
    <button class="btn btn-danger float-right mt-2" data-dismiss="modal">Discard</button>




