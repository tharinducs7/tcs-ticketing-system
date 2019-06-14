<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ticketing System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Tharindu Chathuranga" />
    <!-- Favicon icon -->
{{-- 
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>tinymce.init({selector:'textarea'});</script>
     --}}
    <link rel="icon" href="" type="image/x-icon">
    @include('layouts.inc._styles')
    @yield('optional_css')
</head>
<body themebg-pattern="pattern1"> 
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
                        @include('layouts.inc._headernav')
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                        @include('layouts.inc._sidebar')
                </div>
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                @yield('content')
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
        @include('layouts.inc._scripts')
        @yield('after_scripts')
        @include('sweetalert::alert')
    </body>
</html>
    