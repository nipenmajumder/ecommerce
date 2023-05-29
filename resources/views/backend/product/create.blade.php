@extends('backend.layouts.app')
@section('title', 'Product List')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product/</span> Product List</h4>
        <div class="row">
            <div class="col-xl" id="app">
                <create-product></create-product>
            </div>
        </div>
    </div>
@endsection
