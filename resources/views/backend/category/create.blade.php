@extends('backend.layouts.app')
@section('title', 'Category List')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Category/</span> Category List</h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create Category</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                                @error('title')
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
