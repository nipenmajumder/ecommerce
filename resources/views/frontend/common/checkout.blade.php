@extends('frontend.layouts.app')
@section('title', 'Checkout')
@section('content')
    <div class="row mt-3">
        <div class="col-md-6">
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" value="{{auth()->user()->name}}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email </label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                           value="{{auth()->user()->email}}">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone </label>
                    <input type="text" class="form-control" name="phone" id="phone"
                           value="{{auth()->user()->phone}}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address </label>
                    <textarea class="form-control" name="address" id="address" cols="30" rows="5">
                                        {{auth()->user()->phone}}
                                    </textarea>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <template x-for="(item, itemId) in cart.items" :key="itemId">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img :src="'/' + item.image" :alt="item.name" class="img-fluid" width="90%">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-text">
                                    <h5 class="card-title" x-text="item.name"></h5>
                                    <div class="d-flex">
                                        <p class="mb-0">Quantity: <span x-text="item.quantity"></span></p>
                                        <p class="ms-3 mb-0 me-3">Price: $<span x-text="item.sell_price"></span></p>
                                        <p class="mb-0">Subtotal: $<span x-text="(item.quantity * item.sell_price)"></span></p>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm mt-3" x-on:click="removeFromCart(item.id)">
                                    <i class="fas fa-trash me-1"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

        </div>
    </div>
@endsection

