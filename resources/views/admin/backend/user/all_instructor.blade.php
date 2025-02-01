@extends('admin.adminDashboard')
@section('admin')



<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">All Intructor</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Instructor</li>
                </ol>
            </nav>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>Phone</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($instructor as $key => $item)

                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img src="{{ !empty($item->photo) ? url('upload/instructor_images/' . $item->photo) : url('upload/default.png') }}"
                                        class="rounded" alt="" height="100px" width="100px" /></td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->phone}}</td>
                                <td>
                                    @if ($item->UserOnline())
                                        <span class="badge badge-pill bg-success">
                                            Active Now
                                        </span>
                                    @else
                                        <span class="badge badge-pill bg-danger">
                                            {{ Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>Phone</th>
                            <th>status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection