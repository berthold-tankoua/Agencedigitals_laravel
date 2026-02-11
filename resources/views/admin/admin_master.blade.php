<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="AgenceDigitals">

    <link href="{{ asset('frontend/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('frontend/img/favicon.png') }}" rel="apple-touch-icon">

    <title> @yield('title') </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/skin_color.css') }}">

    <style>
        .toast {
            background-color: #030303 !important;
        }

        .toast-info {
            background-color: #3276b1 !important;
        }

        .toast-info2 {
            background-color: #2f96b4 !important;
        }

        .toast-error {
            background-color: #bd362f !important;
        }

        .toast-success {
            background-color: #51a351 !important;
        }

        .toast-warning {
            background-color: #f89406 !important;
        }
    </style>

</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

    <div class="wrapper">

        @include('admin.body.header')

        <!-- Left side column. contains the logo and sidebar -->
        @include('admin.body.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @yield('admin')

        </div>
        <!-- /.content-wrapper -->

        @include('admin.body.footer')

        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->


    <!-- Vendor JS -->
    <script src="{{ asset('backend/js/vendors.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/../assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('backend/../assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}">
    </script>
    <script
        src="{{ asset('backend/../assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}">
    </script>
    <script src="{{ asset('backend/../assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
    <script src="{{ asset('backend/../assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>

    <!-- // CK EDITOR  -->
    <script src="{{ asset('../assets/vendor_components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('../assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>
    <script src="{{ asset('backend/js/pages/editor.js') }}"></script>

    <!-- table JS -->
    <script src="{{ asset('backend/../assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/js/pages/data-table.js') }}"></script>

    <!---- Marketplace Admin App ----->
    <script src="{{ asset('backend/js/template.js') }}"></script>
    <script src="{{ asset('backend/js/pages/dashboard.js') }}"></script>

    {{-- JS SCRIPTS  --}}
    <script>
        @if (Session::has('message'))

            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ")
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ")
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ")
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ")
                    break;
            }
        @endif
    </script>

    <script type="text/javascript">
        $(function() {
            $(document).on('click', '#delete', function(e) {
                e.preventDefault();
                var link = $(this).attr("href");

                Swal.fire({
                    title: 'Etes-vous sûr?',
                    text: "Supprimer cette publication",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, Supprimer!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                            'Supprimer!',
                            'Votre publication a été supprimé.',
                            'success'
                        )
                    }
                }); //end sweet alert script
            });
        }); //end script
    </script>

    @stack('scripts')
</body>

</html>
