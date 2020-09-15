<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <link rel="icon" type="image/x-icon" href="favicon.ico"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link href="{{ URL::asset('assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('assets/plugins/boostrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ URL::asset('assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ URL::asset('assets/plugins/switchery/css/switchery.min.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ URL::asset('pages/css/pages-icons.css') }}" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="{{ URL::asset('pages/css/pages.css') }}" rel="stylesheet" type="text/css"/>
    @yield('css')

    <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet" type="text/css"/>
    <!--[if lte IE 9]>
    <link href="/pages/css/ie9.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script type="text/javascript">
        window.onload = function() {
            // fix for windows 8
            if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="{{ URL::asset('pages/css/windows.chrome.fix.css') }}" />'
        }
    </script>
</head>
<body class="fixed-header ">
<nav class="page-sidebar" data-pages="sidebar">
    <div class="sidebar-header">
{{--        <img src="{{ URL::asset('assets/img/logo.png') }}" alt="logo" class="brand" data-src="{{ URL::asset('assets/img/logo_white.png') }}" data-src-retina="{{ URL::asset('assets/img/logo_white_2x.png')}}" width="100">--}}
        <div class="sidebar-header-controls">
            {{--<button type="button" class="btn btn-link visible-lg-inline" data-toggle-pin="sidebar"><i class="fa fs-12"></i>--}}
            {{--</button>--}}
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu-items">
            <li class="{{ (Request::is('/')) ? 'active' : '' }}">
                <a href="{{ URL::to('/') }}" class="detailed">
                    <span class="title">Accueil</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-home"></i></span>
            </li>


            <li class="{{ (Request::is('agenda*')) ? 'active' : '' }}">
                <a href="{{ URL::to('agenda') }}" class="detailed">
                    <span class="title">Agenda</span>
                </a>
                <span class="icon-thumbnail "><i class="fa fa-calendar-o"></i></span>
            </li>

            <li class="{{ (Request::is('presentation*')) ? 'active' : '' }}">
                <a href="{{ URL::to('presentation') }}" class="detailed">
                    <span class="title">Présentations</span>
                </a>
                <span class="icon-thumbnail "><i class="fa fa-file"></i></span>
            </li>
            <li class="{{ (Request::is('personnel*')) ? 'active' : '' }}">
                <a href="{{ URL::to('personnel') }}" class="detailed">
                    <span class="title">Personnel</span>
                </a>
                <span class="icon-thumbnail "><i class="fa fa-user"></i></span>
            </li>
            <li class="{{ (Request::is('groupe*')) ? 'active' : '' }}">
                <a href="{{ URL::to('groupe') }}" class="detailed">
                    <span class="title">Groupe</span>
                </a>
                <span class="icon-thumbnail "><i class="fa fa-users"></i></span>
            </li>


            <li class="bottom">
                <a href="{{ url('/auth/logout') }}" class="detailed">
                    <span class="title">Déconnecter</span>
                </a>
                <span class="icon-thumbnail "><i class="fa fa-sign-out"></i></span>
            </li>
        </ul>
        <div class="clearfix">
        </div>
    </div>
</nav>
<div class="page-container">
    <div class="header ">
        <div class="pull-left full-height visible-sm visible-xs">
            <div class="sm-action-bar">
                <a href="#" class="btn-link toggle-sidebar" data-toggle="sidebar">
                    <span class="icon-set menu-hambuger"></span>
                </a>
            </div>
        </div>
        <div class="pull-right full-height visible-sm visible-xs">
            <div class="sm-action-bar">
                <a href="#" class="btn-link" data-toggle="quickview" data-toggle-element="#quickview">
                    <span class="icon-set menu-hambuger-plus"></span>
                </a>
            </div>
        </div>
        <div class=" pull-left sm-table">
            <div class="header-inner">
                <div class="brand inline">
                    <img src="{{ URL::asset('assets/img/logo.png')}}" alt="logo" data-src="{{ URL::asset('assets/img/logo.png')}}" data-src-retina="{{ URL::asset('assets/img/logo.png')}}" width="100">
                </div>
            </div>
        </div>
        <div class=" pull-right">
            <div class="header-inner">
                <a href="{{ url('/auth/logout') }}" class="semi-bold">
                    <i class="fa fa-sign-out"></i>
                    Déconnecter
                </a>
            </div>
        </div>

    </div>
    <div class="page-content-wrapper">
        <div class="content sm-gutter">

            <div class="container-fluid padding-25 sm-padding-10">
                @yield('content')
            </div>

        </div>
        <div class="container-fluid container-fixed-lg footer">
            <div class="copyright sm-text-center">
                <p class="small no-margin pull-left sm-pull-reset">
                    <span class="hint-text">Copyright © 2015 </span>
                    <span class="font-montserrat">Pixels Trade</span>
                </p>
                <div class="clearfix">
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<script src="{{ URL::asset('assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/jquery/jquery-1.8.3.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/modernizr.custom.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/boostrapv3/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/jquery/jquery-easy.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/jquery-unveil/jquery.unveil.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/jquery-bez/jquery.bez.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-ios-list/jquery.ioslist.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/jquery-actual/jquery.actual.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap-select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/classie/classie.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/switchery/js/switchery.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('pages/js/pages.min.js') }}"></script>



@yield('js')
<script src="{{ URL::asset('assets/js/scripts.js') }}" type="text/javascript"></script>
</body>
</html>