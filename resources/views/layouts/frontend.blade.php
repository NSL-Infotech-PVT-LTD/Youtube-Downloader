<!DOCTYPE html>
<html  lang="{{Config::get('app.locale')}}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Y2D2') }} - @yield('title')</title>
        <meta property=og:title content="Free YouTube Video & Subtitle Downloader | Online MP3 & MP4 Converter">
        <meta property=og:url content="https://y2d2.com/">
        <meta property=og:type content="website">
        <meta property=og:description content="Y2D2 is a free and safe online YouTube video downloader which can also be used as a YouTube to MP3, MP4 video converter. This amazing online tool can also download subtitles from YouTube. Download and convert your favourite videos!">
        <meta property=og:image content="https://y2d2.com/assets/img/brand.png">
        <?php /* ?>
          <!-- Scripts -->
          <script src="{{ asset('js/app.js') }}" defer></script>
          <!-- Fonts -->
          <link rel="dns-prefetch" href="https://fonts.gstatic.com">
          <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
          <!-- Styles -->
          <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
          <?php */ ?>

        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery.copy-to-clipboard.js') }}"></script>
        <script src="{{ asset('js/share.js') }}"></script>
    </head>
    <body class="<?= (count(array_slice(explode('/', url()->current()), -1, 1)['0']) == '1') ? 'public' : array_slice(explode('/', url()->current()), -1, 1)['0'] ?>">
        <!--header start here-->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid navsection">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                            <div class="qrcode hidden-lg hidden-sm hidden-md"><a href=""><i class="fa fa-qrcode"></i><!-- <img src="images/qr-code.png"> --></a></div>
                    <a class="navbar-brand" href="<?= url('/'); ?>"><img class="imglogo" src="images/logo.png"></a>
                </div>

                <div id="navbar" class="navbar-collapse collapse" aria-expanded="false">
                    <ul class="nav navbar-nav">
                        <li class="<?= (array_slice(explode('/', url()->current()), -1, 1)['0'] == 'home' || array_slice(explode('/', url()->current()), -1, 1)['0'] == 'public' || (count(array_slice(explode('/', url()->current()), -1, 1)['0']) == '1')) ? 'active' : ''; ?>" ><a href="<?= url('/'); ?>">{{ __('menu.home')}}</a></li>
                        <!--<li class="<?= array_slice(explode('/', url()->current()), -1, 1)['0'] == 'about' ? 'active' : ''; ?>" ><a href="<?= url('about'); ?>">{{ __('menu.about')}}</a></li>-->
                        <li class="<?= array_slice(explode('/', url()->current()), -1, 1)['0'] == 'faq' ? 'active' : ''; ?>" ><a href="<?= url('faq'); ?>">{{ __('menu.faq')}}</a></li>
                        <!--<li class="<?= array_slice(explode('/', url()->current()), -1, 1)['0'] == 'blog' ? 'active' : ''; ?>" ><a href="<?= url('blog'); ?>">{{ __('menu.blog')}}</a></li>-->
                       <!--  <li class="<?= array_slice(explode('/', url()->current()), -1, 1)['0'] == 'feedback' ? 'active' : ''; ?>" ><a href="<?= url('feedback'); ?>">{{ __('menu.feedback')}}</a></li> -->
                        <li class="<?= array_slice(explode('/', url()->current()), -1, 1)['0'] == 'contact' ? 'active' : ''; ?>" ><a href="<?= url('contact'); ?>">{{ __('menu.contact')}}</a></li>

                        <li class="language dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@if(session('locale')=='en'){{ __('English')}} @else {{ __('中文')}} @endif<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li @if(session('locale')=='en') class="lang-active"  @endif ><a href="{{route('lang.switch',['lang'=>'en'])}}">{{ __('English')}}<span class="check"><i class="fa fa-check-circle"></i></span></a></li>
                                <li role="separator" class="divider"></li>
                                <li @if(session('locale')=='zh') class="lang-active"  @endif ><a href="{{route('lang.switch',['lang'=>'zh'])}}">{{ __('中文')}}<span class="check"><i class="fa fa-check-circle"></i></span></a></li>
                            </ul>
                        </li>
                        <li><div class="qrcode hidden-xs"><a  data-toggle="modal" data-target="#qrcode-popup"><i class="fa fa-qrcode qrcode-set"></i></a></div>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <!--header End here-->

        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        @yield('content')
        <!--footer start here-->
        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                       <!--  <p>© 2018 Y2D2.com</p> -->
                        <ul class="site">
                            <li>   © 2018 Y2D2.com  </li>
                        </ul >
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <ul class="useful-links">
                            <li class="<?= array_slice(explode('/', url()->current()), -1, 1)['0'] == 'terms' ? 'active' : ''; ?>" ><a href="<?= url('terms') ?>">{{ __('menu.Terms_of_Use')}}</a></li>
                            <li class="<?= array_slice(explode('/', url()->current()), -1, 1)['0'] == 'privacy-policy' ? 'active' : ''; ?>"><a  href="<?= url('privacy-policy') ?>">{{ __('menu.Privacy_Policy')}} </a></li>
                            <li class="<?= array_slice(explode('/', url()->current()), -1, 1)['0'] == 'site-map' ? 'active' : ''; ?>" ><a href="<?= url('site-map') ?>">{{ __('menu.Site_Map')}} </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!--footer start here-->
        <!-- Modal start here -->
        <div class="modal fade" id="qrcode-popup" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <!--                    <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">{{__('video.close') }}</button>
                                            <h4 class="modal-title">{{__('video.share_option') }}</h4>
                                        </div>-->
                    <div class="modal-body row">
                        <div class="col-md-12 model-links">
                            <div> <img src="<?= url('home-qrcode.png') ?>"/></div   >
                            <!--<a data-clipboard-text="<?= \URL::to('/'); ?>" >{{__('video.copy_links') }}</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal End here -->
    </body>
</html>

