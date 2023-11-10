@extends('backend.layouts.app')
@section('title', 'Dashboard')
@push('css')
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/libs/apex-charts/apex-charts.css')}}"/>
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Congratulations {{auth()->user()->name}}! 🎉</h5>
                                <p class="mb-4">
                                    You have got <span class="fw-bold">{{$orderCount}}</span> more sales today.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-1">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Total Categories</span>
                                <h3 class="card-title mb-2">{{$totalBooks}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Total Publications</span>
                                <h3 class="card-title mb-2">{{$totalBooks}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Total Authors</span>
                                <h3 class="card-title mb-2">{{$totalBooks}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Total Books</span>
                                <h3 class="card-title mb-2">{{$totalBooks}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Total Purchases</span>
                                <h3 class="card-title mb-2">{{$totalBooks}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Stock Books </span>
                                <h3 class="card-title mb-2">{{$totalStock}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Sold Books </span>
                                <h3 class="card-title mb-2">{{$totalSold}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Total Stock Price</span>
                                <h3 class="card-title mb-2">{{$totalStockPrice}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Total Stock Price</span>
                                <h3 class="card-title mb-2">{{$totalSoldBooksPrice}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('backend/assets/js/main.js')}}"></script>
@endpush
