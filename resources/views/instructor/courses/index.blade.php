@extends('instructor.instructorDashboard')
@section('instructor')



<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">All Courses</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Course</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{route('add.course')}}" class="px-5 btn btn-primary">Add Course</a>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Course Image</th>
                            <th>Course Name</th>
                            <th>Category</th>
                            <th>price</th>
                            <th>discount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($course as $key => $item)

                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img src="{{ asset($item->course_image) }}"
                                        style="object-fit: cover; height: 100px; width: 100px;" class="rounded" alt=""
                                        height="100%" width="100px" /></td>
                                <td>{{$item->course_name}}</td>
                                <td>{{$item['category']['category_name']}}</td>

                                <td>{{$item->selling_price}}</td>
                                <td>{{$item->discount_price}}</td>
                                <td>
                                    <a href="{{route('edit.course', $item->id)}}" title="Edit Course"
                                        class="btn btn-info"><i class="lni lni-eraser"></i></a>
                                    <a href="{{route('delete.course', $item->id)}}" title="Delete Course"
                                        class="btn btn-danger" id="delete"><i class="lni lni-trash"></i></a>
                                    <a href="{{route('add.course.lecture', $item->id)}}" title="Lecture"
                                        class="btn btn-warning"><i class="lni lni-list"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Course Image</th>
                            <th>Course Name</th>
                            <th>Category</th>
                            <th>price</th>
                            <th>discount</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection