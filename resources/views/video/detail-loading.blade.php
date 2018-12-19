@extends('layouts.frontend')
@section('title', 'Video Search')
@section('content')
<!--inner page content start here-->
<section class="loading video-search" id="video-search">
    <div id="circle">
        <div class="loader">
            <div class="loader">
                <div class="loader">
                    <div class="loader">

                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>
<style type="text/css">
    #circle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        width: 150px;
        height: 150px;	
    }

    .loader {
        width: calc(100% - 0px);
        height: calc(100% - 0px);
        border: 8px solid #f7f7fa;
        border-top: 8px solid #fb0200;
        border-radius: 50%;
        animation: rotate 5s linear infinite;
    }

    @keyframes rotate {
        100% {transform: rotate(360deg);}
    } 
    footer{
        position:fixed;
    }
</style>
<script type="text/javascript">
    $(function () {
        $.ajax({
            url: '<?= $request->fullUrl() ?>',
            type: "get",
            beforeSend: function () {
//                $('.ajax-load').show();
            }
        }).done(function (data) {
//            $('#circle').hide();
            $("#video-search").html(data.html);
            $('footer').css('position', 'static');
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            alert('server not responding...');
        });
    });
</script>
@endsection

