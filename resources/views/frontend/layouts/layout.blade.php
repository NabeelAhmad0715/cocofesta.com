<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @yield('head')
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="author" content="Coco Festa" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta
          name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1"
        />

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
        <!-- font -->
        <link
          rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,500,500i,600,700,800,900|Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900"
        />
        <link
          rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700,800"
        />

        <!-- Plugins -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins-css.css') }}" />

        <!-- revoluation -->
        <link rel="stylesheet" type="text/css" href="{{ asset('revolution/css/settings.css') }}" media="screen" />

        <!-- Typography -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/typography.css') }}" />

        <!-- Shortcodes -->
        <link
          rel="stylesheet"
          type="text/css"
          href="{{ asset('css/shortcodes/shortcodes.css') }}"
        />

        <!-- shop -->
        <link href="{{ asset('css/shop.css') }}" rel="stylesheet" type="text/css" />

        <!-- Style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />

        <!-- Responsive -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}" />

        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <!-- Custom -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}" />

        <style>
           .product-cart-button{
              background: #2bb6aa;
              padding: 10px;
              margin-top: 10px;
           }
           .product-cart-button a{
              color:#ffffff;
           }
           .product .product-title span {
                font-size: 16px;
                text-transform: uppercase;
                font-weight: 600;
                margin: 20px 0px 10px;
                display: block;
            }
            .whishlist-icon{
              position: absolute;
              z-index: 9999 !important;
              width: 100%;
              display: flex;
              justify-content: flex-end;
            }
            .whishlist-icon i{
              font-size: 35px;
            }
            .mega-menu .menu-links > li {
                padding: 5px;
            }
            .c-btn-border-1x.c-btn-white.c-btn-border-opacity-04 {
                border-color: rgba(255, 255, 255, 0.4);
            }
            .c-btn-border-1x.c-btn-white {
                border-color: #FFFFFF;
                color: #FFFFFF;
                background: none;
                border-color: #FFFFFF;
            }
            .btn.c-btn-border-1x {
                border-width: 1px;
            }
            .c-btn-circle {
                border-radius: 30px !important;
            }
            .c-label {
                padding: 5px 15px;
                display: inline-block;
                position: absolute;
                z-index: 9;
                border-radius:50px;
            }
            .c-bg-red {
                background-color: #eb5d68 !important;
            }
            .c-font-white {
                color: #FFFFFF !important;
            }
            .c-font-13 {
                font-size: 13px;
            }
            .c-font-uppercase {
                text-transform: uppercase;
            }
            .c-font-bold {
                font-weight: 600 !important;
            }
            @media (min-width: 992px){
              .search-cart .whishlist {
                display: table;
                float: left;
                height: 100%;
                }
                .whishlist a {
                    position: relative;
                    display: table-cell;
                    vertical-align: middle;
                }
                .whishlist strong.item {
                    display: block;
                    position: absolute;
                    top: 50% !important;
                    border-radius: 50%;
                    -webkit-transform: translateY(-50%);
                    -o-transform: translateY(-50%);
                    -ms-transform: translateY(-50%);
                    -moz-transform: translateY(-50%);
                    transform: translateY(-50%);
                    margin-top: -10px;
                }
            }

            .whishlist strong.item {
                display: block;
                position: absolute;
                top: -7px;
                left: auto;
                right: -8px;
                font-size: 10px;
                color: #ffffff;
                width: 16px;
                height: 16px;
                line-height: 16px;
                text-align: center;
                background-color: #2bb6aa;
                border-radius: 50%;
            }
            .search-no-result{
              padding:40px 0px;
            }
            .search-no-result .bg-title h2 {
                font-size: 350px;
                line-height: 150px;
                color: rgba(0, 0, 0, 0.03);
                position: absolute;
                left: 0;
                right: 0;
                top: 0;
            }
            .listing-post-meta .float-right h6 a {
                display: inline-block;
                padding: 5px 15px;
                font-size: 12px;
                font-weight: 500;
                border-radius: 3px;
                color: #fff;
                background-color: #2bb6aa;
                -webkit-transition: all 0.3s ease;
                -moz-transition: ll 0.3s ease;
                transition: all 0.3s ease;
            }
            .listing-post-meta .list-unstyled li .product-price del {
                background: transparent;
                color: #323232;
                font-size: 15px;
            }
            .listing-post-meta .list-unstyled li .product-price ins {
                text-decoration: none;
                color: #2bb6aa;
                font-size: 20px;
                font-weight: bold;
            }
            .listing-post a.popup:hover {
                background: #2bb6aa;
                color: #ffffff;
            }
            .listing-post {
              width: 100%;
              position: relative;
              overflow: hidden;
              color: #fff;
              width: 100%;
              border: 0;
              position: relative;
            }
            .listing-post:hover a.popup {
                opacity: 1;
                top: 20px;
            }
            .listing-post a.popup:hover {
                background: #2bb6aa;
                color: #ffffff;
            }
            .listing-post a.popup {
                position: absolute;
                right: 20px;
                top: -20px;
                color: #fff;
                z-index: 9;
                display: inline-block;
                width: 40px;
                height: 40px;
                background: #fff;
                color: #626262;
                border-radius: 50%;
                margin-right: 10px;
                padding-left: 0px;
                text-align: center;
                line-height: 40px;
                opacity: 0;
                transition: all 0.5s ease-in-out;
                -webkit-transition: all 0.5s ease-in-out;
                -moz-transition: all 0.5s ease-in-out;
                -ms-transition: all 0.5s ease-in-out;
                -o-transition: all 0.5s ease-in-out;
            }

            /* Rating Star Widgets Style */
            .rating-stars ul {
            list-style-type:none;
            padding:0;

            -moz-user-select:none;
            -webkit-user-select:none;
            }
            .rating-stars ul > li.star {
            display:inline-block;

            }

            /* Idle State of the stars */
            .rating-stars ul > li.star > i.fa {
            font-size:2.5em; /* Change the size of the stars */
            color:#ccc; /* Color on idle state */
            }

            /* Hover state of the stars */
            .rating-stars ul > li.star.hover > i.fa {
            color:#FFCC36;
            }

            /* Selected state of the stars */
            .rating-stars ul > li.star.selected > i.fa {
            color:#FF912C;
            }
            .rating-stars ul > li.starSelected {
                display: inline-block;
            }
            .rating-stars ul > li.starSelected.selected > i.fa {
            color:#FF912C;
            }
            i.fa.fa-star-o {
                width: 1.28571429em;
                text-align: center;
            }
            .listing-post-meta.clearfix .float-right{
                margin-top:5px
            }
            a.disabled {
                pointer-events: none;
                cursor: default;
                opacity: 0.6;
            }
            .credentials-button:hover,
            .credentials-signup-button:hover,
            .credentials-signup-button{
                background:#fff;
                color:#2bb6aa;
                border-color: #fff;
            }
            .feature-image{
                width:370px;
                height:280px;
            }
            .feature-image-product{
                width:417px;
                height:280px;
            }
            .profile{
                display: grid;
            }
            .pricing-top.thankyou-box{
                box-shadow: 0 0 40px rgba(0, 0, 0, 0.05);
                padding: 30px;
                border: 4px solid #2bb6aa;
                border-radius: 6px;
            }
            .c-theme-bg{
                background:#2bb6aa;
            }
            .c-theme-bg .c-message{
                padding:35px 10px;
            }
            .order-details ul{
                display:flex;
                justify-content: center;
            }
            .order-details ul li{
                list-style: none;
                margin-right:30px
            }
            .order-details ul li p{
                text-align: center;
            }
            .description-details{
                text-align: center;
            }
            .cart-image{
                width: 50px;
            }
            .box.dropdown{
                margin-left: 30px;
                margin-top: -10px;
            }
            .nice-select,
            .nice-select ul.list{
                width:200px !important;
            }
            .table-responsive.h-60vh{
                height:80vh;
            }

            @media (max-width: 991px){
                    .search-cart {
                        display: flex;
                        position: absolute;
                        right: 60px;
                        top: 0;
                        z-index: 999;
                    }
                    .shpping-cart, .whishlist{
                        padding: 0px 0px 0px 10px;
                    }
                    .whishlist strong.item {;
                        top: 20px;
                        left: auto;
                        right: 15px;
                    }
            }
            @media (min-width: 992px){
                .shpping-cart{
                    padding: 20px 20px 20px 10px;
                }
                .whishlist{
                    padding: 20px;
                }
            }
        </style>
      </head>
<body>

    <div class="wrapper">
        {{-- <div id="pre-loader">
          <img src="{{ asset('images/pre-loader/loader-05.svg') }}" alt="iobotics technology" />
        </div> --}}
        @include('frontend.partials.header')
        @yield('content')
        @include('frontend.partials.footer')
    </div>
    <div id="back-to-top">
        <a class="top arrow" href="#top"
          ><i class="fa fa-angle-up"></i> <span>TOP</span></a
        >
    </div>

    <!-- jquery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>

    <!-- plugins-jquery -->
    <script src="{{ asset('js/plugins-jquery.js') }}"></script>

    <!-- REVOLUTION JS FILES -->
    <script src="{{ asset('revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('revolution/js/jquery.themepunch.revolution.min.js') }}"></script>

    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
    <script src="{{ asset('revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
    <!-- revolution custom -->
    <script src="{{ asset('revolution/js/revolution-custom.js') }}"></script>
    <!-- plugin_path -->

    <script>
        var plugin_path = 'http://localhost:8000/js/';
      </script>


    <!-- custom -->
    <script src="{{ asset('js/custom.js') }}"></script>

    <!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5f3109b2ed9d9d26270988ba/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    {{-- <script type="text/javascript">
        (function () {
            var options = {
                facebook: "103233641397198", // Facebook page ID
                whatsapp: "+92 311 7064200", // WhatsApp number
                snapchat: "nabeelahmad72", // Snapchat
                call: "+92 311 7064200", // call
                greeting_message: "Hello, how may we help you? Just send us a message now to get assistance.",
                call_to_action: "Message us", // Call to action
                button_color: "#129BF4", // Color of button
                position: "right", // Position may be 'right' or 'left'
                order: "facebook,whatsapp", // Order of buttons
            };
            var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
            var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
            s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
            var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
        })();
      </script> --}}
      @stack('scripts')
</body>
</html>
