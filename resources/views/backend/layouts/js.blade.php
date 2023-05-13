<script src="{{asset('backend/assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('backend/assets/vendor/libs/popper/popper.js')}}"></script>
<script src="{{asset('backend/assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('backend/assets/vendor/js/menu.js')}}"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="{{asset('backend/toaster/js/toastr.min.js')}}"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "200",
        "hideDuration": "4000",
        "timeOut": "2000",
        "extendedTimeOut": "200",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    @if (Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
    @endif
    @if (Session::has('error'))
    toastr.error("{{ Session::get('error') }}");
    @endif
    @if (Session::has('info'))
    toastr.info("{{ Session::get('info') }}");
    @endif
    @if (Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}");
    @endif
</script>
