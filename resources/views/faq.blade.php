@extends('layouts.frontend')
@section('content')
<!--inner page content start here-->
<section class="content-area faq">
    <div class="container">
        <div class="row banner content col-md-10 col-md-offset-1">
            <h1 class="heading">{{__('faq.frequently_asked') }}<span>{{__('faq.questions') }}</span></h1>
            <p class="sub-heading">{{__('faq.do_you') }}</p>
            <div class="col-md-8">

                <div class="panel-group" id="accordion">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion" data-toggle="collapse" data-target="#collapseOne">
                                    <h5>{{__('faq.Collapsible_1') }}</h5>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <p>{{__('faq.contant') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed accordion" data-toggle="collapse" data-target="#collapseTwo">
                                    <h5>{{__('faq.Collapsible_2') }}</h5>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>{{__('faq.contant_1') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed accordion" data-toggle="collapse" data-target="#collapseThree">
                                    <h5>{{__('faq.Collapsible_3') }}</h5>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>{{__('faq.contant_2') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed accordion" data-toggle="collapse" data-target="#collapse4">
                                    <h5>{{__('faq.Collapsible_4') }}</h5>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse4" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>{{__('faq.contant_3') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed accordion" data-toggle="collapse" data-target="#collapse5">
                                    <h5>{{__('faq.Collapsible_5') }}</h5>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse5" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>{{__('faq.contant_4') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-target="#collapse6">
                                    <h5>{{__('faq.Collapsible_6') }}</h5>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse6" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>{{__('faq.contant_5') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed accordion" data-toggle="collapse" data-target="#collapse7">
                                    <h5>{{__('faq.Collapsible_7') }}</h5>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse7" class="panel-collapse collapse">
                            <div class="panel-body"><p>
                                    {{__('faq.contant_6') }}</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-md-4">

                <div class="help-inner panel panel-default">
                    <h5><i class="fa fa-question-circle"></i> {{__('faq.helps') }}</h5>
                    <p> {{__('faq.cant_find') }}<br>
                        {{__('faq.we_are_here') }}</p>
                    <h5><i class="fa fa-comment-o"></i> {{__('faq.ask_question_in') }} <a href="">{{__('faq.form_page') }}</a></h5>
                    <h5><i class="fa fa-envelope-o"></i> {{__('faq.contact_us_by') }}<a href="">{{__('faq.form_page') }}</a>	</h5>
                </div>
            </div>
        </div>
    </div>
</section>
<!--inner page content End here-->

@endsection
