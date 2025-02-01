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
                    <a href="{{route('export')}}" class="px-5 btn btn-warning">Download Excel File</a>
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
            <h5 class="mb-4">Import Permissions</h5>
            <form class="row g-3" method="POST" id="myForm" enctype="multipart/form-data" action="{{route('import')}}">
                @csrf
                <div class="form-group col-md-6">
                    <label for="import_file" class="form-label">Permission File</label>
                    <input type="file" id="input1" name="import_file" class="form-control rounded-lg
                    @error('import_file')
                        is-invalid
                    @enderror
                    " id="import_file" placeholder="Data Science" required>
                    @error('import_file')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <div class="gap-3 d-md-flex d-grid align-items-center">
                        <button type="submit" class="px-4 btn btn-primary">Upload</button>
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