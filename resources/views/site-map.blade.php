@extends('layouts.frontend')
@section('title', 'Site Map')
@section('content')
<!--inner page content start here-->
<section class="content-area privacy">
    <div class="container">
        <div class="row banner content">
            <div class="col-md-12">
                <h1  class="heading"><span>{{__('site_map.site') }} </span>{{__('site_map.map') }}</h1>
                <br>
                <div class="sitemap text-center">
                    <h3><a href="{{ url('/') }}">{{__('site_map.home')}}</a></h3>

                    <h3><a href="{{ url('faq') }}">{{__('site_map.faq')}}</a></h3>
                    <h3><a href="{{ url('contact') }}">{{__('site_map.contact')}}</a></h3>
                    <h3><a href="{{ url('terms') }}">{{__('site_map.term_of_use')}}</a></h3>
                    <h3><a href="{{ url('privacy-policy') }}">{{__('site_map.privacy_policy')}}</a></h3>
                    <h3><a href="{{ url('site-map') }}">{{__('site_map.sitemap')}}</a></h3>
                </div>




            </div>
        </div>
    </div>
</section>
<!--inner page content End here-->

@endsection
