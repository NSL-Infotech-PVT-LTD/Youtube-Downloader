@extends('layouts.frontend')
@section('content')
<!--inner page content start here-->
<section class="content-area contact">
    <div class="container">
        <div class="row banner content">
            <h1 class="heading">{{__('contact.contact') }}<span>{{__('contact.us') }}</span></h1>
            <p class="sub-heading">{{__('contact.we_love') }}</p>
            <div class="col-md-1"></div>					
            <div class="col-md-5 form-area">
                <form>
                    <h5>{{__('contact.please_fill') }}</h5>
                    <div class="form-group">
                        <input class="form-control input-lg" placeholder="Name*" id="inputlg" type="text">
                    </div>

                    <div class="form-group">    
                        <input class="form-control input-lg" placeholder="Email*" id="inputlg" type="text">
                    </div>
                    <div class="form-group">      
                        <textarea placeholder="Message*"></textarea>
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
                    <p><a class="email" href="mailto:info@y2d2.com"><i class="fa fa-envelope" aria-hidden="true"></i>{{__('contact.email_info') }}</a></p>				
                    <p><span class="red">*</span>{{__('contact.please-read') }} </p>
                </div>
            </div>
            <div class="col-md-1"></div>

        </div>	
    </div>
</section>
<!--inner page content End here-->
@endsection
