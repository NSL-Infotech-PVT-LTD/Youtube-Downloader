@extends('layouts.frontend')
@section('title', 'Terms Of Use')
@section('content')
<!--inner page content start here-->
<section class="content-area terms">
    <div class="container">
        <div class="row banner content">
            <div class="col-md-12">
                <h1  class="heading"><span>{{__('termofuse.term') }}</span> {{__('termofuse.of_use') }}</h1>
                <h4><b>{{__('termofuse.introduction') }}</b></h4>
                <p>{{__('termofuse.content') }}</p>
                <br>

                <h4><b>{{__('termofuse.intellectual') }}</b></h4>
                <p>{{__('termofuse.other') }}</p>
                <br>
                <p>{{__('termofuse.you') }}</p>
                <br>
                <h4><b>{{__('termofuse.restrictions') }}</b></h4>
                <p>{{__('termofuse.you_are_specifically') }}</p>
                <br>
                <ul>
                    <li>{{__('termofuse.publishing') }}</li>
                    <li>{{__('termofuse.selling') }}</li>
                    <li>{{__('termofuse.publicly') }}</li>
                    <li>{{__('termofuse.using_this_website') }}</li>
                    <li>{{__('termofuse.using') }}</li>
                    <li>{{__('termofuse.contrary') }}</li>
                    <li>{{__('termofuse.engaging') }}</li>
                    <li>{{__('termofuse.advertising_or_marketing') }}</li>
                </ul>

                <p>{{__('termofuse.certain_areas') }}</p>

                <h4><b>{{__('termofuse.your_content') }}</b></h4>
                <p>{{__('termofuse.website_standard_terms')}}</p>
                <p>{{__('termofuse.third_partys_rights')}}</p>
                <br>
                <h4><b>{{__('termofuse.warranties')}}</b></h4>
                <p>{{__('termofuse.worries_content')}}</p>
                <br>
                <h4><b>{{__('termofuse.limitation_of_liability')}}</b></h4>
                <p>{{__('termofuse.content_of_limitation')}}</p>
                <br>
                <h4><b>{{__('termofuse.indemnification')}}</b></h4>
                <p>{{__('termofuse.indemnify')}}</p>
                <br>
                <h4><b>{{__('termofuse.severability')}}</b></h4>
                <p>{{__('termofuse.if_any_provision')}}</p>
                <br>
                <h4><b>{{__('termofuse.variation_of_terms')}}</b></h4>
                <p>{{__('termofuse.y2d2')}}</p>
                <br>
                <h4><b>{{__('termofuse.assignment')}}</b></h4>
                <p>{{__('termofuse.y2d2_is')}}</p>
                <br>
                <h4><b>{{__('termofuse.entire')}}</b></h4>
                <p>{{__('termofuse.these_terms')}}</p>



            </div>
        </div>
    </div>
</section>
<!--inner page content End here-->

@endsection
