@extends('admin.adminDashboard')
@section('admin')
<style>
    .form-check-label {
        text-transform: capitalize
    }
</style>

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
                    <li class="breadcrumb-item active" aria-current="page">Add Roles Permission</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{route('all.roles.permission')}}" class="px-5 btn btn-primary">Cancel</a>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />

    <div class="card">
        <div class="p-4 card-body">
            <h5 class="mb-4">Add Permissions</h5>
            <form class="row g-3" method="POST" id="myForm" enctype="multipart/form-data"
                action="{{route('update.rolepermission', $role->id)}}">
                @csrf

                <div class="form-group col-md-6">
                    <label for="role_id" class="form-label">Roles Name</label>
                    <h4>{{$role->name}}</h4>
                </div>



                <div class="form-check form-check-success">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckMain">
                    <label class="form-check-label" for="flexCheckMain">
                        Success checkbox
                    </label>
                </div>


                <hr>
                @foreach ($permission_group as $group)
                                <div class="row">
                                    <div class="col-3">

                                        @php
                                            $permissions = App\Models\User::getPermissionByGroupName($group->group_name)
                                        @endphp
                                        <div class="form-check form-check-success">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckSuccess" {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : ''}}>
                                            <label class="form-check-label" for="flexCheckSuccess">
                                                {{ $group->group_name}}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-9">

                                        @foreach ($permissions as $permission)

                                            <div class="form-check form-check-success">
                                                <input class="form-check-input" type="checkbox" value="{{$permission->id}}"
                                                    name="permission[]" id="CheckSuccess{{$permission->id}}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="CheckSuccess{{$permission->id}}">
                                                    {{ $permission->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                @endforeach


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
    $('#flexCheckMain').click(function () {
        if ($(this).is(':checked')) {
            $('input[type=checkbox]').prop('checked', true);
        } else {
            $('input[type=checkbox]').prop('checked', false);
        }
    })
</script>
@endsection