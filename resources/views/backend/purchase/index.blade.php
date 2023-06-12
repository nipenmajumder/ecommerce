@extends('backend.layouts.app')
@section('title', 'Purchase List')
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
            <span class="text-muted fw-light">Purchase /</span> List
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
                                    <a href="{{route('purchase.create')}}">
                                        <button class="btn btn-secondary btn-primary" tabindex="0"
                                                aria-controls="DataTables_Table_0" type="button"><span><i
                                                    class="bx bx-plus me-md-1"></i><span
                                                    class="d-md-inline-block d-none">Create purchase</span></span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-2">
                            <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>
                                    <input type="search" class="form-control" placeholder="Search Invoice"
                                           aria-controls="DataTables_Table_0"></label>
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
                            <th>Invoice No</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Buy Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchases as $purchase)
                            <tr class="odd">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$purchase->date}}</td>
                                <td>{{$purchase->invoice}}</td>
                                <td>{{$purchase->total_items}}</td>
                                <td>{{$purchase->total_quantity}}</td>
                                <td>{{$purchase->total}}</td>
                                <td>
                                    @if($purchase->status == 1)
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($purchase->status == 2)
                                        <span class="badge bg-danger">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('purchase.show',$purchase->id)}}">
                                        <button @class(['btn btn-sm','btn-info' => $purchase->status == 0,'btn-success' => $purchase->status == 1,]) >
                                            <i class='bx bxs-detail mx-1'></i>
                                        </button>
                                    </a>
                                    <a>
                                        <button class="btn btn-sm btn-danger">
                                            <i class='bx bxs-trash mx-1'></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row mx-2">
                        {{$purchases->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

