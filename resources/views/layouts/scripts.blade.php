 <!-- build:js assets/vendor/js/core.js -->

 <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
 <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>
 <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
 <script src="{{ asset('/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
 <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
 <script src="{{ asset('/assets/vendor/libs/hammer/hammer.js') }}"></script>
 <script src="{{ asset('/assets/vendor/libs/i18n/i18n.js') }}"></script>
 <script src="{{ asset('/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
 <script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>

 <!-- endbuild -->

 <!-- Vendors JS -->
 <!-- Vendors JS -->
 <script src="{{ asset('/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
 <script src="{{ asset('/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
 <script src="{{ asset('/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
 <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
 <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
     integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.1/feather.min.js"
     integrity="sha512-4lykFR6C2W55I60sYddEGjieC2fU79R7GUtaqr3DzmNbo0vSaO1MfUjMoTFYYuedjfEix6uV9jVTtRCSBU/Xiw=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <!-- Main JS -->
 @if ($message = Session::get('success'))
     <script>
         toastr.options.showEasing = 'swing';
         toastr.options.hideEasing = 'linear';
         toastr.options.progressBar = true;
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
         toastr.error("Gagal", "{{ $message }}", {
             timeOut: 3000
         });
     </script>
 @endif

 @if ($message = Session::get('warning'))
     <script>
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
         toastr.error("Gagal", "{{ $err }}", {
             timeOut: 3000
         });
     </script>
 @endif
 <script>
     $('.delete-confirm').click(function(event) {
         var form = $(this).closest("form");
         var name = $(this).data("name");
         event.preventDefault();
         Swal.fire({
             title: `Apakah Anda Yakin Ingin Menghapus Data Ini ?`,
             text: "Jika dihapus maka data akan hilang permanent.",
             icon: "warning",
             buttons: true,
             dangerMode: true,
             showCancelButton: true,
             confirmButtonColor: "#554bbb",
             cancelButtonColor: "#d33",
             confirmButtonText: "Yes, Hapus Saja!"
         }).then((result) => {
             /* Read more about isConfirmed, isDenied below */
             if (result.isConfirmed) {
                 form.submit();
             }
         });
     });
 </script>
 <script src="{{ asset('/assets/js/main.js') }}"></script>

 @stack('myscript')
