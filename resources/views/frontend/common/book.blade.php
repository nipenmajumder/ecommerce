@extends('frontend.layouts.app')
@section('title', 'Books')
@section('content')
    <div class="row mt-3">
        <div class="col-md-9">
            <div class="row my-2">
                <div class="col-md-6">
                    <h6 class="card-text">
                        <small class="text-muted font-weight-bold">
                            {{ $booksPaginator->firstItem() }} থেকে {{ $booksPaginator->lastItem() }} দেখাচ্ছে।
                            মোট {{ $booksPaginator->total() }} টি আইটেম পাওয়া গিয়েছে
                        </small>

                    </h6>

                </div>
                <div class="col-md-6">
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-3">
                @forelse($booksPaginator as $book)
                    <div class="col-md-3">
                        <div class="card h-100">
                            <a href="{{route('book-details-slug',$book->slug)}}">
                                <img src="{{asset($book->image)}}" class="card-img-top"
                                     alt="{{Str::limit($book->name,15)}}">
                            </a>
                            {{--                            <span--}}
                            {{--                                class="position-absolute top-0 start-25 translate-middle badge border border-light rounded-circle bg-danger p-2 mt-2">--}}
                            {{--                            30%<br>ছাড়--}}
                            {{--                        </span>--}}
                            <div class="card-body">
                                <a href="{{route('book-details-slug',$book->slug)}}"
                                   class="text-decoration-none text-black font-bold">
                                    <h5 class="card-title fs-6">{{Str::limit($book->name,11)}}</h5>
                                </a>
                                <a href="{{route('author.book',$book->author?->slug)}}"
                                   class="text-decoration-none text-black font-bold">
                                    <p class="card-text text-body-secondary fs-6">{{Str::limit($book->author?->name,13)}}</p>
                                </a>
                                <p class="card-text">
                                    {{--                                    <span class="text-decoration-line-through">460 ৳</span>--}}
                                    <span class="text-danger">{{$book->sell_price}} ৳</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="text-center">
                            কোনো বই পাওয়া যায়নি
                        </div>
                    </div>
                @endforelse

            </div>
            {{$booksPaginator->links()}}
        </div>
    </div>
@endsection
