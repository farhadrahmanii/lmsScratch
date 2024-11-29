@extends('admin.adminDashboard')
@section('admin')



<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">All Confirm Orders</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Confirm Orders</li>
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
                            <th>Date</th>
                            <th>Invoice No</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payment as $key => $item)

                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{$item->order_date}}</td>
                                                <td>{{$item->invoice_no}}</td>
                                                <td>{{$item->total_amount}}</td>
                                                <td>{{$item->payment_type}}</td>
                                                <td>
                                                    <a href="" class="btn btn-outline-info position-relative me-lg-5"> <i
                                                            class="bx bx-bell align-middle"></i> {{$item->status}}
                                                        {!! $item->created_at->isToday() || $item->created_at->isYesterday()
                            ? '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">New</span>'
                            : '' !!}

                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{route('admin.order.detail', $item->id)}}" class="btn btn-info">Details</a>
                                                </td>
                                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Date</th>
                            <th>Invoice No</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection