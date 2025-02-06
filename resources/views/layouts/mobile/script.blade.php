<!-- ///////////// Js Files ////////////////////  -->
<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap-->
<script src="{{ asset('assets/template/js/lib/popper.min.js') }}"></script>
<script src="{{ asset('assets/template/js/lib/bootstrap.min.js') }}"></script>
<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- Owl Carousel -->
{{-- <script src="{{ asset('') }}assets/js/plugins/owl-carousel/owl.carousel.min.js"></script> --}}
<!-- jQuery Circle Progress -->
<script src="{{ asset('assets/template/js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
<script src="{{ asset('assets/template/js/maskMoney.js') }}"></script>
<!-- Base Js File -->
<script src="{{ asset('assets/template/js/base.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/rolldate@3.1.3/dist/rolldate.min.js"></script>
<script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/swiper/swiper-bundle.min.js') }}"></script>
<style>
    .toast-bottom-full-width {
        bottom: 5rem
    }
</style>
<script>
    var swiper1 = new Swiper(".cardswiper", {
        slidesPerView: "auto",
        spaceBetween: 0,
        pagination: false
    });

    /* swiper carousel connectionwiper */
    var swiper2 = new Swiper(".connectionwiper", {
        slidesPerView: "auto",
        spaceBetween: 0,
        pagination: false
    });
</script>
@if ($message = Session::get('success'))
    <script>
        toastr.options.showEasing = 'swing';
        toastr.options.hideEasing = 'linear';
        toastr.options.progressBar = true;
        toastr.options.positionClass = 'toast-top-full-width';
        toastr.success("Berhasil", "{{ $message }}", {
            timeOut: 3000
        });
    </script>
@endif

@if ($message = Session::get('error'))
    <script>
        toastr.options.showEasing = 'swing';
        toastr.options.hideEasing = 'linear';
        toastr.options.progressBar = true;
        toastr.options.positionClass = 'toast-bottom-full-width';
        toastr.error("Gagal", "{{ $message }}", {
            timeOut: 3000
        }); <
        />
        @endif

        @if ($message = Session::get('warning'))
            <
            script >
                toastr.options.showEasing = 'swing';
            toastr.options.hideEasing = 'linear';
            toastr.options.progressBar = true;
            toastr.warning("Warning", "{{ $message }}", {
                timeOut: 3000
            });
    </script>
@endif

@if ($errors->any())
    @php
        $err = '';
    @endphp
    @foreach ($errors->all() as $error)
        @php
            $err .= $error;
        @endphp
    @endforeach
    <script>
        toastr.options.showEasing = 'swing';
        toastr.options.hideEasing = 'linear';
        toastr.options.progressBar = true;
        // toastr.options.positionClass = 'toast-top-center';
        toastr.error("Gagal", "{{ $err }}", {
            timeOut: 3000
        });
    </script>
@endif
@stack('myscript')
