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
                <img width="auto" height="200" src="<?= 'https://i.ytimg.com/vi/' . $videoInfo->video[$i]->encrypted_id . '/hqdefault.jpg' ?>" />
                <div class="vid-duration">
                    <span><?= $videoInfo->video[$i]->duration ?></span>
                </div>
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