@extends('admin.adminDashboard')
@section('admin')

<!-- Jquery is loaded Here  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">SMTP</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit SMTP</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />

    <div class="card">
        <div class="p-4 card-body">
            <h5 class="mb-4">Edit SMTP</h5>
            <form class="row g-3" method="POST" id="myForm" action="{{route('update.smtp')}}">
                @csrf
                <input type="hidden" name="id" value="{{$smtp->id}}"> /
                <div class="form-group col-md-6">
                    <label for="mailer" class="form-label">Mailer</label>
                    <input type="text" id="input1" name="mailer" value="{{$smtp->mailer}}" class="form-control rounded-lg
                    @error('mailer')
                        is-invalid
                    @enderror
                    " id="mailer" placeholder="Data Science" required>
                    @error('mailer')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="host" class="form-label">host</label>
                    <input type="text" id="input1" name="host" value="{{$smtp->host}}" class="form-control rounded-lg
                    @error('host')
                        is-invalid
                    @enderror
                    " id="host" placeholder="Data Science" required>
                    @error('host')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="port" class="form-label">port</label>
                    <input type="text" id="input1" name="port" value="{{$smtp->port}}" class="form-control rounded-lg
                    @error('port')
                        is-invalid
                    @enderror
                    " id="port" placeholder="Data Science" required>
                    @error('port')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="username" class="form-label">username</label>
                    <input type="text" id="input1" name="username" value="{{$smtp->username}}" class="form-control rounded-lg
                    @error('username')
                        is-invalid
                    @enderror
                    " id="username" placeholder="Data Science" required>
                    @error('username')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="password" class="form-label">password</label>
                    <input type="text" id="input1" name="password" value="{{$smtp->password}}" class="form-control rounded-lg
                    @error('password')
                        is-invalid
                    @enderror
                    " id="password" placeholder="Data Science" required>
                    @error('password')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="encryption" class="form-label">encryption</label>
                    <input type="text" id="input1" name="encryption" value="{{$smtp->encryption}}" class="form-control rounded-lg
                    @error('encryption')
                        is-invalid
                    @enderror
                    " id="encryption" placeholder="Data Science" required>
                    @error('encryption')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="from_address" class="form-label">from_address</label>
                    <input type="text" id="input1" name="from_address" value="{{$smtp->from_address}}" class="form-control rounded-lg
                    @error('from_address')
                        is-invalid
                    @enderror
                    " id="from_address" placeholder="Data Science" required>
                    @error('from_address')
                        <span class="text-red-500 text-bold">{{$message}}</span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <div class="gap-3 d-md-flex d-grid align-items-center">
                        <button type="submit" class="px-4 btn btn-primary">Submit</button>
                        <a href="{{route('all.category')}}" class="px-4 btn btn-light">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection