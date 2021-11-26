<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <!-- Site Title-->
    <title>Minuzzi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{ url('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" type="text/css"
    href="//fonts.googleapis.com/css?family=Oswald:200,400%7CLato:300,400,300italic,700%7CMontserrat:900">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style-alt-colors.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/fonts.css') }}">
    <style>
        .ie-panel {
            display: none;
            background: #212121;
            padding: 10px 0;
            box-shadow: 3px 3px 5px 0 rgba(0, 0, 0, .3);
            clear: both;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        html.ie-10 .ie-panel,
        html.lt-ie-10 .ie-panel {
            display: block;
        }

    </style>
</head>

<body>
    <div class="ie-panel">
        <a href="http://windows.microsoft.com/en-US/internet-explorer/">
            <img src="images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820"
            alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today.">
        </a>
    </div>
    <!-- Page preloader-->
    <div class="page-loader">
        <div class="page-loader-logo-name">Minuzzi Transformadores</div>
        <div class="preloader-wrapper preloader-big active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-->
    <div class="page">
        <!-- Page Header-->
        <header class="section page-header breadcrumbs-custom-wrap bg-gradients bg-secondary-2"
        data-preset='{"title":"Intro slider with nav","category":"intro, navigation, slider","reload":true,"id":"intro-slider-with-nav"}'>
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap rd-navbar-default">
            <nav class="rd-navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
            data-md-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-fullwidth"
            data-xl-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static"
            data-xxxl-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fullwidth"
            data-xl-device-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static"
            data-xxxl-device-layout="rd-navbar-static" data-stick-up-offset="1px" data-sm-stick-up-offset="1px"
            data-md-stick-up-offset="1px" data-lg-stick-up-offset="1px" data-xl-stick-up-offset="1px"
            data-xxl-stick-up-offset="1px" data-xxx-lstick-up-offset="1px" data-stick-up="true">
            <div class="rd-navbar-inner">
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                    <!-- RD Navbar Toggle-->
                    <button class="rd-navbar-toggle"
                    data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                    <!-- RD Navbar Brand-->
                    <div class="rd-navbar-brand">
                        <!--Brand-->
                        <a class="brand-name" href="index.html">
                            <img class="logo-default" src="{{ url('assets/images/logo/positive.png') }}"
                            alt="" width="200" />
                            <img class="logo-inverse" src="{{ url('assets/images/logo/negative.png') }}"
                            alt="" width="200" />
                        </a>
                    </div>
                </div>
                <div class="rd-navbar-aside-right" style="margin-right: 15px;">
                    <div class="rd-navbar-nav-wrap">
                        <ul class="rd-navbar-nav">
                            <li class="rd-nav-item active"><a class="rd-nav-link" href="/">Home</a>
                            </li>
                            <li class="rd-nav-item"><a class="rd-nav-link" href="#">{{__('menu.company')}}</a>
                                <ul class="rd-menu rd-navbar-dropdown">
                                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="/#about_us">{{__('menu.about_us')}}</a>
                                    </li>
                                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="/privacy">{{__('menu.privacy')}}</a>
                                    </li>
                                    <li class="rd-dropdown-item"><a class="rd-dropdown-link"
                                        href="/certified">{{__('menu.certified')}}</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="rd-nav-item"><a class="rd-nav-link" href="/products">{{__('menu.products')}}</a>
                                <ul class="rd-menu rd-navbar-megamenu">
                                    <li class="rd-megamenu-item">
                                        <ul class="rd-megamenu-list">
                                            <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="/product_details/9">Minuzzi Solar</a></li>
                                        </ul>
                                    </li>
                                    <li class="rd-megamenu-item">
                                        <ul class="rd-megamenu-list">
                                            <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="/product_details/2">Minuzzi ATP</a></li>
                                            <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="/product_details/3">Minuzzi ATF</a></li>
                                            <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="/product_details/4">Minuzzi ATFM</a></li>
                                        </ul>
                                    </li>
                                    <li class="rd-megamenu-item">
                                        <ul class="rd-megamenu-list">
                                            <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="/product_details/8">Minuzzi TMC</a></li>
                                            <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="/product_details/5">Minuzzi TTC</a></li>
                                            <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="/product_details/13">Minuzzi TMP</a></li>
                                        </ul>
                                    </li>
                                    <li class="rd-megamenu-item">
                                        <ul class="rd-megamenu-list">
                                            <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="/product_details/7">Minuzzi Reat</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="rd-nav-item"><a class="rd-nav-link" href="#">{{__('menu.support')}}</a>
                                <ul class="rd-menu rd-navbar-dropdown">
                                    <li class="rd-dropdown-item"><a class="rd-dropdown-link"
                                        href="/term">{{__('menu.guaranty')}}</a>
                                    </li>
                                    <li class="rd-dropdown-item"><a class="rd-dropdown-link"
                                        href="/manual">{{__('menu.manuals')}}</a>
                                    </li>
                                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="/contact">{{__('menu.sac')}}</a>
                                    </li>
                                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="/faq">{{__('menu.faq')}}</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="rd-nav-item"><a class="rd-nav-link" href="/blog">{{__('menu.blog')}}</a></li>
                            {{-- <li class="rd-nav-item active"><a class="rd-nav-link"
                                href="contato.html">Contato</a></li> --}}
                                <li class="rd-nav-item">
                                    <a class="rd-nav-link" href="/budget"><div class="button button-xs button-secondary button-nina">{{__('menu.budget')}}</div></a>
                                </li>

                                {{-- <-- LINGUA --> --}}
                                <li class="rd-nav-item">
                                    <a class="rd-nav-link">
                                        <img src="{{ Config::get('languages')[App::getLocale()]['flag-icon'] }}" alt="" style="width: 35px; height: 35px;">
                                        {{ Config::get('languages')[App::getLocale()]['display'] }}
                                    </a>
                                    <ul class="rd-menu rd-navbar-dropdown" style="width: 140px;">
                                        @foreach (Config::get('languages') as $lang => $language)
                                        @if ($lang != App::getLocale())
                                        <li class="rd-dropdown-item">
                                            <a class="rd-dropdown-link" href="/lang/{{$lang}}">
                                                <img src="{{ $language['flag-icon-before'] }}" alt="" style="width: 35px; height: 35px;">
                                                {{-- {{$language['display']}} --}}
                                            </a>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    @yield('content')
</div>
<!-- Global Mailform Output-->
<div class="snackbars" id="form-output-global"></div>
<!-- Javascript-->
<script src="{{ url('assets/js/core.min.js') }}"></script>
<script src="{{ url('assets/js/script.js') }}"></script>

@include('site.layout.footer')
@yield('scripts')

{{-- <script>
    // define lingua reload anchors
    var dataReload = document.querySelectorAll("[data-reload]");

    // tradução
    var language = {
        en: {
            welcome: "Welcome"
        },
        es: {
            welcome: "Bienvenidos"
        }
    };

    // define lingua via window hash
    if (windows.location.hash) {
        if (window.location.hash === "#es") {
            textContent = language.es;
        }
    };

    //define language reload onclik illiteration
    for (i = 0; i <= dateReload.length; i++) {
        dateReload[i].onclick = function() {
            location.reload(true);
        };
    }

</script> --}}

</body>

</html>
