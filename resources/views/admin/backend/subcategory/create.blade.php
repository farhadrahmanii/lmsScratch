@extends('admin.adminDashboard')
@section('admin')

<!-- Jquery is loaded Here  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Sub Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add SubCategory</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{route('add.subcategory')}}" class="px-5 btn btn-primary">Add SubCategory</a>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />

    <div class="card">
        <div class="p-4 card-body">
            <h5 class="mb-4">Add SubCategory</h5>
            <form class="row g-3" method="POST" id="myForm" enctype="multipart/form-data"
                action="{{route('store.subcategory')}}">
                @csrf
                <div class="form-group col-md-6">
                    <label for="category_id" class="form-label">Category Id</label>
                    <select id="input1" name="category_id" class="form-control rounded-lg
                    @error('name')
                        in-valid
                    @enderror
                    " id="name" placeholder="Data Science" required>
                        <option selected disabled>Select Category</option>
                        @foreach ($category as $item)
                            <option value="{{$item->id}}">{{$item->category_name}}</option>
                        @endforeach
                    </select>
                    @error('name')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="subcategory_name" class="form-label">SubCategory Name</label>
                    <input type="text" id="input2" name="subcategory_name" autofocus class="form-control rounded-lg
                    @error('name')
                        in-valid
                    @enderror
                    " id="name" placeholder="Data Science" required>
                    @error('name')
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