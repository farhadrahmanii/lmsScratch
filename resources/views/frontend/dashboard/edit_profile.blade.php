@extends('frontend.dashboard.user_dashboard')
@section('userDashboard')


@php
    $id = Auth::user()->id;
    $userData = App\Models\User::findOrFail($id);
@endphp
<div class="flex-wrap mb-5 breadcrumb-content d-flex align-items-center justify-content-between">
    <div class="media media-card align-items-center">
        <div class="rounded-full media-img media--img media-img-md">
            <img class="rounded-full"
                src="{{!empty($userData->photo) ? asset('upload/user_images/' . $userData->photo) : url('upload/default.png')}}"
                alt="Student thumbnail image">
        </div>
        <div class="media-body">
            <h2 class="section__title fs-30">Hello, {{ $userData->name }}</h2>
            <!-- end rating-wrap -->
        </div><!-- end media-body -->
    </div><!-- end media -->
    <!-- file-upload-wrap -->
</div>

<div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
    <div class="setting-body">
        <h3 class="pb-4 fs-17 font-weight-semi-bold">Edit Profile</h3>
        <form method="POST" class="row pt-40px" action="{{route('user.profile.update')}}" enctype="multipart/form-data">
            @csrf
            <div class="media media-card align-items-center">
                <div class="mr-4 media-img media-img-lg bg-gray">
                    <img class="mr-3"
                        src="{{!empty($userData->photo) ? asset('upload/user_images/' . $userData->photo) : url('upload/default.png')}}"
                        alt="avatar image">
                </div>
                <div class="media-body">
                    <div class="file-upload-wrap file-upload-wrap-2">
                        <input type="file" name="photo" class="multi file-upload-input with-preview" multiple>
                        <span class="file-upload-text"><i class="mr-2 la la-photo"></i>Upload a Photo</span>
                    </div><!-- file-upload-wrap -->
                    <p class="fs-14">Max file size is 5MB, Minimum dimension: 200x200 And Suitable files are .jpg & .png
                    </p>

                </div>
            </div><!-- end media -->
            <div class="input-box col-lg-6">
                <label class="label-text">First Name</label>
                <div class="form-group">
                    <input class="form-control form--control" type="text" name="name" value="{{ $userData->name}}">
                    <span class="la la-user input-icon"></span>
                </div>
            </div><!-- end input-box -->
            <div class="input-box col-lg-6">
                <label class="label-text">User Name</label>
                <div class="form-group">
                    <input class="form-control form--control" type="text" name="username"
                        value="{{$userData->username}}">
                    <span class="la la-user input-icon"></span>
                </div>
            </div><!-- end input-box -->
            <div class="input-box col-lg-6">
                <label class="label-text">Email Address</label>
                <div class="form-group">
                    <input class="form-control form--control" type="email" name="email" value="{{$userData->email}}">
                    <span class="la la-envelope input-icon"></span>
                </div>
            </div><!-- end input-box -->
            <div class="input-box col-lg-6">
                <label class="label-text">Phone Number</label>
                <div class="form-group">
                    <input class="form-control form--control" type="text" name="phone" value="{{$userData->phone}}">
                    <span class="la la-phone input-icon"></span>
                </div>
            </div><!-- end input-box -->
            <div class="input-box col-lg-12">
                <label class="label-text">Address:</label>
                <div class="form-group">
                    <input class="form-control form--control" type="text" name="address" value="{{$userData->address}}">
                    <span class="la la-phone input-icon"></span>
                </div>
            </div><!-- end input-box -->
            <div class="py-2 input-box col-lg-12">
                <button type="submit" class="btn theme-btn">Save Changes</button>
            </div><!-- end input-box -->
        </form>
    </div><!-- end setting-body -->
</div>

@endsection