@extends('instructor.instructorDashboard')
@section('instructor')



<!-- Jquery is loaded Here  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Course</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Course</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <hr />

    <div class="card">
        <div class="p-4 card-body">
            <h5 class="mb-4">Add Course</h5>
            <form class="row g-3" method="POST" id="myForm" enctype="multipart/form-data"
                action="{{route('update.course')}}">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id}}" />
                <div class="form-group col-md-6">
                    <label for="course_name" class="form-label">Course Name</label>
                    <input type="text" name="course_name" value="{{$course->course_name}}" class="form-control rounded-lg
                    @error('course_name')
                        is-invalid
                    @enderror
                    " id="course_name" placeholder="Laravel Complete Course" required>
                    <x-myerror error="course_name"></x-myerror>

                </div>
                <div class="form-group col-md-6">
                    <label for="course_title" class="form-label">Course Title</label>
                    <input type="text" value="{{$course->course_title}}" name="course_title" class="form-control rounded-lg
                    @error('course_title')
                        is-invalid
                    @enderror
                    " id="name" placeholder="Laravel 10 Course" required />
                    <x-myerror error="course_title"></x-myerror>
                </div>

                <div class="form-group col-md-6">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id"
                        class="form-control rounded-lg @error('category_id') is-invalid @enderror" required>
                        <option selected disabled>Select Category</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $course->category_id ? 'selected' : '' }}>
                                {{ $item->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-red-500 text-bold">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="subcategory_id" class="form-label">Sub Category</label>
                    <select name="subcategory_id" id="subcategory_id"
                        class="form-control rounded-lg @error('subcategory_id') is-invalid @enderror " required>
                        <option selected disabled>Select Subcategory</option>
                        @foreach ($subcategory as $subcat)
                            <option value="{{ $subcat->id }}" {{  $subcat->id == $course->subcategory_id ? 'selected' : '' }}>
                                {{ $subcat->subcategory_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subcategory_id')
                        <span class=" text-red-500 text-bold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-12">
                    <label for="description" class="form-label">Course Description</label>
                    <textarea id="myeditorinstance" name="description" class="form-control rounded-lg
                    @error('description')
                        is-invalid
                    @enderror
                    " id="name" placeholder="Write Clean Description" required>{{$course->description}}</textarea>
                    <x-myerror error="description"></x-myerror>
                </div>

                <div class="form-group col-md-4">
                    <label for="duration" class="form-label">Duration</label>
                    <input type="text" name="duration" value="{{$course->duration}}" class="form-control rounded-lg
                    @error('duration')
                        is-invalid 
                    @enderror
                    " id="label" placeholder="Data Science" required />
                    <x-myerror error="duration"></x-myerror>
                </div>
                <div class="form-group col-md-4">
                    <label for="label" class="form-label">Label</label>
                    <select name="label" class="form-control rounded-lg
                    @error('label')
                        in-valid
                    @enderror
                    " id="name" placeholder="Data Science" required>
                        <option disabled>Select Level</option>
                        <option value="Begginer" {{  $course->label == "Begginer" ? 'selected' : ''}}>Begginer
                        </option>
                        <option value="Middle" {{  $course->label == "Middle" ? 'selected' : ''}}>Middle</option>
                        <option value="Advance" {{  $course->label == "Advance" ? 'selected' : ''}}>Advance</option>
                    </select>
                    <x-myerror error="label"></x-myerror>
                </div>
                <div class="form-group col-md-4">
                    <label for="Certificate" class="form-label">Certificate</label>
                    <select name="certificate" class="form-control rounded-lg
                    @error('Certificate')
                        in-valid
                    @enderror
                    " id="name" placeholder="Data Science" required>
                        <option selected disabled>Has Certificate</option>
                        <option value="Yes" {{  $course->certificate == "Yes" ? 'selected' : ''}}>Yes</option>
                        <option value="No" {{  $course->certificate == "No" ? 'selected' : ''}}>No</option>
                    </select>
                    <x-myerror error="Certificate"></x-myerror>
                </div>
                <div class="form-group col-md-4">
                    <label for="Resources" class="form-label">Resources</label>
                    <input type="text" value="{{$course->resources}}" name="resources" class="form-control rounded-lg
                    @error('resources')
                        is-invalid 
                    @enderror
                    " id="label" placeholder="Data Science" required />
                    <x-myerror error="resources"></x-myerror>
                </div>

                <div class="form-group col-md-4">
                    <label for="selling_price" class="form-label">Selling Price</label>
                    <input type="number" name="selling_price" value="{{$course->selling_price}}" class="form-control rounded-lg
                    @error('selling_price')
                        is-invalid 
                    @enderror
                    " id="label" placeholder="Data Science" required />
                    <x-myerror error="selling_price"></x-myerror>
                </div>
                <div class="form-group col-md-4">
                    <label for="discount_price" class="form-label">Discount Price</label>
                    <input type="number" name="discount_price" value="{{$course->discount_price}}" class="form-control rounded-lg
                    @error('discount_price')
                        is-invalid 
                    @enderror
                    " id="label" placeholder="Data Science" required />
                    <x-myerror error="discount_price"></x-myerror>
                </div>
                <div class="form-group col-md-12">
                    <label for="prerequisites" class="form-label">Prerequesities</label>
                    <textarea type="text" id="myeditorinstance" name="prerequisites" class="form-control rounded-lg
                    @error('prerequisites')
                        is-invalid 
                    @enderror
                    " id="label" placeholder="Data Science" required>{{$course->prerequisites}}</textarea>
                    <x-myerror error="prerequisites"></x-myerror>
                </div>

                <div class="row mt-4 ">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="featured"
                                id="flexCheckDefault" {{  $course->featured == "1" ? 'checked' : ''}}>
                            <label class="form-check-label" for="flexCheckDefault">Featured</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="bestseller" id="bestseller"
                                {{  $course->bestseller == "1" ? 'checked' : ''}}>
                            <label class="form-check-label" for="bestseller">Best Seller</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="highestrated"
                                id="highestrated" {{  $course->highestrated == "1" ? 'checked' : ''}}>
                            <label class="form-check-label" for="highestrated">highest rated</label>
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="gap-3 d-md-flex d-grid align-items-center">
                        <button type="submit" class="px-4 btn btn-primary">Submit</button>
                        <a href="{{route('all.courses')}}" class="px-4 btn btn-light">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ======================================Course Image Update process -========================= -->
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <form action="{{route('update.course.image')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id}}" />
                <input type="hidden" name="old_image" value="{{ $course->course_image}}" />
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="course_image" class="form-label">Course Image</label>
                        <input type="file" class="p-2 rounded-lg bordered form-control" id="image" name="course_image"
                            placeholder="First Name" />
                        <x-myerror error="course_title"></x-myerror>
                    </div>

                    <div class="col-md-3">
                        <img src="{{asset($course->course_image)}}" alt="category Image" id="showImage"
                            class="rounded-circle" width="110">
                    </div>

                    <div class="col-md-12 mt-4">
                        <div class="gap-3 d-md-flex d-grid align-items-center">
                            <button type="submit" class="px-4 btn btn-primary">Submit</button>
                            <a href="{{route('all.courses')}}" class="px-4 btn btn-light">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ======================================Course Image Update process -========================= -->
<!-- ======================================Course Video Update process -========================= -->
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <form action="{{route('update.course.video')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id}}" />
                <input type="hidden" name="old_video" value="{{ $course->video}}" />
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="video" class="form-label">Course Video</label>
                        <input type="file" class="p-2 rounded-lg bordered form-control" accept="video/mp4, video/webm"
                            id="video" name="video" />
                        <x-myerror error="video"></x-myerror>
                    </div>

                    <div class="col-md-3">
                        <video width="300" height="130" controls>
                            <source src="{{asset($course->video)}}" type="video/mp4">
                        </video>
                    </div>

                    <div class="col-md-12 mt-4">
                        <div class="gap-3 d-md-flex d-grid align-items-center">
                            <button type="submit" class="px-4 btn btn-primary">Submit</button>
                            <a href="{{route('all.courses')}}" class="px-4 btn btn-light">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ======================================End Course Video Update process -========================= -->

<!-- ====================================== Goals Update process -========================= -->
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <form action="{{route('update.course.goal')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $course->id}}" />
                <div class="row">
                    <!--   //////////// Goal Option /////////////// -->
                    <div class="row add_item">
                        <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                            <div class="container mt-2">
                                <div class="form-group col-md-6" style="padding-top: 30px;">
                                    <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add
                                        Goal</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($goals as $goal)
                        <div class="row add_item">
                            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                <div class="container mt-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="course" value="{{$goal->id}}" />
                                            <div class="mb-3">
                                                <label for="goals" class="form-label"> Goals </label>
                                                <input type="text" name="course_goals[]" id="goals"
                                                    value="{{ $goal->goal_name }}" class="form-control"
                                                    placeholder="Goals ">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6" style="padding-top: 30px;">
                                            <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add
                                                More..</a>
                                            <span class="btn btn-danger btn-sm removeeventmore"><i
                                                    class="fa fa-minus-circle">Remove</i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!---end row-->
                    <!-- End Course Goal -->
                    <div class="col-md-12 mt-4">
                        <div class="gap-3 d-md-flex d-grid align-items-center">
                            <button type="submit" class="px-4 btn btn-primary">Submit</button>
                            <a href="{{route('all.courses')}}" class="px-4 btn btn-light">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ======================================Goals Course Update process -========================= -->







































<!--========== Start of add multiple class with ajax ==============-->
<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="whole_extra_item_delete" id="whole_extra_item_delete">
            <div class="container mt-2">
                <div class="row">


                    <div class="form-group col-md-6">
                        <label for="goals">Goals</label>
                        <input type="text" name="course_goals[]" id="goals" class="form-control" placeholder="Goals  ">
                    </div>
                    <div class="form-group col-md-6" style="padding-top: 20px">
                        <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                        <span class="btn btn-danger btn-sm removeeventmore"><i
                                class="fa fa-minus-circle">Remove</i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        var counter = 0;
        $(document).on("click", ".addeventmore", function () {
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
        $(document).on("click", ".removeeventmore", function (event) {
            $(this).closest("#whole_extra_item_delete").remove();
            counter -= 1
        });
    });
</script>
<!--========== End of add multiple class with ajax ==============-->

<script>
    $(document).ready(function () {
        $('select[name="category_id"]').on('change', function () {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        var subcategorySelect = $('select[name="subcategory_id"]');
                        subcategorySelect.empty();
                        $.each(data, function (key, value) {
                            subcategorySelect.append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                        });
                    },
                });
            } else {
                alert('Please select a category.');
            }
        });
    });

</script>

<script>
    $(document).ready(function () {
        $('#myForm').validate({
            rules: {
                category_name: {
                    required: true,
                },
                course_image: {
                    required: true,
                },
                video: {
                    required: true,
                },

            },
            messages: {
                category_name: {
                    required: 'Please Enter category name',
                },
                course_image: {
                    required: 'Please Add Image',
                },
                video: {
                    required: 'Please Add Intro Video!',
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