@extends('admin.adminDashboard')
@section('admin')

<!-- Jquery is loaded Here  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Admin</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Admin</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{route('all.admins')}}" class="px-5 btn btn-primary">Cancel</a>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />

    <div class="card">
        <div class="p-4 card-body">
            <h5 class="mb-4">Admin Registeration</h5>
            <form class="row g-3" method="POST" id="myForm" enctype="multipart/form-data"
                action="{{route('store.permission')}}">
                @csrf
                <div class="form-group col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="input1" name="name" class="form-control rounded-lg
                    @error('name')
                        in-valid
                    @enderror
                    " id="name" placeholder="Data Science" required>
                    @error('name')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>


                <div class="form-group col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="input1" name="username" class="form-control rounded-lg
                    @error('nameusername')
                        in-valid
                    @enderror
                    " id="nameusername" placeholder="Data Science" required>
                    @error('nameusername')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>


                <div class="form-group col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" id="input1" name="email" class="form-control rounded-lg
                    @error('email')
                        in-valid
                    @enderror
                    " id="email" placeholder="Data Science" required>
                    @error('email')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>


                <div class="form-group col-md-6">
                    <label for="photo" class="form-label">photo</label>
                    <input type="file" id="input1" name="photo" class="form-control rounded-lg
                    @error('photo')
                        in-valid
                    @enderror
                    " id="photo" placeholder="Data Science" required>
                    @error('photo')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>


                <div class="form-group col-md-6">
                    <label for="address" class="form-label">address</label>
                    <input type="text" id="input1" name="address" class="form-control rounded-lg
                    @error('address')
                        in-valid
                    @enderror
                    " id="address" placeholder="Data Science" required>
                    @error('address')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="status" class="form-label">status</label>
                    <input type="text" id="input1" name="status" class="form-control rounded-lg
                    @error('status')
                        in-valid
                    @enderror
                    " id="status" placeholder="Data Science" required>
                    @error('status')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <div class="gap-3 d-md-flex d-grid align-items-center">
                        <button type="submit" class="px-4 btn btn-primary">Submit</button>
                        <a href="{{route('all.subcategory')}}" class="px-4 btn btn-light">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#myForm').validate({
            rules: {
                subcategory_name: {
                    required: true,
                },
                category_id: {
                    required: true,
                },

            },
            messages: {
                subcategory_name: {
                    required: 'Please Enter category name',
                },

                category_id: {
                    required: 'Please Select SubCategory',
                },



            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>
@endsection