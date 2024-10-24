@extends('instructor.instructorDashboard')
@section('instructor')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">User Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">User Profilep</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                    data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                        href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center d-flex flex-column align-items-center">
                                <img src="{{!empty($instructor->photo)
    ? url('upload/instructor_images/' . $instructor->photo)
    : url('upload/default.png')
                                 }}" alt="Admin" class="p-1 rounded-circle bg-primary" width="110">
                                <div class="mt-3">
                                    <h4>{{$instructor->name}}</h4>
                                    <p class="mb-1 text-secondary">{{$instructor->username}}</p>
                                    <p class="text-muted font-size-sm">{{$instructor->email}}</p>
                                    <button class="btn btn-primary">Follow</button>
                                    <button class="btn btn-outline-primary">Message</button>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <ul class="list-group list-group-flush">
                                <li class="flex-wrap list-group-item d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-globe me-2 icon-inline">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="2" y1="12" x2="22" y2="12"></line>
                                            <path
                                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                            </path>
                                        </svg>Website</h6>
                                    <span class="text-secondary">https://codervent.com</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{route('instructor.profile.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 row">
                                    <!-- <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div> -->
                                    <div class="col-sm-12 text-secondary">
                                        <x-forms.input name="name" value="{{$instructor->name}}" label="Name" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <!-- <div class="col-sm-3">
                                        <h6 class="mb-0">User Name</h6>
                                    </div> -->
                                    <div class="col-sm-12 text-secondary">
                                        <x-forms.input name="username" label="Name" name="username"
                                            value="{{$instructor->username}}" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <!-- <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div> -->
                                    <div class="col-sm-12 text-secondary">
                                        <x-forms.input type="email" label="email" name="email"
                                            value="{{$instructor->email}}" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <!-- <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div> -->
                                    <div class="col-sm-12 text-secondary">
                                        <x-forms.input type="text" label="phone" class="form-control" name="phone"
                                            value="{{$instructor->phone}}" />
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <!-- <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div> -->
                                    <div class="col-sm-12 text-secondary">
                                        <x-forms.input type="text" label="Address" class="form-control" name="address"
                                            value="{{$instructor->address}}" />
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <!-- <div class="col-sm-3">
                                        <h6 class="mb-0">Admin Profile</h6>
                                    </div> -->
                                    <div class="col-sm-12 text-secondary">
                                        <x-forms.input class="form-control" type="file" id="image" label="Profile Image"
                                            name="photo" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <!-- <div class="col-sm-3">
                                        <h6 class="mb-0"></h6>
                                    </div> -->
                                    <div class="col-sm-12 text-secondary">
                                        <img src="{{!empty($instructor->photo)
    ? url('upload/instructor_images/' . $instructor->photo)
    : url('upload/default.png')
                                 }}" alt="Admin" id="showImage" class="rounded-circle" width="110">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-12 text-secondary">
                                        <x-forms.button type="submit" class="px-4 btn btn-primary">Save
                                            Changes</x-forms.button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#image').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
