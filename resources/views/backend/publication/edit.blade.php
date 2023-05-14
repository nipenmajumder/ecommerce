@extends('backend.layouts.app')
@section('title', 'Publication Update')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Publication/</span> Publication List</h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Update Publication</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('publication.update',$publication->id)}}"
                              enctype="multipart/form-data" class="row">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="name">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                       value="{{$publication->name}}">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="slug">Slug<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug"
                                       value="{{$publication->slug}}">
                                @error('slug')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="email">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                                       value="{{$publication->email}}">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phone">Phone<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone"
                                       value="{{$publication->phone}}">
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="address">Address<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address" placeholder="Address"
                                       name="address" value="{{$publication->address}}">
                                @error('address')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Description<span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="description" placeholder="Description"
                                          name="description">
                                   {{$publication->description}}
                                </textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
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
