    <!-- Vendor -->
    <script src="{{ asset('assets/vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('assets/master/style-switcher/style.switcher.js') }}"></script>
    <script src="{{ asset('assets/vendor/popper/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/common/common.js') }}"></script>
    <script src="{{ asset('assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
    <script src="{{ asset('assets/vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
    <!-- Specific Page Vendor -->
    @stack('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script type="text/javascript">
            let successTime;
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                timer: 5000,
                icon: 'success',
                timerProgressBar: true,
                confirmButtonText: 'Oke',
                didOpen: () => {
                    successTime = setInterval(() => {}, 100)
                },
                willClose: () => {

                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {

                }
            });
        </script>
    @endif
    @if (session('failed'))
        <script type="text/javascript">
            let failedTime;
            Swal.fire({
                title: "Fail!",
                text: "{{ session('failed') }}",
                timer: 500000,
                icon: 'error',
                timerProgressBar: true,
                confirmButtonText: 'Oke',
                didOpen: () => {
                    failedTime = setInterval(() => {}, 100)
                },
                willClose: () => {

                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {

                }
            });
        </script>
    @endif
    <!-- Theme Base, Components and Settings -->
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <!-- Theme Custom -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- Theme Initialization Files -->
    <script src="{{ asset('assets/js/theme.init.js') }}"></script>
    <script src="{{ asset('assets/js/time.js') }}"></script>
    </body>

    <!-- Mirrored from www.okler.net/previews/porto-admin/4.1.0/layouts-default.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Jan 2024 06:19:22 GMT -->

    </html>
