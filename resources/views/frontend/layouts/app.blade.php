<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ env('APP_NAME')}}</title>
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @routes
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('frontend.layouts.css')
    @stack('css')
</head>

<body>
@include('frontend.layouts.navbar')

<main class="container">
    <!-- slider -->
    <div id="carouselExampleIndicators" class="carousel slide container mt-2">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('frontend/image/banner/azan-10-discount_mainDesktop-min.webp')}}"
                     class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('frontend/image/banner/maktabatul_qalab_s2_mainDesktop-min.webp')}}"
                     class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('frontend/image/banner1.jpg')}}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section>
        <p class="fs-6 border p-2 mt-3 mb-3">বইমেলা ২০২৩ এর নতুন বই</p>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col-md-2">
                <div class="card h-100">
                    <img src="{{asset('frontend/image/banner/340821389_149637451389361_395511-192x254.webp')}}"
                         class="card-img-top"
                         alt="..."><span
                        class="position-absolute top-0 start-25 translate-middle badge border border-light rounded-circle bg-danger p-2 mt-2">30%
                            <br>
                            ছাড়</span>
                    <div class="card-body">
                        <h5 class="card-title fs-6">রুকইয়াহ</h5>
                        <p class="card-text text-body-secondary fs-6">আবদুল্লাহ আল মাসউদ</p>
                        <p class="card-text"><span class="text-decoration-line-through">460 ৳</span> <span
                                class="text-danger">322 ৳</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card h-100">
                    <img src="{{asset('frontend/image/banner/Nobijir-duwa-Cover-Font-192x254.webp')}}"
                         class="card-img-top"
                         alt="..."><span
                        class="position-absolute top-0 start-25 translate-middle badge border border-light rounded-circle bg-danger p-2 mt-2">30%
                            <br>
                            ছাড়</span>
                    <div class="card-body">
                        <h5 class="card-title fs-6">রুকইয়াহ</h5>
                        <p class="card-text text-body-secondary fs-6">আবদুল্লাহ আল মাসউদ</p>
                        <p class="card-text"><span class="text-decoration-line-through">460 ৳</span> <span
                                class="text-danger">322 ৳</span></p>
                    </div>

                </div>
            </div>
            <div class="col-md-2">
                <div class="card h-100">
                    <img src="{{asset('frontend/image/banner/muslim-sisthachar-1-192x254.webp')}}" class="card-img-top"
                         alt="..."><span
                        class="position-absolute top-0 start-25 translate-middle badge border border-light rounded-circle bg-danger p-2 mt-2">30%
                            <br>
                            ছাড়</span>
                    <div class="card-body">
                        <h5 class="card-title fs-6">রুকইয়াহ</h5>
                        <p class="card-text text-body-secondary fs-6">আবদুল্লাহ আল মাসউদ</p>
                        <p class="card-text"><span class="text-decoration-line-through">460 ৳</span> <span
                                class="text-danger">322 ৳</span></p>
                    </div>

                </div>
            </div>
            <div class="col-md-2">
                <div class="card h-100">
                    <img src="{{asset('frontend/image/banner/otut-pathor-192x254.webp')}}" class="card-img-top"
                         alt="..."><span
                        class="position-absolute top-0 start-25 translate-middle badge border border-light rounded-circle bg-danger p-2 mt-2">30%
                            <br>
                            ছাড়</span>
                    <div class="card-body">
                        <h5 class="card-title fs-6">রুকইয়াহ</h5>
                        <p class="card-text text-body-secondary fs-6">আবদুল্লাহ আল মাসউদ</p>
                        <p class="card-text"><span class="text-decoration-line-through">460 ৳</span> <span
                                class="text-danger">322 ৳</span></p>
                    </div>

                </div>
            </div>
            <div class="col-md-2">
                <div class="card h-100">
                    <img src="{{asset('frontend/image/banner/rukiyah-02-192x254.webp')}}" class="card-img-top"
                         alt="..."><span
                        class="position-absolute top-0 start-25 translate-middle badge border border-light rounded-circle bg-danger p-2 mt-2">30%
                            <br>
                            ছাড়</span>
                    <div class="card-body">
                        <h5 class="card-title fs-6">রুকইয়াহ</h5>
                        <p class="card-text text-body-secondary fs-6">আবদুল্লাহ আল মাসউদ</p>
                        <p class="card-text"><span class="text-decoration-line-through">460 ৳</span> <span
                                class="text-danger">322 ৳</span></p>
                    </div>

                </div>
            </div>
            <div class="col-md-2">
                <div class="card h-100">
                    <img src="{{asset('frontend/image/banner/WhatsApp-Image-2023-04-16-at-17.38.39-192x254.jpg')}}"
                         class="card-img-top"
                         alt="..."><span
                        class="position-absolute top-0 start-25 translate-middle badge border border-light rounded-circle bg-danger p-2 mt-2">30%
                            <br>
                            ছাড়</span>
                    <div class="card-body">
                        <h5 class="card-title fs-6">রুকইয়াহ</h5>
                        <p class="card-text text-body-secondary fs-6">আবদুল্লাহ আল মাসউদ</p>
                        <p class="card-text"><span class="text-decoration-line-through">460 ৳</span> <span
                                class="text-danger">322 ৳</span></p>
                    </div>
                </div>
            </div>
            <button type="button" class="btn bg-warning w-25 mx-auto">সকল নতুন প্রকাশিত বই</button>
        </div>
    </section>
</main>

@include('frontend.layouts.footer')
@include('frontend.layouts.js')
@stack('js')
</body>
</html>
