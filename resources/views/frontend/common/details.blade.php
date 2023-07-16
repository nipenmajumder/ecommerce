@extends('frontend.layouts.app')
@section('title', $book->name)
@section('content')
    <div class="mt-3">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{asset($book->image)}}"
                             class="img-fluid w-100" alt="">
                    </div>
                    <div class="col-md-8">
                        <h5>{{$book->name}}</h5>
                        <a href="{{route('author.book',$book->author->slug)}}" class="text-decoration-none bg-white">
                            <p class="text-danger">লেখক: {{$book->author->name}}</p>
                        </a>
                        <a href="{{route('publication.book',$book->publication->slug)}}"
                           class="text-decoration-none bg-white">
                            <p class="text-danger">প্রকাশনী: {{$book->publication->name}}</p>
                        </a>
                        <a href="{{route('subject.book',$book->category->slug)}}" class="text-decoration-none bg-white">
                            <p class="text-danger">বিষয়: {{$book->category->name}}</p>
                        </a>

                        <p>{{$book->description}}</p>
                        <h4>{{$book->sell_price}} ৳
                            <del>460</del>
                            ৳(30% ছাড়ে)
                        </h4>
                        <a class="text-decoration-none" onclick="addToCart()">
                            <button type="button" class="btn btn-danger mt-2">অর্ডার করুন</button>
                        </a>
                    </div>

                    <p class="fs-6 border p-2 mt-3">যে পণ্যগুলি দেখেছেন</p>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($publicationBooks as $publicationBook)
                            <div class="col-md-3">
                                <div class="card h-100">
                                    <img
                                        src="{{asset($publicationBook->image)}}"
                                        class="card-img-top" alt="..."><span
                                        class="position-absolute top-0 start-25 translate-middle badge border border-light rounded-circle bg-danger p-2 mt-2">30%
                                        <br>
                                        ছাড়</span>
                                    <div class="card-body">
                                        <a href="{{route('book-details-slug',$publicationBook->slug)}}"
                                           class="text-decoration-none text-black ">
                                            <h5 class="card-title fs-6">{{Str::limit($publicationBook->name,20)}}</h5>
                                        </a>
                                        <a href="{{route('author.book',$publicationBook->author->slug)}}"
                                           class="text-decoration-none bg-white">
                                            <p class="card-text text-body-secondary fs-6">
                                                লেখক: {{$publicationBook->author->name}}</p>
                                        </a>
                                        <p class="card-text"><span class="text-decoration-line-through">460 ৳</span>
                                            <span class="text-danger">{{$publicationBook->sell_price}} ৳</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <h6 class="mb-3">আরো দেখুন…</h6>
                @foreach($relatedBooks as $relatedBook)
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{asset($relatedBook->image)}}"
                                     class="img-fluid m-2 rounded-start"
                                     alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <a class="text-decoration-none text-black"
                                       href="{{route('book-details-slug',$relatedBook->slug)}}">
                                        <h6 class="card-title text-black">{{Str::limit($relatedBook->name,15)}}</h6>
                                    </a>
                                    <p class="card-text">
                                        <a class="text-decoration-none text-black"
                                           href="{{route('publication.book',$relatedBook->publication->slug)}}">
                                            <small
                                                class="text-body-secondary">{{$relatedBook->publication->name}}</small>
                                        </a>
                                    </p>
                                    <p class="card-text"><small
                                            class="text-body-secondary ">{{$relatedBook->sell_price}} ৳</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function addToCart() {
            {{--if ({{$book->total_stock=== 0}}) {--}}
            {{--    alert('দুঃখিত, পণ্যটি স্টকে নেই');--}}
            {{--    return;--}}
            {{--}--}}
            loader(true);
            axios.post('{{route('cart.store')}}', {
                product: {!! json_encode(Arr::except($book, ['author', 'publication', 'category'])) !!}
            })
                .then(response => {
                    loader(false);
                    toastr.success(response.data.message);
                    document.dispatchEvent(new CustomEvent('added-to-cart'));
                })
                .catch(error => {
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endpush
