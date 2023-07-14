<script src="{{asset('backend/assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('backend/assets/vendor/libs/popper/popper.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
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
<script>
    function loader(loader) {
        const appLoader = $('#loader');
        const layouts = $('#layouts');
        if (loader === true) {
            appLoader.show();
            layouts.show();
        } else if (loader === false) {
            appLoader.hide();
            layouts.hide();
        } else {
            appLoader.show();
            layouts.show();
            setTimeout(() => {
                appLoader.hide();
                layouts.hide();
            }, 500);
        }
    }
</script>
