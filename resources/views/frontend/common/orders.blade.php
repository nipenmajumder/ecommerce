@extends('frontend.layouts.app')
@section('title', 'My Orders')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="{{route('customer-dashboard.home')}}" class="nav-link text-white" aria-current="page">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#home"></use>
                                </svg>
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('orders.index')}}" class="nav-link text-white active" aria-current="page">
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
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Invoice</th>
                            <th scope="col" class="text-center">Total</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$order->created_at->format('d-m-Y')}}</td>
                                <td>{{$order->invoice}}</td>
                                <td class="text-center">${{number_format($order->total, 2)}}</td>
                                <td>{{$order->total_quantity}}</td>
                                <td>
                                    @if($order->status == 1)
                                        <span class="badge bg-info">Pending</span>
                                    @elseif($order->status == 2)
                                        <span class="badge bg-warning">Processing</span>
                                    @elseif($order->status == 3)
                                        <span class="badge bg-success">Delivered</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{route('orders.show', $order->id)}}" class="btn btn-sm btn-primary" title="View Order">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Orders Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
