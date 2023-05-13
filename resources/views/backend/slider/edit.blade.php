@extends('backend.layouts.app')
@section('title', 'Edit Slider')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Slider/</span> Slider List</h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Slider</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('slider.update',$slider->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="title">Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{$slider->title}}">
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <img src="{{asset($slider->image)}}" alt="" class="w-100">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-success">Store</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
