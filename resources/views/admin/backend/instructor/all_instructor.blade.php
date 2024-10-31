@extends('admin.adminDashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<style>
    .large-checkbox {
        transform: scale(1.5);
    }
</style>

<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">All Instructors</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Instructors</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{route('add.instructor')}}" class="px-5 btn btn-primary">Add Instructor</a>
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
                            <th>Instructor Name</th>
                            <th>UserName</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allinstructors as $key => $item)

                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->username}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->phone}}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="btn btn-success">Active</span>
                                    @else
                                        <span class="btn btn-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="form-check-success form-check form-switch">
                                        <input class="form-check-input status-toggle large-checkbox" type="checkbox"
                                            id="flexSwitchCheckCheckedDanger" data-user-id="{{$item->id}}"
                                            {{$item->status ? 'checked' : ''}} />
                                        <label class="form-check-label" for="flexSwitchCheckCheckedDanger"></label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                    <tr>
                            <th>Sl</th>
                            <th>Instructor Name</th>
                            <th>UserName</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        $('.status-toggle').on('change', function () {
            var userId = $(this).data('user-id');
            var isChecked = $(this).is(':checked');
            $.ajax({
                url: "{{ route('update.user.status') }}",
                type: 'POST',
                data: {
                    user_id: userId,
                    status: isChecked ? 1 : 0,
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    toastr.success(response.message);
                },
                error: function (error) {
                    toastr.error('Failed to update status');
                }
            });
        });
    });
</script>



@endsection