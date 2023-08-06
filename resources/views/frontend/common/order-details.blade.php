@extends('frontend.layouts.app')
@section('title', 'Order Details')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link active" aria-current="page">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#home"></use>
                                </svg>
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('orders.index')}}" class="nav-link" aria-current="page">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#home"></use>
                                </svg>
                                Orders
                            </a>
                        </li>
                        <li>
                            <a href="{{route('customer-dashboard.logout')}}" class="nav-link text-white">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#grid"></use>
                                </svg>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="main-content">
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
                                <div class="mb-xl-0 mb-4">
                                    <div class="d-flex svg-illustration mb-3 gap-2">
                                <span class="app-brand-logo demo">
                                </span>
                                        <span
                                            class="app-brand-text demo text-body fw-bolder">{{cache()->get('settings.toArray')['site_name']}}</span>
                                    </div>
                                </div>
                                <div>
                                    <h4>Invoice #{{$order->invoice}}</h4>
                                    <div class="mb-2">
                                        <span class="me-1">Date</span>
                                        <span class="fw-semibold">{{ date('d-F-Y', strtotime($order->date)) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0">
                        <div class="card-body">
                            <div class="row p-sm-3 p-0">
                                <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                                    <h6 class="pb-2">Invoice To:</h6>
                                    <p class="mb-1">{{$order->customer->name }}</p>
                                    <p class="mb-1">{{$order->customer->address }}</p>
                                    <p class="mb-1">{{$order->customer->phone }}</p>
                                    <p class="mb-0">{{$order->customer->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table border-top m-0">
                                <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->orderDetails as $value)
                                    <tr>
                                        <td class="text-nowrap">{{$loop->iteration}}</td>
                                        <td class="text-nowrap">{{$value->product->name}}</td>
                                        <td>${{$value->sell_price}}</td>
                                        <td>{{$value->quantity}}</td>
                                        <td>${{$value->total}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="align-top px-4 py-5">
                                        <span>Thanks for your purchase</span>
                                    </td>
                                    <td class="text-end px-4 py-5">
                                        <p class="mb-2">Subtotal:</p>
                                        <p class="mb-2">Items:</p>
                                        <p class="mb-2">Vat:</p>
                                        <p class="mb-0">Total:</p>
                                    </td>
                                    <td class="px-4 py-5">
                                        <p class="fw-semibold mb-2">${{$order->subtotal}}</p>
                                        <p class="fw-semibold mb-2">{{$order->order_details_count}}</p>
                                        <p class="fw-semibold mb-2">{{$order->total_vat}}</p>
                                        <p class="fw-semibold mb-0">${{$order->total}}</p>
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
@endsection
