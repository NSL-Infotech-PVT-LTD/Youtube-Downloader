<?php
$k = 0;
for ($i = $page['offset']; $i <= count($videoInfo->video) - 1; $i++):
    if ($k == $page['limit'])
        break;
    $k++;

//    dd($videoInfo->video[$i]);
    ?>
    <div class="col-md-3">
        <div class="video_thum">
            <div class="video_inr">
                <?php /*           <iframe width="auto" height="200" src="https://www.youtube.com/embed/<?= $videoInfo->video[$i]->encrypted_id ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                 */ ?>
                <img width="auto" height="200" src="<?= $videoInfo->video[$i]->image['high_quality'] ?>"/>
                <div class="video-des">
                    <a href="<?= url('video-search') . '?search=https://www.youtube.com/embed/' . $videoInfo->video[$i]->encrypted_id ?>"><h4><?= $videoInfo->video[$i]->title ?></h4></a>
                </div>							
            </div>
        </div>
    </div>
    <?php
endfor;
?>
<script type="text/javascript">
    offset = '<?= $page['offset']; ?>';
</script>