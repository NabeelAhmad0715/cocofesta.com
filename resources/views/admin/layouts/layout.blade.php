<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $settings ? $settings->site_name : "ContentBay" }} | Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @isset($settings)
        <link rel="shortcut icon" href="{{ asset('/storage/'. $settings->favicon_icon) }}" type="image/x-icon">
    @endisset
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="navbar navbar-expand-md navbar-dark d-flex align-items-center flex-row" style="padding:12px 15px;">
        <div class="navbar-brand p-0" style="min-width:auto;">
            <a href="{{ route('admin.pages.home') }}">
                @isset($settings)
                    <img src="{{ asset('/storage/'. $settings->site_logo ) }}">
                @else
                    <img src="{{ asset('/backend/images/default-logo.svg') }}">
                @endisset
            </a>
        </div>
        @isset($settings)
            <div class="text-white">
                <span class="m-0 h4">
                    {{ $settings->site_name }}
                </span>
            </div>
        @else
            <div class="text-white">
                <span class="m-0 h4 font-weight-bold">
                    CONTENT
                </span>
                <span class="p-0 h4 m-0">BAY</span>
            </div>
        @endisset
        <div class="d-md-none">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-tree5"></i>
            </button>
            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                <i class="icon-paragraph-justify3"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbar-mobile">
            <span class="navbar-text ml-md-3 mr-md-auto"></span>
            <ul class="navbar-nav">
                <li class="nav-item dropdown dropdown-user">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user text-white"></i>
                        <span>
                            @auth
                            {{ Auth::user()->username }}
                            @endauth
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('admin.change-password.edit') }}" class="dropdown-item"><i class="icon-cog5"></i> Change Password</a>
                        <a href="{{ route('admin.logout') }}" class="dropdown-item"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="icon-switch2"></i>
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-content">
        <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
            <div class="sidebar-content">
                <div class="card card-sidebar-mobile">
                    <ul class="nav nav-sidebar" data-nav-type="accordion">

                        <li class="nav-item  {{ (request()->routeIs('index')) ? 'nav-item-open' : '' }}">
                            <a href="{{ route('admin.pages.home') }}" class="nav-link">
                                <i class="icon-home4"></i>
                                <span>
                                    Dashboard
                                </span>
                            </a>
                        </li>
                        <li
                            class="nav-item nav-item-submenu  {{ (request()->routeIs('types.*')) ? 'nav-item-open' : '' }}">
                            <a href="#" class="nav-link"><i class="icon-stack2"></i> <span>Types</span></a>
                            <ul class="nav nav-group-sub"
                                style="{{ (request()->routeIs('types.*')) ? "display:block;" : '' }}"
                                data-submenu-title="Pages">
                                <li class="nav-item"><a href="{{ route('types.create') }}"
                                        class="nav-link  {{ (request()->routeIs('types.create')) ? 'active' : '' }}">Add
                                        New Type</a></li>
                                <li class="nav-item"><a href="{{ route('types.index') }}"
                                        class="nav-link  {{ (request()->routeIs('types.index')) ? 'active' : '' }}">View
                                        All Types</a></li>
                            </ul>
                        </li>

                        <li
                            class="nav-item nav-item-submenu  {{ (request()->routeIs('categories.*')) ? 'nav-item-open' : '' }}">
                            <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Categories</span></a>
                            <ul class="nav nav-group-sub"
                                style="{{ (request()->routeIs('categories.*')) ? "display:block;" : '' }}"
                                data-submenu-title="Pages">
                                <li class="nav-item"><a href="{{ route('categories.create') }}"
                                        class="nav-link  {{ (request()->routeIs('categories.create')) ? 'active' : '' }}">Add
                                        New Category</a></li>
                                <li class="nav-item"><a href="{{ route('categories.index') }}"
                                        class="nav-link  {{ (request()->routeIs('categories.index')) ? 'active' : '' }}">View
                                        All Categories</a></li>
                            </ul>
                        </li>

                        @foreach ($types as $type)
                        <li
                            class="nav-item nav-item-submenu  {{ (request()->routeIs('posts.*')) && request("slug") == $type->slug ? 'nav-item-open' : '' }}">
                            <a href="#" class="nav-link"><i class="icon-pencil7"></i> <span>{{ $type->title }}</span></a>
                            <ul class="nav nav-group-sub"
                                style="{{ (request()->routeIs('posts.*')) && request("slug") == $type->slug ? "display:block;" : '' }}"
                                data-submenu-title="Pages">
                                <li class="nav-item"><a href="{{ route('posts.create',['slug' => $type->slug]) }}"
                                        class="nav-link  {{ (request()->routeIs('posts.create')) && request("slug") == $type->slug ? 'active' : '' }}">Add
                                        New {{ $type->title }}</a></li>
                                <li class="nav-item"><a href="{{ route('posts.index',['slug' => $type->slug]) }}"
                                        class="nav-link  {{ (request()->routeIs('posts.index')) && request("slug") == $type->slug ? 'active' : '' }}">View
                                        All {{ $type->title }}</a></li>
                            </ul>
                        </li>
                        @endforeach

                        <li
                            class="nav-item  {{ (request()->routeIs('contact-enquiries.*')) ? 'nav-item-open' : '' }}">
                            <a href="{{ route('contact-enquiries.index') }}" class="nav-link"><i class="icon-phone2"></i> <span>Contact Enquiries</span></a>
                        </li>

                        <li
                            class="nav-item  {{ (request()->routeIs('general-settings.*')) ? 'nav-item-open' : '' }}">
                            <a href="{{ route('general-settings.edit') }}" class="nav-link"><i class="fa fa-cogs"></i> <span>General Settings</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content-wrapper">

            @yield('content')

            <div class="navbar navbar-expand-lg navbar-light">
                <div class="text-center d-lg-none w-100">
                    <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                        data-target="#navbar-footer">
                        <i class="icon-unfold mr-2"></i>
                        Footer
                    </button>
                </div>
                <div class="navbar-collapse collapse" id="navbar-footer">
                    <span class="navbar-text">
                        &copy; 2020 {{ $settings ? $settings->site_name : "ContentBay" }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS files -->
    <script src="{{ asset('backend/js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/js/tinymce/js/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('backend/js/tinymce/js/tinymce.min.js') }}"></script>
    <script src="{{ asset('backend/js/tinymce/js/init-tinymce.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/visualization/d3/d3.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('backend/js/demo_pages//form_multiselect.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('backend/js/demo_pages/dashboard.js') }}"></script>
    <script src="{{ asset("assets/js/main/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("assets/js/plugins/loaders/blockui.min.js") }}"></script>
    <script src="{{ asset("assets/js/plugins/forms/styling/uniform.min.js") }}"></script>
    <script src="{{ asset("assets/js/plugins/notifications/pnotify.min.js") }}"></script>
    <script src="{{ asset("assets/js/plugins/forms/selects/bootstrap_multiselect.js") }}"></script>
    <script src="{{ asset("assets/js/app.js") }}"></script>
    @stack('scripts')
</body>
</html>
