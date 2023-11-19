@extends('frontend.layouts.app')
@section('title', 'Home')
@section('content')
    <div id="carouselExampleIndicators" class="carousel slide container mt-2">
        <div class="carousel-indicators">
            @foreach($sliders as $key => $slider)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}"
                        @if($key === 0) class="active" aria-current="true"
                        @endif aria-label="Slide {{ $key + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($sliders as $key => $slider)
                <div class="carousel-item @if($key === 0) active @endif">
                    <img src="{{ asset($slider->image) }}" class="d-block w-100" alt="...">
                </div>
            @endforeach
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

    @foreach($categories as $category)
        <section>
            <p class="fs-6 border p-2 mt-3 mb-3">{{$category->name}}</p>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @if(in_array($category->id , [1, 2, 3, 4]) )
                    @foreach($category->books as $book)
                        <div class="col-md-2">
                            <div class="card h-100">
                                <a href="{{route('book-details-slug',$book->slug)}}">
                                    <img src="{{asset($book->image)}}" class="card-img-top"
                                         alt="{{Str::limit($book->name,15)}}">
                                </a>
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
                                        <span class="text-danger">{{$book->sell_price}} ৳</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach($category->fragmentBooks as $book)
                        <div class="col-md-2">
                            <div class="card h-100">
                                <a href="{{route('book-details-slug',$book->slug)}}">
                                    <img src="{{asset($book->image)}}" class="card-img-top"
                                         alt="{{Str::limit($book->name,15)}}">
                                </a>
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
                                        <span class="text-danger">{{$book->sell_price}} ৳</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                @if(count($category->books) < 6)
                    @for($i = count($category->books); $i < 6; $i++)
                        <div class="col-md-2"></div>
                    @endfor
                @endif
            </div>
            <div class="text-center mt-3">
                <a href="{{route('subject.book', $category->slug)}}">
                    <button type="button" class="btn btn-warning w-25">এই বিষয়ে সকল প্রকাশিত সকল বই</button>
                </a>
            </div>
        </section>
    @endforeach

@endsection
