<div class="statbox widget mb-4" style="padding: 0;">
    <div class="widget-content widget-content-area">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="row">
                <div class="form-group col-md-12">
                    <h4>Site Setting</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>General Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title"
                                value="{{ returnSiteSetting('title') ?? old('title') }}" name="title"
                                placeholder="Enter Title" required>
                            @error('title')
                                <div class="text-danger">
                                    {{ $errors->first('title') }}
                                </div>
                            @enderror
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label for="site_description">Site Description <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="site_description"
                                value="{{ returnSiteSetting('site_description') ?? old('site_description') }}"
                                name="site_description" placeholder="Enter site_description" required>
                            @error('site_description')
                                <div class="text-danger">
                                    {{ $errors->first('site_description') }}
                                </div>
                            @enderror
                        </div> --}}
                        <div class="form-group col-md-6 col-sm-6">

                            <label for="primary_phone">Primary Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="primary_phone" name="primary_phone"
                                value="{{ returnSiteSetting('primary_phone') ?? old('primary_phone') }}"
                                placeholder="Enter Primary Phone " required>
                            @error('primary_phone')
                                <div class="text-danger">
                                    {{ $errors->first('primary_phone') }}
                                </div>
                            @enderror

                        </div>
                        <div class="form-group col-md-4 col-sm-6">

                            <label for="secondary_phone">Secondary Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="secondary_phone" name="secondary_phone"
                                value="{{ returnSiteSetting('secondary_phone') ?? old('secondary_phone') }}"
                                placeholder="Enter Secondary Phone" required>
                            @error('secondary_phone')
                                <div class="text-danger">
                                    {{ $errors->first('secondary_phone') }}
                                </div>
                            @enderror

                        </div>
                        <div class="form-group col-md-4 col-sm-6">

                            <label for="primary_email">Primary Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="primary_email" name="primary_email"
                                value="{{ returnSiteSetting('primary_email') ?? old('primary_email') }}"
                                placeholder="Enter Primary Email" required>
                            @error('primary_email')
                                <div class="text-danger">
                                    {{ $errors->first('primary_email') }}
                                </div>
                            @enderror

                        </div>
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="address">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ returnSiteSetting('address') ?? old('address') }}" placeholder="Enter Address"
                                required>
                            @error('address')
                                <div class="text-danger">
                                    {{ $errors->first('address') }}
                                </div>
                            @enderror

                        </div>
                        <div class="col-md-12">
                            <label for="">Aggrement file</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="aggrement_file"
                                    name="aggrement_file" placeholder="Recipient's username"
                                    aria-label="Recipient's username" aria-describedby="basic-addon2">

                                    @if(returnSiteSetting('aggrement_file'))
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">
                                            <a target="_blank" href="{{ checkFileExists(returnSiteSetting('aggrement_file')) ? getOrginalUrl(returnSiteSetting('aggrement_file')) : null }}"><i class="fa-solid fa-eye"></i></a>
                                        </span>

                                    </div>
                                    @endif

                                @error('aggrement_file')
                                    <div class="text-danger">
                                        {{ $errors->first('aggrement_file') }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="about_us">About Us<span class="text-danger"> *</span></label>
                            <textarea type="text" class="form-control summernote" id="about_us" name="about_us"
                                placeholder="Enter Site Description" required>
                                    {!! old('about_us') ?? returnSiteSetting('about_us') !!}
                                </textarea>
                            @error('about_us')
                                <div class="text-danger">
                                    {{ $errors->first('about_us') }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="about_venues">About Venues</label>
                            <textarea type="text" class="form-control summernote" id="about_venues" name="about_venues"
                                placeholder="Enter about_venues">
                                    {!! old('about_venues') ?? returnSiteSetting('about_venues') !!}
                                </textarea>
                            @error('about_venues')
                                <div class="text-danger">
                                    {{ $errors->first('about_venues') }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Payment Setting</h5>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label for="account_name">Account Name <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control" id="title"
                                    value="{{ returnSiteSetting('account_name') ?? old('account_name') }}"
                                    name="account_name" placeholder="Account Name" required>
                                @error('account_name')
                                    <div class="text-danger">
                                        {{ $errors->first('account_name') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="account_number">Bank name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="account_number"
                                    value="{{ returnSiteSetting('bank_name') ?? old('bank_name') }}" name="bank_name"
                                    placeholder="Bank Name" required>
                                @error('bank_name')
                                    <div class="text-danger">
                                        {{ $errors->first('bank_name') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="account_number">Account Number <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="account_number"
                                    value="{{ returnSiteSetting('account_number') ?? old('account_number') }}"
                                    name="account_number" placeholder="Account Number" required>
                                @error('account_number')
                                    <div class="text-danger">
                                        {{ $errors->first('v') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="branch_name">Branch name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="account_number"
                                    value="{{ returnSiteSetting('branch_name') ?? old('branch_name') }}"
                                    name="branch_name" placeholder="Branch Name" required>
                                @error('branch_name')
                                    <div class="text-danger">
                                        {{ $errors->first('branch_name') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <div class="custom-file-container" data-upload-id="qrImage">
                                    <label>Payment QR Code <a href="javascript:void(0)"
                                            class="custom-file-container__image-clear"
                                            title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file"
                                            class="custom-file-container__custom-file__custom-file-input "
                                            accept="image/*" name="qr_image" id="siteLogo">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Social Links</h5>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="form-group col-md-6 col-sm-6">

                            <label for="facebook_link">Facebook Link <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="facebook_link" name="facebook_link"
                                value="{{ returnSiteSetting('facebook_link') ?? old('facebook_link') }}"
                                placeholder="Enter facebook_link" required>
                            @error('facebook_link')
                                <div class="text-danger">
                                    {{ $errors->first('facebook_link') }}
                                </div>
                            @enderror

                        </div>
                        <div class="form-group col-md-6 col-sm-6">

                            <label for="twitter_link">Twitter Link <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="twitter_link" name="twitter_link"
                                value="{{ returnSiteSetting('twitter_link') ?? old('twitter_link') }}"
                                placeholder="Enter twitter_link" required>
                            @error('twitter_link')
                                <div class="text-danger">
                                    {{ $errors->first('twitter_link') }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Images Setting</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <div class="custom-file-container" data-upload-id="mysiteLogo">
                                    <label>Site Logo <a href="javascript:void(0)"
                                            class="custom-file-container__image-clear"
                                            title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file"
                                            class="custom-file-container__custom-file__custom-file-input "
                                            accept="image/*" name="logo" id="siteLogo">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <div class="custom-file-container" data-upload-id="siteFavIcon">
                                    <label>Site Favicon <a href="javascript:void(0)"
                                            class="custom-file-container__image-clear"
                                            title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file"
                                            class="custom-file-container__custom-file__custom-file-input "
                                            accept="image/*" name="favicon" id="siteFavIcon">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <div class="custom-file-container" data-upload-id="aboutUsImage">
                                    <label>About Venue Image <a href="javascript:void(0)"
                                            class="custom-file-container__image-clear"
                                            title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file"
                                            class="custom-file-container__custom-file__custom-file-input "
                                            accept="image/*" name="about_us_image" id="aboutUsImage">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <div class="custom-file-container" data-upload-id="venueImage">
                                    <label>Venue Site Image <a href="javascript:void(0)"
                                            class="custom-file-container__image-clear"
                                            title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file"
                                            class="custom-file-container__custom-file__custom-file-input "
                                            accept="image/*" name="venue_image" id="venueImage">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <div class="custom-file-container" data-upload-id="aboutFirstImage">
                                    <label>About Image First<a href="javascript:void(0)"
                                            class="custom-file-container__image-clear"
                                            title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file"
                                            class="custom-file-container__custom-file__custom-file-input "
                                            accept="image/*" name="about_first_image" id="aboutFirstImage">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <div class="custom-file-container" data-upload-id="aboutSecondImage">
                                    <label>About Image Second<a href="javascript:void(0)"
                                            class="custom-file-container__image-clear"
                                            title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file"
                                            class="custom-file-container__custom-file__custom-file-input "
                                            accept="image/*" name="about_second_image" id="aboutSecondImage">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <div class="custom-file-container" data-upload-id="aboutThirdImage">
                                    <label>About Image Third<a href="javascript:void(0)"
                                            class="custom-file-container__image-clear"
                                            title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file"
                                            class="custom-file-container__custom-file__custom-file-input "
                                            accept="image/*" name="about_third_image" id="aboutThirdImage">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary float-right mb-3">Submit</a>
