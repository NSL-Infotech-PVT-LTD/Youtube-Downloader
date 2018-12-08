@extends('layouts.frontend')
@section('content')
<!--inner page content start here-->
<section class="content-area home">
    <div class="container">
        <div class="row banner">
            <div class="col-md-8 search-video">
                <h1  class="heading"><?= htmlspecialchars_decode(__('home.online_youtube_download')) ?></h1>
                <h4>{{__('home.download_head4')}}</h4>
                <div class="search-container">
                    <form action="<?= url('video-search') ?>">
                        <input type="text"  autocomplete="off" placeholder="{{__('home.search_placeholder')}}" name="search">
                        <button type="submit"><img src="images/search.png"></button>
                    </form>
                </div>
                <div class="share">
                    <ul>
<!--                        <li class="share-hd">{{__('home.share_it')}} <i class="fa fa-share-alt" aria-hidden="true"></i></li>-->
                        <?php // \Share::page('https://y2d2.com','Try Best Youtube to MP3 & MP4 Converter & Downloader - Y2D2.com!', [], '', '')->facebook()->twitter()->googlePlus();?>
                        <li class="addthis_inline_share_toolbox"></li>
                        <!--<li class="more"><a><i class="fa fa-ellipsis-h" aria-hidden="true"></i><span> {{__('home.social_more') }}</span></a></li>-->
                    </ul>
                </div>
                <div class="row company-spon" style="visibility:hidden;">
                    <div class="col-md-3 col-sm-3 col-xs-6 company"><a><img class="img-responsive" src="images/banner-thum.png"></a></div>
                    <div class="col-md-3 col-sm-3 col-xs-6 company"><a><img class="img-responsive" src="images/banner-thum.png"></a></div>
                    <div class="col-md-3 col-sm-3 col-xs-6 company"><a><img class="img-responsive" src="images/banner-thum.png"></a></div>
                    <div class="col-md-3 col-sm-3 col-xs-6 company"><a><img class="img-responsive" src="images/banner-thum.png"></a></div>
                </div>
            </div>
            <div class="col-md-10 y2d-details">
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="details">
                        <span class="detail-count"><i class="fa fa-rocket"></i></span>
                        <h4>{{__('home.head_free&easy')}}</h4>
                        <p>{{__('home.head_free&easy_detail')}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="details">
                        <span class="detail-count"><i class="fa fa-film"></i></span>
                        <h4>{{__('home.head_video')}}</h4>
                        <p>{{__('home.head_video_detail')}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="details">
                        <span class="detail-count"><i class="fa fa-music"></i></span>
                        <h4>{{__('home.head_audio')}}</h4>
                        <p>{{__('home.head_audio_detail')}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="details">
                        <span class="detail-count"><i class="fa fa-id-card"></i></span>
                        <h4>{{__('home.head_subtitle')}}</h4>
                        <p>{{__('home.head_subtitle_detail')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--inner page content End here-->
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5bf3ce42d953f95a"></script>

@endsection
