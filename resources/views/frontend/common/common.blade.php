@extends('frontend.layouts.app')
@section('title', 'Home')
@section('content')
    <div class="container mt-3">
        @switch(request()->route()->getName())
            @case('subjects')
                <h1 class="fs-2 border-warning">বিষয় সমূহ</h1>
                @break
            @case('publications')
                <h1 class="fs-2 border-warning">প্রকাশনা সমূহ</h1>
                @break
            @case('authors')
                <h1 class="fs-2 border-warning">লেখক সমূহ</h1>
                @break
        @endswitch
        <form class="form-inline" method="get" action="{{request()->route()->getName()}}">
            <div class="input-group mb-3 w-25">
                <input type="search" class="form-control" placeholder="অনুসন্ধান করুন" name="name"
                       aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Button</button>
            </div>
        </form>
        <div class="row">
            @foreach($data as $value)
                <div class="col-lg-4">
                    <div class="list-group list-group-flush">
                        @switch(request()->route()->getName())
                            @case('subjects')
                                <a href="{{route('subject.book', $value->slug)}}"
                                   class="list-group-item list-group-item-action border-start border-warning border-3 border-bottom-0 border-top-0 border-end-0 mb-2 fw-bold">
                                    {{ $value->name }}
                                </a>
                                @break
                            @case('publications')
                                <a href="{{route('publication.book', $value->slug)}}"
                                   class="list-group-item list-group-item-action border-start border-warning border-3 border-bottom-0 border-top-0 border-end-0 mb-2 fw-bold">
                                    {{ $value->name }}
                                </a>
                                @break
                            @case('authors')
                                <a href="{{route('author.book', $value->slug)}}"
                                   class="list-group-item list-group-item-action border-start border-warning border-3 border-bottom-0 border-top-0 border-end-0 mb-2 fw-bold">
                                    {{ $value->name }}
                                </a>
                                @break
                        @endswitch
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
