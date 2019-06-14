<!DOCTYPE html>
<html lang="en">
<head>
    <title> TCS Ticketing System </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Wysheit Technologies." />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <!-- Favicon icon -->
    <link rel="icon" href="" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files') }}/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files') }}/assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files') }}/assets/icon/icofont/css/icofont.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files') }}/assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files') }}/assets/css/style.css">
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <!-- Pre-loader end -->

    @yield('content')


    <script  src="{{ asset('files') }}/bower_components/jquery/js/jquery.min.js"></script>
    <script  src="{{ asset('files') }}/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script  src="{{ asset('files') }}/bower_components/popper.js/js/popper.min.js"></script>
    <script  src="{{ asset('files') }}/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script  src="{{ asset('files') }}/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script  src="{{ asset('files') }}/bower_components/modernizr/js/modernizr.js"></script>
    <script  src="{{ asset('files') }}/bower_components/modernizr/js/css-scrollbars.js"></script>
    <!-- i18next.min.js -->
    <script  src="{{ asset('files') }}/bower_components/i18next/js/i18next.min.js"></script>
    <script  src="{{ asset('files') }}/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script  src="{{ asset('files') }}/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script  src="{{ asset('files') }}/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <script  src="{{ asset('files') }}/assets/js/common-pages.js"></script>
</body>
</html>
