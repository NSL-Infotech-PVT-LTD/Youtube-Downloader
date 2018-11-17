@extends('layouts.frontend')
@section('content')
<!--inner page content start here-->
<section class="content-area faq">
    <div class="row banner content">

        <?php if ($status): ?>
            <h1 class="heading">Success! You can access your videos here:</h1>
            <p  class="sub-heading"><a style="text-align: center" class="sub-heading" href="<?= $url ?>" target="_BLANK" class="btn btn-info">Click to open populated file over Google Drive</a></p>
        <?php else: ?>

            <h1 class="heading"> <span>Oops! Sorry!</span></h1>
            <p  class="sub-heading"> We could not get download permissions for this video. Please try with another video.</p>
        <?php endif; ?>

    </div>
</section>
<!--inner page content End here-->

@endsection
