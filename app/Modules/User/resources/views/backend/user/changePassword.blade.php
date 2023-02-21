<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change User Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-x">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <form action="{{ route('backend.auth.changePasswordSubmit') }}" method="post" enctype="multipart/form-data" id="change_password_form">
                    <div class="row">

                            <div class="form-group col-md-12">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter New Password" name="password"
                                    value="{{ old('password') }}">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" placeholder="Enter Confirm Password" name="confirm_password">
                            </div>

                    </div>
                    <div class="d-sm-flex justify-content-between">
                        <div class="field-wrapper toggle-pass">
                            <p class="d-inline-block">Show Password</p>
                            <label class="switch s-primary" style="margin-bottom: 0; vertical-align: sub;margin-left: 7px;}">
                                <input type="checkbox" id="toggle-change-password" class="d-none">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>

                    <div class="field-wrapper">
                        <button type="submit" class="btn btn-primary float-right" value="">Submit</button>
                        <button class="btn btn-danger float-right" data-dismiss="modal">Discard</button>
                    </div>



                </form>
            </div>
        </div>

    </div>
</div>


