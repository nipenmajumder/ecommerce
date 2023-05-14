@extends('backend.layouts.app')
@section('title', 'Author Update')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Author/</span> Author List</h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Update Author</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('author.update',$author->id)}}" enctype="multipart/form-data" class="row">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="name">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{$author->name}}">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="slug">Slug<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug" value="{{$author->slug}}">
                                @error('slug')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="email">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{$author->email}}">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="birthday">Birthday<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="birthday" placeholder="birthday" name="birthday" value="{{$author->birthday}}">
                                @error('birthday')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="death-day">Death-day<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="death-day" placeholder="death-day" name="death_day" value="{{$author->death_day}}">
                                @error('death_day')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="avatar">Image</label>
                                <input type="file" class="form-control" id="avatar" name="avatar">
                                @error('avatar')
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
