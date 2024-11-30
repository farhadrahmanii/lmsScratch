@extends('instructor.instructorDashboard')
@section('instructor')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">All Pending Orders</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Pending Orders</li>
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
                        @foreach ($orders as $key => $item)

                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{$item->payment->order_date}}</td>
                                            <td>{{$item->payment->invoice_no}}</td>
                                            <td>{{$item->payment->total_amount}}</td>
                                            <td>{{$item->payment->payment_type}}</td>
                                            <td>
                                                @if ($item->payment->status == 'Pending')
                                                                        <a href="" class="btn btn-outline-info position-relative me-lg-5"> <i
                                                                                class="bx bx-bell align-middle"></i> {{$item->payment->status}} {!! $item->payment->created_at->isToday() || $item->created_at->isYesterday()
                                                    ? '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">New</span>'
                                                    : '' !!}
                                                                        </a>
                                                @else
                                                                        <a href="" class="btn btn-outline-success position-relative me-lg-5"> <i
                                                                                class="bx bx-bell align-middle"></i> {{$item->payment->status}} {!! $item->payment->created_at->isToday() || $item->created_at->isYesterday()
                                                    ? '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">New</span>'
                                                    : '' !!}
                                                                        </a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-info"><i class="lni lni-eye"></i></a>
                                                <a href="#" class="btn btn-danger"><i class="lni lni-download"></i></a>
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