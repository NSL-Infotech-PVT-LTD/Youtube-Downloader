@extends('layouts.frontend')
@section('content')
<!--inner page content start here-->
<section class="content-area faq">
    <div class="container">
        <div class="row banner content">
            <h1 class="heading">Google share</h1>
            <div class="col-md-12">	
                <div class="help-inner panel panel-default text-center">
                    <?php if ($status): ?>
                        <a href="<?= $url ?>" target="_BLANK" class="btn btn-info">Click to open populated file over Google Drive</a>
                    <?php else: ?>
                        <p>Something Went Wrong</p>
                    <?php endif; ?>
                    <br>
                    <br>
                    <button class="btn btn-success" onclick="window.close();">Click to close</button>

                </div>
            </div>
        </div>	
    </div>
</section>
<!--inner page content End here-->

@endsection
