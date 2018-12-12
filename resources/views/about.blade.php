@extends('layouts.frontend')
@section('title', 'About')
@section('content')
<!--inner page content start here-->
<section class="content-area about">
    <div class="container">
        <div class="row banner content">
            <h1 class="heading">{{__('about.who') }}<span> {{__('about.we') }}</span> {{__('about.are') }}</h1>
            <p class="sub-heading">{{__('about.sub_title') }}</p>
        </div> 
    </div>
    <div class="about-banner">
        <div class="container">
            <h2>{{__('about.what_we_do') }}</h2>
            <p>{{__('about.ut_sodales') }}<br>{{__('about.eget') }}</p>
        </div>
    </div>
    <div class="container">
        <div class="row banner content">

            <div class="col-md-4">
                <h2>{{__('about.describe_yourself') }}</h2>
            </div>

            <div class="col-md-8">

                <p>{{__('about.content') }}</p>

                <p>{{__('about.content') }}</p>

                <p>{{__('about.lorem_ipsum') }}</p>

                <p>{{__('about.dummy') }}</p>

                <p>{{__('about.lorem_ipsum') }}</p>

                <p>{{__('about.lorem_ipsum') }}</p>

            </div>
        </div>
    </div>
</section>
<!--inner page content End here-->
@endsection
