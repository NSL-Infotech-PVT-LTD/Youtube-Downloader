@extends('layouts.frontend')
@section('content')
<!--inner page content start here-->
<section class="content-area privacy">
    <div class="container">
        <div class="row banner content">
            <div class="col-md-12">
                <h1  class="heading"><span>{{__('privacy_policy.privacy') }} </span>{{__('privacy_policy.policy') }}</h1>
                <br>
                <p><?= htmlspecialchars_decode(__('privacy_policy.we_operate')) ?></p>
                <br>


                <p>{{__('privacy_policy.inform_website_visitors') }}</p>
                <p>{{__('privacy_policy.choose') }}</p>
                <br>
                <p><?= htmlspecialchars_decode(__('privacy_policy.the_terms')) ?></p>
                <br>
                <h3><b>{{__('privacy_policy.information') }}</b></h3>


                <p>{{__('privacy_policy.for_a_better') }}</p>
                <br>

                <h3><b>{{__('privacy_policy.log') }}</b></h3>
                <p>{{__('privacy_policy.we_want') }}</p>
                <br>

                <h3><b>{{__('privacy_policy.log') }}</b></h3>
                <p>{{__('privacy_policy.we_want') }}</p>
                <br>

                <h3><b>{{__('privacy_policy.cookies')}}</b></h3>
                <p>{{__('privacy_policy.cookies_are') }}</p>
                <br>
                <p>{{__('privacy_policy.our_website')}}</p>
                <br>

                <h3><b>{{__('privacy_policy.service_provider')}}</b></h3>
                <p>{{__('privacy_policy.third_party') }}</p>
                <br>
                <ul>
                    <li>{{__('privacy_policy.to_facilitate')}}</li>
                    <li>{{__('privacy_policy.to_provide')}}</li>
                    <li>{{__('privacy_policy.service_related')}}</li>
                    <li>{{__('privacy_policy.to_assist')}}</li>
                </ul>
                <br>
                <p>{{__('privacy_policy.however')}}</p>
                <br>
                <h3><b>{{__('privacy_policy.security')}}</b></h3>
                <p>{{__('privacy_policy.personal_information') }}</p>
                <br>
                <h3><b>{{__('privacy_policy.links')}}</b></h3>
                <p>{{__('privacy_policy.our_Service') }}</p>
                <br>

                <h3><b>{{__('privacy_policy.children')}}</b></h3>
                <p>{{__('privacy_policy.address') }}</p>
                <br>

                <h3><b>{{__('privacy_policy.changes')}}</b></h3>
                <p>{{__('privacy_policy.we_may_update') }}</p>
                <br>

                <h3><b>{{__('privacy_policy.contactus')}}</b></h3>
                <p>{{__('privacy_policy.please_contact_us') }}</p>
                <br>
                <ul>
                    <li>
                        <?= htmlspecialchars_decode(__('privacy_policy.email')) ?>
                    </li>
                </ul>




            </div>
        </div>
    </div>
</section>
<!--inner page content End here-->

@endsection
