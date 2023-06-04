@extends('backend.layouts.app')
@section('title', 'New Purchase')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Product /</span> List
        </h4>
        <div class="card" id="app">
            <div class="card-body">
                <create-purchase
                    :date="{{json_encode($date)}}"
                    :invoice="{{json_encode($invoice)}}"
                    :user="{{json_encode($user)}}"
                ></create-purchase>
            </div>
        </div>
    </div>
@endsection
