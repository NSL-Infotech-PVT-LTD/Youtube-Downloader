@extends('layouts.frontend')
@section('title', 'Contact')
@section('content')
<script src='https://www.google.com/recaptcha/api.js'></script>

<!--inner page content start here-->
<section class="content-area contact">
    <div class="container">
        <div class="row banner content">
            <h1 class="heading">{{__('contact.contact') }}<span> {{__('contact.us') }}</span></h1>
            <p class="sub-heading">{{__('contact.we_love') }}</p>
            <div class="col-md-1"></div>
            <div class="col-md-6 form-area contact-form">

                @if(session()->has('message'))
                <div class="alert alert-success" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    {{ session()->get('message') }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    {{ $errors->first() }}
                </div>
                @endif
                <form action="<?= route('contact-us') ?>" method="post">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />

                    <h5>{{__('contact.please_fill') }}</h5>
                    <div class="form-group">
                        <input class="form-control input-lg" placeholder="{{__('contact.placeholder_name') }}*" id="inputlg" type="text" required="" name="name">
                    </div>

                    <div class="form-group">
                        <input class="form-control input-lg" placeholder="{{__('contact.placeholder_email') }}*" id="inputlg" type="text" required="" name="email">
                    </div>
                    <div class="form-group">
                        <textarea class="textarea-contactus" placeholder="{{__('contact.placeholder_message') }}*"  required="" name="message"></textarea>
                        <div class="col-md-7 g-recaptcha" data-sitekey="6Levs4AUAAAAAJE188EUePJZ5RgIS9Pls6IZFDGy"></div>

                        <div class="form-group btns">
                            <!-- <button class="btn">Prevent spam</button> -->
                            <button class="btn submit">{{__('contact.send_message') }}</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="help-inner panel panel-default">
                    <h5>{{__('contact.or_send_us_email') }}</h5>
                    <p><a class="email" href="mailto:info@y2d2.com"><i class="fa fa-envelope" aria-hidden="true"></i> {{__('contact.email_info') }}</a></p>	<br>
                    <p><span class="red">*</span> {{__('contact.please-read') }} </p>
                </div>
            </div>
            <!--  <div class="col-md-1"></div> -->

        </div>
    </div>
</section>
<!--inner page content End here-->
@endsection
