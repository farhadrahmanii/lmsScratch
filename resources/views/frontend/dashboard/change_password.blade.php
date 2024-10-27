@extends('frontend.dashboard.user_dashboard')
@section('userDashboard')


@php
    $id = Auth::user()->id;
    $userData = App\Models\User::findOrFail($id);
@endphp

<div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
    <div class="setting-body">
        <h3 class="pb-4 fs-17 font-weight-semi-bold">Change Password</h3>
        <form method="POST" class="row pt-40px" action="{{route('user.password.update')}}"
            enctype="multipart/form-data">
            @csrf
            <!-- end media -->
            <div class="input-box col-lg-12">
                <label class="label-text">Old Password</label>
                <div class="form-group">
                    <input class="form-control
                    @error('old_password') is-invalid @enderror
                    form--control" type="password" id="old_password" name="old_password">
                    <span class="la la-lock input-icon"></span>
                    @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div><!-- end input-box -->
            <div class="input-box col-lg-12">
                <label class="label-text">New Password</label>
                <div class="form-group">
                    <input class="form-control
                    @error('new_password') is-invalid @enderror
                    form--control" type="password" name="new_password">
                    <span class="la la-lock input-icon"></span>
                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <span class="la la-lock input-icon"></span>
                </div>
            </div><!-- end input-box -->

            <div class="input-box col-lg-12">
                <label class="label-text">Confirm Password</label>
                <div class="form-group">
                    <input class="form-control
                    @error('password_confirmation') is-invalid @enderror
                    form--control" type="password" name="password_confirmation">
                    <span class="la la-lock input-icon"></span>
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div><!-- end input-box -->

            <div class="py-2 input-box col-lg-12">
                <button type="submit" class="btn theme-btn">Save Changes</button>
            </div><!-- end input-box -->
        </form>
    </div><!-- end setting-body -->
</div>

@endsection