@extends('layouts.frontend')
@section('title', 'Playlist Search')
@section('content')
<script type="text/javascript">
    var offset = 0;
</script>
<!--inner page content start here-->
<section class="content-area video">
    <div class="container">
        <div class="row banner">
            <div class="col-md-12 search-video search-video-playlist">					
                <div class="search-container">
                    <form action="<?= url('video-search') ?>">
                        <input type="text"  autocomplete="off" placeholder="{{__('home.search_placeholder')}}" name="search" value="<?= $request->search ?>">
                        <button type="submit"><img src="images/search.png"></button>
                    </form>
                </div>
                <div class="search-data">
                    <a target="_BLANK" href="<?= $request->search ?>"><h4><?= $videoInfo->title ?></h4></a>
                    <h5><?= count($videoInfo->video) ?> {{__('video.videos_found') }}</h5>
                </div>                
                <div class="row">
                    <div class="col-md-12" id="playList-card">
                        @include('video.playlist.card')
                    </div>
                    <div class="ajax-load text-center" style="display:none">
                        <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">{{__('video.fetching_more') }}</p>
                    </div>
                    <button type="button" class="load-more" onclick="loadMoreCard();">{{__('video.load_more') }}</button>
                </div>		
            </div>
        </div>	
    </div>
</section>
<!--inner page content End here-->

<script type="text/javascript">
    function loadMoreCard() {
        var offsetU = parseInt(offset) + parseInt('<?= $page['limit'] ?>');
        var videoCount = '<?= count($videoInfo->video) ?>';
        $.ajax({
            url: '<?= url('video-playlist-card') . '?search=' . $request->search . '&offset=' ?>' + offsetU,
            type: "get",
            beforeSend: function () {
                $('.ajax-load').show();
            }
        }).done(function (data) {
            if (offset > parseInt(videoCount)) {
                $('.ajax-load').html("No more Video Found");
                $('.load-more').hide();
                return;
            }
            $('.ajax-load').hide();
            $("#playList-card").append(data.html);
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            alert('server not responding...');
        });
    }
</script>
@endsection
