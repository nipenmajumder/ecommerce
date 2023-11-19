<footer class="bg-dark p-3 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 p-2 text-light">
                <img src="{{asset(asset(\App\Models\Settings::get('site_logo')))}}" class="img-fluid" width="90" alt="">
                <p>Book Heaven is a leading book shop in Bangladesh. We offer thousands of books at discounted
                    price. </p>
            </div>
            <div class="col-lg-3 p-2 text-light">
                <h5>প্রয়োজনীয় লিংক</h5>

                <nav class="nav flex-column">
                    <a class="nav-link text-white" href="{{url('/')}}">যোগাযোগ করুন</a>
                    <a class="nav-link text-white" href="{{url('/')}}">শর্তাবলী</a>
                </nav>
            </div>
            <div class="col-lg-3 p-2 text-light">
                <h5>জনপ্রিয়</h5>
                <nav class="nav flex-column">
                    <a class="nav-link text-white" href="{{route('checkout.index')}}">আপনার পছন্দের তালিকা</a>
                    <a class="nav-link text-white" href="{{url('/')}}">জেনারেল ও অ্যাকাডেমিক বই</a>
                </nav>
            </div>
            <div class="col-lg-3 p-2 text-light">
                <h5>যোগাযোগ</h5>
                <nav class="nav flex-column">
                    <a class="nav-link text-white" href="#">Head Office: House 310, Road 21
                        Mohakhali DOHS, Dhaka-1206</a>
                    <a class="nav-link text-white" href="#">Phone:
                        017-9992-5050 096-7877-1365</a>
                    <a class="nav-link text-white" href="#">sales@bookheaven.com</a>
                </nav>
            </div>
        </div>
    </div>
</footer>
