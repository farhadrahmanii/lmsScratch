@extends('instructor.instructorDashboard')
@section('instructor')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Orders</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Payment Details
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Name</h6>
                                </div>

                                <div class="col-sm-9 text-secondary">
                                    {{ $payment->name }}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $payment->email }}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $payment->phone }}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $payment->address }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Payment Type</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $payment->cash_delivery }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Order Details
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Amount</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $payment->total_amount }}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">payment Type</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $payment->payment_type }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Invoice No</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $payment->invoice_no }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">date</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Carbon\Carbon::parse($payment->order_date)->diffForHumans() }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Status</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    @if ($payment->status == 'Pending')
                                        <a href="{{route('admin-confirm-order', $payment->id)}}" id="confirm"
                                            class="btn btn-success">Confirm Order <div
                                                class="spinner-grow spinner-grow-sm text-warning" role="status">
                                            </div></a>
                                    @else
                                        <a href="" class="btn btn-info">Order Confimed Already </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 ms-3">


                        <div class="table-responsive">
                            <table class="table" style="font-weight:600;">
                                <tbody>
                                    <tr class="justify-content-between">
                                        <td class="col-md-1">
                                            <label for="">Course Image</label>
                                        </td>
                                        <td class="col-md-2">
                                            <label for="">Course Name</label>
                                        </td>
                                        <td class="col-md-2">
                                            <label for="">Category</label>
                                        </td>
                                        <td class="col-md-2">
                                            <label for="">Instructor</label>
                                        </td>
                                        <td class="col-md-2">
                                            <label for="">Price</label>
                                        </td>
                                    </tr>
                                    @php
                                        $total_price = 0;
                                    @endphp
                                    @foreach ($orderItem as $item)
                                                                        <tr>
                                                                            <td class="col-md-1">
                                                                                <img src="{{asset($item->course->course_image)}}" height="50px"
                                                                                    class="rounded" />
                                                                            </td>
                                                                            <td class="col-md-2">
                                                                                <label for="">{{$item->course->course_name}}</label>
                                                                            </td>
                                                                            <td class="col-md-2">
                                                                                <label for="">{{$item->course->category->category_name}}</label>
                                                                            </td>
                                                                            <td class="col-md-2">
                                                                                <label for="">{{$item->instructor->name}}</label>
                                                                            </td>
                                                                            <td class="col-md-2">
                                                                                <label for="">{{$item->price}}</label>
                                                                            </td>
                                                                        </tr>
                                                                        @php
                                                                            $total_price += $item->price;
                                                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="4"></td>
                                        <td class="col-md-3">
                                            <strong>Total Price: {{ $total_price}}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection