@extends('admin.adminDashboard')
@section('admin')

<!-- Jquery is loaded Here  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Tables</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{route('add.category')}}" class="px-5 btn btn-primary">Add Category</a>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />

    <div class="card">
        <div class="p-4 card-body">
            <h5 class="mb-4">Add Coupon</h5>
            <form class="row g-3" method="POST" id="myForm" enctype="multipart/form-data"
                action="{{route('store.admin.coupon')}}">
                @csrf
                <div class="form-group col-md-6">
                    <label for="coupon_name" class="form-label">Coupon Name</label>
                    <input type="text" id="input1" name="coupon_name" class="form-control rounded-lg
                    @error('coupon_name')
                        in-valid
                    @enderror
                    " id="name" placeholder="Black_Friday" required>
                    @error('name')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="image" class="form-label">coupon discount</label>
                    <input type="number" min="1" max="5" class="p-2 rounded-lg bordered form-control" id="image" name="coupon_discount"
                        placeholder="Amount of Discount">
                </div>
                <div class="form-group col-md-6">
                    <label for="validaty" class="form-label">Coupon Validity</label>
                    <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                        class="p-2 rounded-lg bordered form-control" id="validaty" name="validaty">
                </div>
                <div class="col-md-12">
                    <div class="gap-3 d-md-flex d-grid align-items-center">
                        <button type="submit" class="px-4 btn btn-primary">Submit</button>
                        <a href="{{route('admin.all.coupon')}}" class="px-4 btn btn-light">Cancel</a>
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
                category_name: {
                    required: true,
                },
                image: {
                    required: true,
                },

            },
            messages: {
                category_name: {
                    required: 'Please Enter category name',
                },
                image: {
                    required: 'Please Add Image',
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
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dateInput = document.getElementById('validaty');
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    });
</script>
@endsection