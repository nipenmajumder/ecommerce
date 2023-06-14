@extends('frontend.layouts.app')
@section('title', 'Home')
@section('content')
    <div class="container mt-5">
        @if(request()->route()->getName() === 'subjects')
            <h1 class="fs-2 border-warning">বিষয় সমূহ</h1>
        @endif
        @if(request()->route()->getName() === 'publications')
            <h1 class="fs-2 border-warning">প্রকাশনা সমূহ</h1>
        @endif
        @if(request()->route()->getName() === 'writers')
            <h1 class="fs-2 border-warning">লেখক সমূহ</h1>
        @endif

        <div class="input-group mb-3 w-25">
            <input type="text" class="form-control" placeholder="বিষয় সমূহ অনুসন্ধান করুন"
                   aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
        </div>
        <div class="row">
            @foreach($data as $value)
                <div class="col-lg-4">
                    <div class="list-group list-group-flush">
                        <a href="{{route('subject.book',$value->slug)}}"
                           class="list-group-item list-group-item-action border-start border-warning border-3 border-bottom-0 border-top-0 border-end-0 mb-2 fw-bold">
                            {{ $value->name }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
