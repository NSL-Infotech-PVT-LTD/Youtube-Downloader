@extends('layouts.frontend')
@section('content')
<!--inner page content start here-->
<section class="content-area terms">
    <div class="container">
        <div class="row banner content">
            <div class="col-md-12">	
                <h1  class="heading"><span>{{__('termofuse.term') }}</span>{{__('termofuse.of_use') }}</h1>
                <p>{{__('termofuse.content') }}</p>

                <p>{{__('termofuse.content') }}</p>
                <h5>{{__('termofuse.lorem_ipsum') }}</h5>
                <ul>
                    <li>{{__('termofuse.lorem_ipsum') }}</li>
                    <li>{{__('termofuse.lorem_ipsum') }}</li>
                    <li>{{__('termofuse.lorem_ipsum') }}</li>
                    <li>{{__('termofuse.lorem_ipsum') }}</li>
                    <li>{{__('termofuse.lorem_ipsum') }}</li>
                </ul>

                <p>{{__('termofuse.content') }}</p>

            </div>
        </div>	
    </div>
</section>
<!--inner page content End here-->

@endsection
