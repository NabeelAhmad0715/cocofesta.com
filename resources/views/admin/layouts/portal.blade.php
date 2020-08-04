<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        @isset($settings)
            <link rel="shortcut icon" href="{{ asset('/storage/'. $settings->favicon_icon ) }}" type="image/x-icon">
        @endisset
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $settings ? $settings->site_name : "ContentBay" }} | Admin Panel</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet">
        <link href="{{ asset("assets/css/icons/icomoon/styles.css") }}" rel="stylesheet">
        <link href="{{ asset("assets/css/bootstrap.min.css") }}" rel="stylesheet">
        <link href="{{ asset("assets/css/bootstrap_limitless.min.css") }}" rel="stylesheet">
        <link href="{{ asset("assets/css/layout.min.css") }}" rel="stylesheet">
        <link href="{{ asset("assets/css/components.min.css") }}" rel="stylesheet">
        <link href="{{ asset("assets/css/colors.min.css") }}" rel="stylesheet">
    </head>
    <body>
        <div class="page-content">
            <div class="content-wrapper">
                <div class="content d-flex justify-content-center align-items-center">
                    @yield('content')
                </div>
                <div class="navbar navbar-expand-lg navbar-light">
                    <div class="text-center d-lg-none w-100">
                        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                            <i class="icon-unfold mr-2"></i>
                            Footer
                        </button>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar-footer">
                        <span class="navbar-text">
                            &copy; 2019 {{ $settings ? $settings->site_name : "ContentBay" }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{  asset('backend/js/tinymce/js/jquery.tinymce.min.js') }}"></script>
        <script src="{{  asset('backend/js/tinymce/js/tinymce.min.js') }}"></script>
        <script src="{{  asset('backend/js/tinymce/js/init-tinymce.js') }}"></script>
        <script src="{{ asset("assets/js/main/jquery.min.js") }}"></script>
        <script src="{{ asset("assets/js/main/bootstrap.bundle.min.js") }}"></script>
        <script src="{{ asset("assets/js/plugins/loaders/blockui.min.js") }}"></script>
        <script src="{{ asset("assets/js/plugins/forms/styling/uniform.min.js") }}"></script>
        <script src="{{ asset("assets/js/app.js") }}"></script>
        <script>
            $('.form-input-styled').uniform();
        </script>
    </body>
</html>
