@extends('instructor.instructorDashboard')
@section('instructor')

<!-- Jquery is loaded Here  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Edit Lecture</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Lecture</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{route('add.course.lecture', ['id' => $clecture->course_id])}}"
                class="px-5 btn btn-primary">Back</a>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />

    <div class="card">
        <div class="p-4 card-body">
            <h5 class="mb-4">Add Category</h5>
            <form class="row g-3" method="POST" id="myForm" enctype="multipart/form-data"
                action="{{route('update.course.lecture')}}">
                @csrf
                <input type="hidden" name="id" value="{{$clecture->id}}">
                <div class="form-group col-md-6">
                    <label for="category_name" class="form-label">Lecture Title</label>
                    <input type="text" id="input1" name="lecture_title" value="{{$clecture->lecture_title}}" class="form-control rounded-lg
                    @error('name')
                        in-valid
                    @enderror
                    " id="name" placeholder="Data Science" required>
                    @error('name')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="url" class="form-label">Video Url</label>
                    <input type="text" id="input1" name="url" name="url" value="{{$clecture->url}}" class="form-control rounded-lg
                    @error('name')
                        in-valid
                    @enderror
                    " id="name" placeholder="Data Science" required>
                    @error('name')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-md-12">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" class="form-control rounded-lg
                    @error('content')
                        in-valid
                    @enderror
                    " id="content" placeholder="Data Science" required>{{$clecture->content}}</textarea>
                    @error('content')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="gap-3 d-md-flex d-grid align-items-center">
                        <button type="submit" class="px-4 btn btn-primary">Submit</button>
                        <a href="{{route('add.course.lecture', $clecture->id)}}" class="px-4 btn btn-light">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection