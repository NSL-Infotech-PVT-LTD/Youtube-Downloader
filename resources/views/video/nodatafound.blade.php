@extends('layouts.frontend')
@section('title', 'Data Not Found')
@section('content')
<!--inner page content start here-->
<section class="content-area video">
    <div class="container">
        <div class="row banner">
            <div class="col-md-9 search-video">					
                <div class="search-container">
                    <form action="<?= url('video-search') ?>">
                        <input type="text"  autocomplete="off" placeholder="{{__('home.search_placeholder')}}" name="search" value="<?= $request->search ?>">
                        <button type="submit"><img src="images/search.png"></button>
                    </form>
                </div>                
                <div class="row">
                    <div class="col-md-12">
                        <div class="video_thum">
                            <div class="alert alert-danger text-capitalize text-center" role="alert">
                                {{__('message.message_video_not_found')}}
                            </div>
                        </div>
                    </div>
                </div>		
            </div>
        </div>	
    </div>
</section>
<!--inner page content End here-->
@endsection
