@extends('admin.adminDashboard')
@section('admin')

<!-- Jquery is loaded Here  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Permissions</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Permission</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{route('all.permission')}}" class="px-5 btn btn-primary">Cancel</a>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />

    <div class="card">
        <div class="p-4 card-body">
            <h5 class="mb-4">Edit Permissions</h5>
            <form class="row g-3" method="POST" id="myForm" enctype="multipart/form-data"
                action="{{route('update.permission')}}">
                @csrf
                <input type="hidden" name="id" value="{{$permission->id}}">
                <div class="form-group col-md-6">
                    <label for="name" class="form-label">Permission Name</label>
                    <input type="text" id="input1" value="{{$permission->name}}" name="name" class="form-control rounded-lg
                    @error('name')
                        in-valid
                    @enderror
                    " id="name" placeholder="Data Science" required>
                    @error('name')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="group_name" class="form-label">Category</label>
                    <select id="input1" name="group_name" class="form-control rounded-lg
                    @error('group_name')
                        in-valid
                    @enderror
                    " id="group_name" placeholder="Data Science" required>
                        <option disabled>Select Category</option>
                        <option value="Category" {{ $permission->group_name == 'Category' ? 'selected' : '' }}>Category
                        </option>
                        <option value="Coupon" {{ $permission->group_name == 'Coupon' ? 'selected' : '' }}>Coupon</option>
                        <option value="Setting" {{ $permission->group_name == 'Setting' ? 'selected' : '' }}>Setting
                        </option>
                        <option value="Report" {{ $permission->group_name == 'Report' ? 'selected' : '' }}>Report</option>
                        <option value="Review" {{ $permission->group_name == 'Review' ? 'selected' : '' }}>Review</option>
                        <option value="All User" {{ $permission->group_name == 'All User' ? 'selected' : '' }}>All User
                        </option>
                        <option value="Blog" {{ $permission->group_name == 'Blog' ? 'selected' : '' }}>Blog</option>
                        <option value="Role and Permission" {{ $permission->group_name == 'Role and Permission' ? 'selected' : '' }}>Role and
                            Permission</option>
                    </select>
                    @error('group_name')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <div class="gap-3 d-md-flex d-grid align-items-center">
                        <button type="submit" class="px-4 btn btn-primary">Submit</button>
                        <a href="{{route('all.permission')}}" class="px-4 btn btn-light">Cancel</a>
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
                name: {
                    required: true,
                },
                group_name: {
                    required: true,
                },

            },
            messages: {
                name: {
                    required: 'Please Enter name Of Permission',
                },

                group_name: {
                    required: 'Please Select Permission Group Name',
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