<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Rekam Medisku</title>

    <meta name="description" content="" />

    {{-- csrf token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- font awesome icons v6 -->
    <link href="{{ asset('assets/fontawesome-free-6.2.0-web/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/fontawesome-free-6.2.0-web/css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/fontawesome-free-6.2.0-web/css/solid.css') }}" rel="stylesheet">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    {{-- select2 --}}
    <link href="/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />

    {{-- summernote --}}
    <link href="/plugins/summernote/summernote-lite.css" rel="stylesheet" type="text/css" />

    {{-- css sendiri --}}
    <link rel="stylesheet" href="{{ asset('/css/css_sendiri.css') }}">

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    {{-- jquery --}}
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    {{-- iziToast --}}
    <script src="{{ asset('plugins/iziToast/iziToast.js') }}"></script>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    {{-- datatable --}}
    <link rel="stylesheet" href="{{ asset('assets\datatable-1.12.1\jquery.dataTables.min.css') }}">

    {{-- sweertalert --}}
    <script src="{{ asset('assets/sweetalert/sweetalert2_11.js') }}"></script>

    {{-- iziToast --}}
    <link rel="stylesheet" href="{{ asset('/plugins/iziToast/iziToast.css') }}">

</head>

<body>

    <!-- Layout wrapper -->
    @if (auth()->check())
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Menu -->
                @if (auth()->user()->hasRole('admin'))
                    @include('partials.sidebar.admin_sidebar')
                @endif
                @if (auth()->user()->hasRole('tenaga_kesehatan'))
                    @include('partials.sidebar.tenaga_kesehatan_sidebar')
                @endif
                @if (auth()->user()->hasRole('pasien'))
                    @include('partials.sidebar.pasien_sidebar')
                @endif
                <!-- / Menu -->

                <!-- Layout container -->
                <div class="layout-page">
                    <!-- Navbar -->

                    @include('partials.header')

                    <!-- / Navbar -->

                    {{-- DATATABLE CONTOH --}}
                    {{-- <div class='container mt-5'>
              <div class='card'>
                <div class='card-body'>
                  <h4 style='text-align:center;'>Tabel Pengukuran Literasi</h4>
                  <div style='overflow:auto;'>
                    <table class='table table-striped datatable'>
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Ni</th>
                          <th>Nip</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore sequi eius blanditiis illo deleniti fugiat distinctio excepturi ex dolor nesciunt quibusdam, consequatur quae magni alias animi aliquam voluptates porro ab.</td>
                          <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reprehenderit atque debitis voluptatibus dignissimos, reiciendis fugit quo dicta, perferendis praesentium tempore nobis. Similique cupiditate cumque ut dolores exercitationem nobis, praesentium quo.</td>
                          <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reprehenderit atque debitis voluptatibus dignissimos, reiciendis fugit quo dicta, perferendis praesentium tempore nobis. Similique cupiditate cumque ut dolores exercitationem nobis, praesentium quo.</td>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>2</td>
                          <td>2</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div> --}}

                    @yield('container')

                    {{-- modal change password --}}
                    @include('partials.change_password')

                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
    @else
        @yield('container')
    @endif
    <!-- / Layout wrapper -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    {{-- datatable --}}
    <script src="{{ asset('assets\datatable-1.12.1\jquery.dataTables.min.js') }}"></script>

    {{-- select2 --}}
    <script src="/plugins/select2/select2.full.min.js"></script>

    {{-- summernote --}}
    <script src="/plugins/summernote/summernote-lite.js"></script>

    {{-- datatable initiate --}}
    <script>
        $(document).ready(function() {
            $('.datatable').dataTable();

        });
    </script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2();

            $(".js-example-basic-multiple-limit").select2({
                maximumSelectionLength: 99
            });

            $("select").on("select2:select", function(evt) {
                var element = evt.params.data.element;
                var $element = $(element);
                $element.detach();
                $(this).append($element);
                $(this).trigger("change");
            });
        })
    </script>

    {{-- summernote initialize --}}
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });
        })
    </script>


    {{-- alert if success or danger --}}
    @if (session()->has('success'))
        <script>
            iziToast.success({
                title: "{{ session('success') }}",
                position: 'topCenter'
            });
        </script>
    @elseif (session()->has('danger'))
        <script>
            iziToast.error({
                title: "{{ session('danger') }}",
                position: 'topCenter'
            });
        </script>
    @endif

    @if ($errors->any())
        @if ($errors->has('not_allowed'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Anda tidak memiliki akses',
                })
            </script>
        @else
            <script>
                iziToast.error({
                    title: "{!! implode('<br>', $errors->all('- :message')) !!}",
                    position: 'topCenter'
                });
            </script>
        @endif
    @endif


    {{-- ajax setup csrf token --}}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

    {{-- form onsubmit --}}
    <script>
        $('form').on('submit', function(event) {
            if (!$(this).hasClass('dont_disabled')) {
                $(this).find(":submit").prop('disabled', true);
                //  $(this).find(":submit").html('Memproses...');
            }
        });
    </script>
</body>

</html>
