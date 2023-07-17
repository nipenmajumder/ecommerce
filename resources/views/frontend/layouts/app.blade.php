<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ env('APP_NAME')}}</title>
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @routes
    @routes('api')
    @include('frontend.layouts.css')
    @vite([ 'resources/js/app.js'])
    @stack('css')
    <style>
        .cart-icon {
            position: fixed;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            background-color: red;
            color: white;
            width: 80px;
            height: 70px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cart-icon i {
            margin-bottom: 5px;
            font-size: 25px;
        }

        .cart-price {
            font-weight: 400;
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>
<body x-data="cart">
<div class="cart-icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
    <i class="fas fa-shopping-cart"></i>
    <span class="cart-price">$150</span>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
      x-init="getCart()" x-on:added-to-cart="getCart()">
    <div class="offcanvas-header bg-primary text-light">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Cart</h5>
        <button type="button" class="btn-close text-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="table-responsive">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <template x-for="(item, itemId) in cart.items" :key="itemId">
                    <tr>
                        <td><img :src="'/' + item.image" :alt="item.name" width="50"></td>
                        <td x-text="item.name"></td>
                        <td x-text="item.quantity"></td>
                        <td>$<span x-text="item.sell_price"></span></td>
                        <td>$<span x-text="(item.quantity * item.sell_price).toFixed(2)"></span></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm"
                                    x-on:click="removeFromCart(item.id)"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table total-table">
                    <tbody>
                    <tr>
                        <th>Subtotal:</th>
                        <td>$<span x-text="cart.sub_total"></span></td>
                    </tr>
                    <tr>
                        <th>VAT:</th>
                        <td>$<span x-text="cart.vat"></span></td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td>$<span x-text="cart.total"></span></td>
                    </tr>
                    <tr>
                        <th>Grand Total:</th>
                        <td>$<span x-text="cart.grand_total"></span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <a href="/checkout" class="btn btn-primary">Checkout</a>
            </div>
        </div>
    </div>
</div>


@include('frontend.layouts.navbar')
<main class="container">
    <x-loader></x-loader>
    @yield('content')
</main>
@include('frontend.layouts.footer')
@include('frontend.layouts.js')
@stack('js')
<script>
    function cart() {
        return {
            cart: [],
            getCart() {
                const self = this; // Store the component reference
                axios.get(route('cart.index'))
                    .then(function (response) {
                        self.cart = response.data.result;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            removeFromCart(id) {
                const self = this;
                axios.delete(route('cart.destroy', id))
                    .then(function (response) {
                        self.cart = response.data.result;
                        toastr.success(response.data.message);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
<script>
    var offcanvasRight = document.getElementById('offcanvasRight');
    var cartIcon = document.querySelector('.cart-icon');
    offcanvasRight.addEventListener('show.bs.offcanvas', function () {
        cartIcon.classList.add('hidden');
    });
    offcanvasRight.addEventListener('hide.bs.offcanvas', function () {
        cartIcon.classList.remove('hidden');
    });
</script>
</body>
</html>
