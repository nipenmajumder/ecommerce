@extends('backend.layouts.app')
@section('title', 'Order List')
@push('css')
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet"
          href="{{asset('backend/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
    <link rel="stylesheet"
          href="{{asset('backend/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Order /</span> List
        </h4>
        <div class="card">
            <div class="card-datatable table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row ms-2 me-3">
                        <div
                            class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-2">
                            <div class="dataTables_length" id="DataTables_Table_0_length"><label><select
                                        name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"
                                        class="form-select">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select></label></div>
                            <div
                                class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3">
                                <div class="dt-buttons btn-group flex-wrap">
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-2">
                            <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>
                                    <input type="search" class="form-control" placeholder="Search Invoice" aria-controls="DataTables_Table_0"></label>
                            </div>
                            <div class="invoice_status mb-3 mb-md-0">
                                <select id="UserRole" class="form-select">
                                    <option value=""> Select Status</option>
                                    <option value="Downloaded" class="text-capitalize">Downloaded</option>
                                    <option value="Draft" class="text-capitalize">Draft</option>
                                    <option value="Paid" class="text-capitalize">Paid</option>
                                    <option value="Partial Payment" class="text-capitalize">Partial Payment</option>
                                    <option value="Past Due" class="text-capitalize">Past Due</option>
                                    <option value="Sent" class="text-capitalize">Sent</option>
                                </select></div>
                        </div>
                    </div>
                    <table class="invoice-list-table table border-top dataTable no-footer dtr-column"
                           id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1042px;">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Date</th>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr class="odd">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$order->date}}</td>
                                <td>{{$order->invoice}}</td>
                                <td>
                                    <span>{{$order->customer->name}}</span>
                                    <span>{{$order->customer->phone}}</span>
                                    <span>{{$order->customer->email}}</span>
                                </td>
                                <td>
                                    {{$order->total_quantity}}
                                </td>
                                <td>
                                    {{$order->total}}
                                </td>
                                <td>
                                    @if($order->status == 1)
                                        <span class="badge bg-info">Pending</span>
                                    @elseif($order->status == 2)
                                        <span class="badge bg-warning">Processing</span>
                                    @elseif($order->status == 3)
                                        <span class="badge bg-success">Delivered</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('order.edit',$order->id)}}">
                                        <button class="btn btn-sm btn-primary">
                                            <i class='bx bxs-envelope-open mx-1'></i>
                                        </button>
                                    </a>
                                    <a href="{{route('order.show',$order->id)}}">
                                        <button @class(['btn btn-sm','btn-info' => $order->status == 0,'btn-success' => $order->status == 1,]) >
                                            <i class='bx bx-sync mx-1'></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row mx-2">
                        {{$orders->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

