<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Manager Connection</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="{{ URL::asset('assets/plugins/pace/pace-theme-flash.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/plugins/boostrapv3/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/plugins/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css')}}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ URL::asset('assets/plugins/bootstrap-select2/select2.css')}}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ URL::asset('assets/plugins/switchery/css/switchery.min.css')}}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ URL::asset('pages/css/pages-icons.css')}}" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="{{ URL::asset('pages/css/pages.css')}}" rel="stylesheet" type="text/css" />
    <!--[if lte IE 9]>
    <link href="{{ URL::asset('pages/css/ie9.css') }}" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script type="text/javascript">
        window.onload = function() {
            // fix for windows 8
            if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="{{ URL::asset('pages/css/windows.chrome.fix.css')}}" />'
        }
    </script>
</head>

<body class="fixed-header   ">
<div class="login-wrapper ">
    <div class="bg-pic">
        <img src="{{ URL::asset('assets/img/loginwall.jpg')}}" data-src="{{ URL::asset('assets/img/loginwall.jpg')}}" alt="" class="lazy">
        {{--<div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">--}}
            {{--<h2 class="semi-bold text-white">--}}
                {{--Pages make it easy to enjoy what matters the most in the life</h2>--}}
            {{--<p class="small">--}}
                {{--images Displayed are solely for representation purposes only, All work copyright of respective owner, otherwise © 2013-2014 REVOX.--}}
            {{--</p>--}}
        {{--</div>--}}
    </div>
    <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
            <center>
            <img src="{{ URL::asset('assets/img/logo.png')}}" alt="logo" data-src="{{ URL::asset('assets/img/logo.png')}}" data-src-retina="{{ URL::asset('assets/img/logo.png')}}" width="150">
            </center>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <p class="p-t-15">Connecter à votre compte</p>



            <form id="form-login" class="p-t-15" role="form" method="POST" action="{{ url('/auth/login') }}">
                <div class="form-group form-group-default">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <label>Email</label>
                    <div class="controls">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="form-group form-group-default">
                    <label>Mot de passe</label>
                    <div class="controls">
                        <input type="password" class="form-control" name="password" placeholder="Credentials" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 no-padding">
                        <div class="checkbox ">
                            <input type="checkbox" value="1" id="checkbox1" name="remember">
                            <label for="checkbox1">Rester connecté</label>
                        </div>
                    </div>

                </div>
                <button class="btn btn-primary btn-cons m-t-10" type="submit">Connecter</button>
            </form>
            {{--<div class="pull-bottom sm-pull-bottom">--}}
                {{--<div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">--}}
                    {{--<div class="col-sm-3 col-md-2 no-padding">--}}
                        {{--<img alt="" class="m-t-5" data-src="assets/img/demo/pages_icon.png" data-src-retina="assets/img/demo/pages_icon_2x.png" height="60" src="assets/img/demo/pages_icon.png" width="60">--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-9 no-padding m-t-10">--}}
                        {{--<p><small>--}}
                                {{--Create a pages account. If you have a facebook account, log into it for this process. Sign in with <a href="#" class="text-info">Facebook</a> or <a href="#" class="text-info">Google</a></small>--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
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
<script src="{{ URL::asset('assets/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('pages/js/pages.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/scripts.js') }}" type="text/javascript"></script>
<script>
    $(function() {
        $('#form-login').validate()
    })
</script>
</body>

</html>
