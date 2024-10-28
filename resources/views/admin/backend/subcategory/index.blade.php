@extends('admin.adminDashboard')
@section('admin')



<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">All SubCategory</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">SubCategories</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{route('add.subcategory')}}" class="px-5 btn btn-primary">Add subCategory</a>
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
                            <th>Category Name</th>
                            <th>SubCategory Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategory as $key => $item)

                            <tr>
                                <td>{{ $key + 1 }}</td>

                                <td>{{$item['category']['category_name']}}</td>
                                <td>{{$item->subcategory_name}}</td>
                                <td>
                                    <a href="{{route('edit.subcategory', $item->id)}}" class="btn btn-info">Edit</a>
                                    <a href="{{route('delete.subcategory', $item->id)}}" class="btn btn-danger"
                                        id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Category Image</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection