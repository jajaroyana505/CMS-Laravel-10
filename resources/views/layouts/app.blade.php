<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta
        content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
        name="viewport" />
    <link
        rel="icon"
        href="{{asset('/')}}assets/img/kaiadmin/favicon.ico"
        type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{asset('/')}}assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{asset('/')}}assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('/')}}assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{asset('/')}}assets/css/plugins.min.css" />
    <link rel="stylesheet" href="{{asset('/')}}assets/css/kaiadmin.min.css" />


    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{asset('/')}}assets/css/demo.css" />

    <!-- stuck CSS -->

    @stack('css')
</head>

<body>
    <div class="wrapper">

        <div class="main-panel">
            @yield('content')



            @include('back.layout.footer')
        </div>


        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="{{asset('/')}}assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="{{asset('/')}}assets/js/core/popper.min.js"></script>
    <script src="{{asset('/')}}assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{asset('/')}}assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


    <!-- Bootstrap Notify -->
    <script src="{{asset('/')}}assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>



    <!-- Sweet Alert -->
    <script src="{{asset('/')}}assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="{{asset('/')}}assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->


    <!-- sweetalert -->

    @stack('js')
</body>

</html>