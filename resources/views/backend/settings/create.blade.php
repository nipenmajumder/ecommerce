@extends('backend.layouts.app')
@section('title', 'Manage Settings')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings/</span> Manage Settings</h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Manage Settings</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('settings.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="d-flex align-items-start align-items-sm-center gap-4 mb-3">
                                    @if($settings['site_logo'])
                                        <img src="{{asset($settings['site_logo'])}}" class="d-block rounded"
                                             height="100" width="100" alt="" id="logo">
                                    @else
                                        <img src="{{asset('images/blank.jpg')}}" alt="" class="d-block rounded"
                                             height="100" width="100" id="logo">
                                    @endif
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload Logo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" class="account-file-input" hidden="" id="upload"
                                                   name="site_logo"
                                                   onchange="readPicture(this)">
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="site_name">Site Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="site_name" placeholder="Site Name"
                                           name="site_name"
                                           value="{{old('site_name',$settings['site_name'] ?? '')}}">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="site_phone">Phone Number<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="site_phone" placeholder="phone"
                                           name="site_phone"
                                           value="{{old('site_phone',$settings['site_phone'] ?? '')}}">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="site_email">Email<span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="site_email" placeholder="Name"
                                           name="site_email"
                                           value="{{old('site_email',$settings['site_email'] ?? '')}}">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="vat_percentage">Vat Percentage<span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.1" class="form-control" id="vat_percentage"
                                           placeholder="Name"
                                           name="vat_percentage"
                                           value="{{old('vat_percentage',$settings['vat_percentage'] ?? '')}}">
                                </div>
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
@push('js')
    <script>
        // profile picture change
        function readPicture(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#logo')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>

@endpush
