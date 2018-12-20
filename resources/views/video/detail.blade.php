@extends('layouts.frontend')
@section('title', 'Video Search')
@section('content')
<!--inner page content start here-->
<section class="content-area video">
    <div class="container">
        <div class="row banner">
            <div class="col-md-10 search-video">
                <div class="search-container">
                    <form action="<?= url('video-search') ?>">
                        <input type="text"  autocomplete="off" placeholder="{{__('home.search_placeholder')}}" name="search" value="<?= $request->search ?>">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="video_thum">
                            <div class="video_inr">
                                <div class="itemsContainer" data-toggle="modal" data-target="#video-player">
                                    <img width="auto" height="200" src="<?= $videoInfo->image['high_quality'] ?>"/>
                                    <div class="play"><i class="fa fa-youtube-play"></i> </div>
                                </div>
                                <div class="video-des">
                                    <h4><?= $videoInfo->title ?></h4>
                                    <table>
                                        <tr><td>{{__('video.upload_date') }}</td><td><?= $publishedAt ?></td></tr>
                                        <tr><td>{{__('video.duration') }}</td><td><?= $videoInfo->duration ?></td></tr>
                                        <tr><td>{{__('video.views') }}</td><td> <?= $videoInfo->views ?></td></tr>
                                        <tr><td>{{__('video.video_id') }}</td><td><a href="https://www.youtube.com/watch?v=<?= $videoInfo->video_id ?>" target="_BLANK" ><?= $videoInfo->video_id ?></a></td></tr>
                                        <tr><td>{{__('video.video_channel') }}</td><td><a href="https://www.youtube.com/channel/<?= $videoInfo->channel_id ?>" target="_BLANK" ><?= $videoInfo->author ?></a></td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="video_desciption">
                            <div class="video_inr">
                                <ul class="nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#video">{{__('video.video') }}</a></li>
                                    <li><a data-toggle="tab" href="#audio">{{__('video.audio') }}</a></li>
                                    <li><a data-toggle="tab" href="#single-language">{{__('video.subtitle') }}</a></li>
                                    <li style="float: right; ">
                                        <div class="qrcode hidden-xs qrcodetab">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#share-video"><i class="fa fa-qrcode "></i></a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="video" class="tab-pane fade in active">
                                        <table>
                                            <tr>
                                                <th>{{__('video.format') }}</th>
                                                <th>{{__('video.quality') }}</th>
                                                <th>{{__('video.resolution') }}</th>
                                                <th>{{__('video.size') }}</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            <?php
                                            $threeGPCNT = 0;
                                            $k = 0;
                                            foreach ($videoFormat as $format):
                                                foreach ($videoInfo->full_formats as $fullFormats):
//                                                $formatType = explode(';', str_replace('video/', '', $fullFormats->type))
                                                    $formatType = explode('.', $fullFormats->filename);
                                                    $formatIndex = count($formatType) - 1;
//                                                dd(count($formatType));
                                                    if ($formatType[$formatIndex] != $format):
                                                        continue;
                                                    endif;
                                                    ?>
                                                    <tr>
                                                        <td><?= $formatType[$formatIndex] ?></td>
                                                        <?php
                                                        if ($threeGPCNT > 0):
                                                            if ($formatType[$formatIndex] == '3gp')
                                                                $formatType[$formatIndex] = '3gpp';
                                                        endif;
                                                        $formatType['5'] = (strpos($fullFormats->quality, 'hd') !== false) ? str_replace('hd', '', $fullFormats->quality . 'p') : $formatType[$formatIndex];
                                                        $vQuality = ($fullFormats->quality == 'medium' || $fullFormats->quality == 'small') ? $quality[$formatType[$formatIndex]] : $fullFormats->quality;
                                                        if ($k == 0)
                                                            $highestVideoQuality = (strpos($vQuality, 'hd') !== false) ? str_replace('hd', '', $vQuality) : $vQuality;
                                                        ?>
                                                        <td><?= (strpos($vQuality, 'hd') !== false) ? str_replace('hd', '', $vQuality) . 'p <span class="badge badge-danger">HD</span>' : $vQuality . 'p' ?></td>
                                                        <td><?= $resolution[$formatType['5']] . ' x ' . str_replace('hd', '', $vQuality) ?></td>
                                                        <td><?= App\Helpers\Y2D2::getFileSize($fullFormats->url) ?></td>
                                                        <td>
                                                            <span class="download">
                                                                <a href="<?= isset($fullFormats->url) ? $fullFormats->url : '' ?>" class="dwn_load btn btn-success" download="<?= str_replace(' ', '_', $videoInfo->title . '.' . $formatType[$formatIndex]) ?>" target="_BLANK"><i class="fa fa-download"></i>  {{__('video.download') }}</a>
                                                            </span>
                                                            <span>
                                                                <button class="share-vdo"  id= "<?= isset($fullFormats->url) ? $fullFormats->url : '' ?>" onclick ="generateLinks(this.id)" data-toggle="tooltip" data-placement="bottom" title="Save to Google"><img width="25px" src="<?= url('images/Google-Drive-icon.ico') ?>"></button>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    if ($formatType[$formatIndex] == '3gp'):
                                                        $threeGPCNT++;
                                                    endif;
                                                    $k++;
                                                endforeach;
                                            endforeach;
//                                            echo $highestVideoQuality;
                                            ?>
                                        </table>
                                        <table>
                                            <div class="video-heading">{{__('video.video_without_audio') }}</div>
                                            <?php
                                            foreach ($videoFormatWithoutAudio as $format):
                                                $ki = 0;
                                                foreach ($videoInfo->adaptive_formats as $afullFormats):
                                                    $aformatType = explode(';', str_replace('video/', '', $afullFormats->type));
                                                    if (!isset($afullFormats->quality_label))
                                                        continue;

                                                    if (($aformatType['0'] != $format) && (($afullFormats->quality_label != $format))):
                                                        continue;
                                                    endif;

                                                    if (str_replace('p', '', $afullFormats->quality_label) <= $highestVideoQuality):
                                                        continue;
                                                    endif;
                                                    if ($ki > 2):
                                                        continue;
                                                    endif;
                                                    $ki++;
                                                    $aformatTypeT = explode('.', $afullFormats->filename);
                                                    $aformatTypeTIndex = count($aformatTypeT) - 1;
                                                    ?>
                                                    <tr>
                                                        <td><?= $aformatTypeT[$aformatTypeTIndex] ?></td>
                                                        <td><?= isset($afullFormats->quality_label) ? (($afullFormats->quality_label >= 720) ? $afullFormats->quality_label . ' <span class="badge badge-danger">HD</span>' : $afullFormats->quality_label ) : '-' ?> </td>
                                                        <td><?= isset($afullFormats->size) ? $afullFormats->size : '-' ?></td>
                                                        <td><?= App\Helpers\Y2D2::getFileSize($afullFormats->url) ?></td>
                                                        <td>
                                                            <span class="download">
                                                                <a href="<?= isset($afullFormats->url) ? $afullFormats->url : '' ?>" class="dwn_load btn btn-success" download target="_BLANK"><i class="fa fa-download"></i> {{__('video.download') }}</a>
                                                            </span>
                                                            <span>
                                                                <button class="share-vdo" id ="<?= isset($afullFormats->url) ? $afullFormats->url : '' ?>" onclick ="generateLinks(this.id)" data-toggle="tooltip" data-placement="bottom" title="Save to Google"><img width="25px" src="<?= url('images/Google-Drive-icon.ico') ?>"></button>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>

                                        </table>
                                        <div class="tips"><span>{{__('video.tip') }}</span> {{__('video.tip_detail') }}</div>
                                        <div class="tips"><span>{{__('video.tip') }}</span> {{__('video.tip_not_download') }}</div>
                                    </div>
                                    <div id="audio" class="tab-pane fade">
                                        <table>
                                            <tr>
                                                <th>{{__('video.format') }}</th>
                                                <th>{{__('video.quality') }}</th>
                                                <th>{{__('video.size') }}</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            <?php
                                            foreach ($audioFormat as $aformat):
                                                foreach ($adaptive_formats as $audiofullFormats):
                                                    $audiofullFormats = (object) $audiofullFormats;
                                                    $audioformatType = explode(';', $audiofullFormats->type);

//                                                dd($audiofullFormats);
                                                    if ($audioformatType['0'] != $aformat):
                                                        continue;
                                                    endif;
                                                    ?>
                                                    <tr>
                                                        <td><?= (str_replace('audio/', '', $audioformatType['0']) == 'mp4') ? 'm4a' : str_replace('audio/', '', $audioformatType['0']) ?></td>
                                                        <td><?= (isset($audiofullFormats->bitrate) ? $kbps = App\Helpers\Y2D2::convertBitrateToKilobits($audiofullFormats->bitrate) . ' Kbps' : '- ') ?></td>
                                                        <td><?= App\Helpers\Y2D2::getFileSize($audiofullFormats->url) ?></td>
                                                        <td></td>
                                                        <td>
                                                            <span class="download">
                                                                <a href="<?= isset($audiofullFormats->url) ? $audiofullFormats->url : '' ?>" class="dwn_load  btn btn-success" download target="_BLANK"><i class="fa fa-download"></i> {{__('video.download') }}</a>
                                                            </span>
                                                            <span>
                                                                <button class="share-vdo" id = "<?= isset($audiofullFormats->url) ? $audiofullFormats->url : '' ?>" onclick ="generateLinks(this.id)" data-toggle="tooltip" data-placement="bottom" title="Save to Google"><img width="25px" src="<?= url('images/Google-Drive-icon.ico') ?>"></button>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    if ($kbps == '128 Kbps'):
                                                        $mp3File = $audiofullFormats->url;
                                                    endif;
                                                endforeach;
                                            endforeach;
                                            /*     if (isset($mp3File)):
                                              ?>
                                              <tr>
                                              <td><?= 'MP3' ?></td>
                                              <td><?= '128 Kbps' ?></td>
                                              <td><?= App\Helpers\Y2D2::getFileSize($mp3File) ?></td>
                                              <td></td>
                                              <td>
                                              <span class="download btn btn-success">
                                              <a href="<?= isset($mp3File) ? $mp3File : '' ?>" class="dwn_load" download target="_BLANK">{{__('video.download') }}</a>
                                              </span>
                                              <span>
                                              <button class="share-vdo" id = "<?= isset($mp3File) ? $mp3File : '' ?>" onclick="generateLinks(this.id)"  data-toggle="modal" data-target="#share"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                              </span>
                                              </td>
                                              </tr>
                                              <?php endif; */
                                            ?>
                                        </table>
                                        <div class="tips"><span>{{__('video.tip') }}</span>{{__('video.tip_detail') }}</div>
                                    </div>
                                    <div id="single-language" class="tab-pane fade">
                                        <?php if ($videoInfo->captions): ?>
                                            <?php /* ?>
                                              <ul class="nav-tabs">
                                              <li class="active"><a data-toggle="tab" href="#single-language">{{__('video.single_language') }}</a></li>
                                              <li><a data-toggle="tab" href="#dual-language">{{__('video.dual_language') }}</a></li>
                                              </ul>
                                              <div class="tab-content">
                                              <div id="single-language" class="tab-pane fade in active">
                                              <table>
                                              <tr>
                                              <th>{{__('video.language') }}</th>
                                              <th>{{__('video.type') }}</th>
                                              <th>{{__('video.format') }}</th>
                                              <th>{{__('video.timeline') }}</th>
                                              <th></th>
                                              </tr>
                                              <?php
                                              foreach (['auto-generated', 'auto-generated'] as $k => $type):
                                              foreach ($videoInfo->captions as $captions):
                                              if ($k == '1'):
                                              if (!(strpos($captions->name->simpleText, $type) === false)):
                                              continue;
                                              endif;
                                              else:
                                              if (strpos($captions->name->simpleText, $type) === false):
                                              continue;
                                              endif;
                                              endif;
                                              ?>
                                              <tr>
                                              <td><?= ($k == 0) ? str_replace('(auto-generated)', '', $captions->name->simpleText) : $captions->name->simpleText ?></td>
                                              <td><?= ($k == 0) ? __('video.auto_generated') : __('video.uploaded') ?></td>
                                              <td>
                                              <select class="form-control format">
                                              <?php foreach ($captionFormat as $k => $format): ?>
                                              <option><?= $format ?></option>
                                              <?php endforeach; ?>
                                              </select>
                                              </td>
                                              <td>
                                              <div class="checkbox">
                                              <input name="textonly" type="checkbox" value="" class="textonly" checked="checked" id="single-textonly<?= $k ?>">
                                              <!--<label for="single-textonly<?= $k ?>">{{__('video.timeline') }}</label>-->
                                              </div>
                                              </td>
                                              <td >
                                              <span class="download caption">
                                              <a data-name="<?= str_replace(' ', '_', $videoInfo->title . '_' . $captions->name->simpleText) ?>" href="<?= isset($captions->baseUrl) ? $captions->baseUrl . '&fmt=ttml' : '' ?>" class="dwn_load preview btn btn-primary" target="_BLANK"> <i class="fa fa-eye"></i> {{__('video.preview') }}</a>
                                              </span>
                                              <span class="download">
                                              <a data-name="<?= str_replace(' ', '_', $videoInfo->title . '_' . $captions->name->simpleText) ?>" data-href="<?= isset($captions->baseUrl) ? $captions->baseUrl . '&fmt=ttml' : '' ?>" class="dwn_load caption-downloader btn btn-success" target="_BLANK"><i class="fa fa-download"></i> {{__('video.download') }}</a>
                                              </span>
                                              <!--                                                            <span>
                                              <button class="share-vdo" id ="<?= isset($captions->baseUrl) ? $captions->baseUrl : '' ?>" onclick ="generateLinks(this.id)" data-toggle="modal" data-target="#share"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                              </span>-->
                                              </td>
                                              </tr>
                                              <?php
                                              endforeach;
                                              endforeach;
                                              ?>
                                              <?php
                                              foreach ($videoInfo->captions_auto_generated as $ki => $captionsAutoGenerated):
                                              if ((isset($CPsignatureLang) && isset($CPasrLang) && isset($CPexpire))):

                                              $captionURL = 'https://www.youtube.com/api/timedtext?lang=en&xorp=True&sparams=' . urlencode($sparams) . '&hl=en&asr_langs=' . urlencode($CPasrLang) . '&fmt=ttml&v=' . $videoInfo->video_id . '&caps=asr&expire=' . $CPexpire . '&tlang=' . $captionsAutoGenerated->languageCode . '&key=yttt1&signature=' . $CPsignatureLang . '&xoaf=1';
                                              $captionURL.=($sparams == 'asr_langs,caps,v,expire') ? '&name=en' : '';
                                              $captionURL.=$kindURL;
                                              ?>
                                              <tr>
                                              <td><?= $captionsAutoGenerated->languageName->simpleText ?></td>
                                              <td>{{__('video.auto_transalted') }}</td>
                                              <td>
                                              <select class="form-control format">
                                              <?php foreach ($captionFormat as $format): ?>
                                              <option><?= $format ?></option>
                                              <?php endforeach; ?>
                                              </select>
                                              </td>
                                              <td>
                                              <div class="checkbox">
                                              <input name="textonly" type="checkbox" value="" class="textonly" checked="checked" id="single-textonly-auto<?= $ki ?>">
                                              <!--<label for="single-textonly-auto<?= $ki ?>">{{__('video.timeline') }}</label>-->
                                              </div>
                                              </td>
                                              <td >
                                              <span class="download caption">

                                              <a data-name="<?= str_replace(' ', '_', $videoInfo->title . '_' . $captionsAutoGenerated->languageName->simpleText) ?>" href="<?= $captionURL ?>" class="dwn_load preview btn btn-primary" target="_BLANK"><i class="fa fa-eye"></i> {{__('video.preview') }}</a>
                                              </span>
                                              <span class="download">
                                              <a data-name="<?= str_replace(' ', '_', $videoInfo->title . '_' . $captions->name->simpleText) ?>" data-href="<?= $captionURL ?>" class="dwn_load caption-downloader btn btn-success" target="_BLANK"><i class="fa fa-download"></i> {{__('video.download') }}</a>
                                              </span>
                                              <!--                                                            <span>
                                              <button class="share-vdo" id ="<?= isset($captions->baseUrl) ? $captions->baseUrl : '' ?>" onclick ="generateLinks(this.id)" data-toggle="modal" data-target="#share"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                              </span>-->
                                              </td>
                                              </tr>
                                              <?php
                                              endif;
                                              endforeach;
                                              ?>
                                              </table>
                                              </div>
                                              <div id="dual-language" class="tab-pane fade">
                                              <table>
                                              <tr>
                                              <th>{{__('video.1st_language') }}</th>
                                              <th>{{__('video.2nd_language') }}</th>
                                              <th>{{__('video.format') }}</th>
                                              <th>{{__('video.timeline') }}</th>
                                              <th></th>
                                              </tr>
                                              <tr>
                                              <td>
                                              <select class="form-control Flanguage">
                                              <?php
                                              foreach ($videoInfo->captions as $captions):
                                              ?>
                                              <option value="<?= $captions->languageCode ?>" data-href="<?= isset($captions->baseUrl) ? $captions->baseUrl . '&fmt=ttml' : '' ?>" data-name="<?= str_replace(' ', '_', $videoInfo->title . '_' . $captions->name->simpleText) ?>" > <?= $captions->name->simpleText ?></option>
                                              <?php endforeach; ?>
                                              </select>
                                              </td>
                                              <td>
                                              <select class="form-control Slanguage">
                                              <?php
                                              foreach ($videoInfo->captions as $captions):
                                              ?>
                                              <option value="<?= $captions->languageCode ?>" data-href="<?= isset($captions->baseUrl) ? $captions->baseUrl . '&fmt=ttml' : '' ?>" data-name="<?= str_replace(' ', '_', $videoInfo->title . '_' . $captions->name->simpleText) ?>" > <?= $captions->name->simpleText ?></option>
                                              <?php endforeach; ?>
                                              </select>
                                              </td>
                                              <td>
                                              <select class="form-control format">
                                              <?php
                                              foreach ($captionFormat as $format):
                                              if ($format == 'xml')
                                              continue;
                                              ?>
                                              <option><?= $format ?></option>
                                              <?php endforeach; ?>
                                              </select>
                                              </td>
                                              <td>
                                              <div class="checkbox">
                                              <input name="textonly" type="checkbox" value="" class="textonly" checked="checked" id="dual-textonly">
                                              <!--                                                                    <label for="dual-textonly"></label>-->
                                              </div>
                                              </td>
                                              <td >
                                              <span class="download caption">
                                              <a class="dwn_load preview btn btn-primary" data-type="preview"><i class="fa fa-eye"></i> {{__('video.preview') }}</a>
                                              </span>
                                              <span class="download">
                                              <a class="dwn_load preview btn btn-primary" data-type="download"><i class="fa fa-download"></i>{{__('video.download') }}</a>
                                              </span>
                                              </td>
                                              </tr>
                                              </table>
                                              </div>
                                              </div>
                                              <?php */ ?>
                                            <table>
                                                <tr>
                                                    <th>{{__('video.language') }}</th>
                                                    <th>{{__('video.type') }}</th>
                                                    <th>{{__('video.format') }}</th>
                                                    <th>{{__('video.timeline') }}</th>
                                                    <th></th>
                                                </tr>
                                                <?php
                                                foreach ($videoInfo->captions as $captions):
                                                    if (strpos($captions->name->simpleText, '(auto-generated)') === false):
                                                        continue;
                                                    endif;
                                                    ?>
                                                    <tr>
                                                        <td><?= $captions->name->simpleText ?></td>
                                                        <td><?= __('video.auto_generated') ?></td>
                                                        <td>
                                                            <select class="form-control format">
                                                                <?php foreach ($captionFormat as $k => $format): ?>
                                                                    <option><?= $format ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="checkbox">
                                                                <input name="textonly" type="checkbox" value="" class="textonly" checked="checked" id="single-textonly<?= $k ?>">
                                                            </div>
                                                        </td>
                                                        <td >
                                                            <span class="download caption">
                                                                <a data-name="<?= str_replace(' ', '_', $videoInfo->title . '_' . $captions->name->simpleText) ?>" href="<?= isset($captions->baseUrl) ? $captions->baseUrl . '&fmt=ttml' : '' ?>" class="dwn_load preview btn btn-primary" target="_BLANK"> <i class="fa fa-eye"></i> {{__('video.preview') }}</a>
                                                            </span>
                                                            <span class="download">
                                                                <a data-name="<?= str_replace(' ', '_', $videoInfo->title . '_' . $captions->name->simpleText) ?>" data-href="<?= isset($captions->baseUrl) ? $captions->baseUrl . '&fmt=ttml' : '' ?>" class="dwn_load caption-downloader btn btn-success" target="_BLANK"><i class="fa fa-download"></i> {{__('video.download') }}</a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                endforeach;
                                                ?>
                                                     <?php
                                                foreach ($videoInfo->captions as $captions):
                                                    if (!strpos($captions->name->simpleText, '(auto-generated)') === false):
                                                        continue;
                                                    endif;
                                                    ?>
                                                    <tr>
                                                        <td><?= $captions->name->simpleText ?></td>
                                                        <td><?= __('video.uploaded') ?></td>
                                                        <td>
                                                            <select class="form-control format">
                                                                <?php foreach ($captionFormat as $k => $format): ?>
                                                                    <option><?= $format ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="checkbox">
                                                                <input name="textonly" type="checkbox" value="" class="textonly" checked="checked" id="single-textonly<?= $k ?>">
                                                            </div>
                                                        </td>
                                                        <td >
                                                            <span class="download caption">
                                                                <a data-name="<?= str_replace(' ', '_', $videoInfo->title . '_' . $captions->name->simpleText) ?>" href="<?= isset($captions->baseUrl) ? $captions->baseUrl . '&fmt=ttml' : '' ?>" class="dwn_load preview btn btn-primary" target="_BLANK"> <i class="fa fa-eye"></i> {{__('video.preview') }}</a>
                                                            </span>
                                                            <span class="download">
                                                                <a data-name="<?= str_replace(' ', '_', $videoInfo->title . '_' . $captions->name->simpleText) ?>" data-href="<?= isset($captions->baseUrl) ? $captions->baseUrl . '&fmt=ttml' : '' ?>" class="dwn_load caption-downloader btn btn-success" target="_BLANK"><i class="fa fa-download"></i> {{__('video.download') }}</a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                endforeach;
                                                ?>
                                                <?php
                                                foreach ($videoInfo->captions_auto_generated as $ki => $captionsAutoGenerated):
                                                    if ((isset($CPsignatureLang) && isset($CPasrLang) && isset($CPexpire))):

                                                        $captionURL = 'https://www.youtube.com/api/timedtext?lang=en&xorp=True&sparams=' . urlencode($sparams) . '&hl=en&asr_langs=' . urlencode($CPasrLang) . '&fmt=ttml&v=' . $videoInfo->video_id . '&caps=asr&expire=' . $CPexpire . '&tlang=' . $captionsAutoGenerated->languageCode . '&key=yttt1&signature=' . $CPsignatureLang . '&xoaf=1';
                                                        $captionURL.=$cpname;
                                                        $captionURL.=$kindURL;
                                                        if ($ki == 0)
                                                            $file_headers = @get_headers($captionURL);

                                                        $captionURL.= ($file_headers['8'] == 'Content-Length: 0') ? '&kind=asr' : '';
                                                        ?>
                                                        <tr>
                                                            <td><?= $captionsAutoGenerated->languageName->simpleText ?></td>
                                                            <td>{{__('video.auto_transalted') }}</td>
                                                            <td>
                                                                <select class="form-control format">
                                                                    <?php foreach ($captionFormat as $format): ?>
                                                                        <option><?= $format ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <div class="checkbox">
                                                                    <input name="textonly" type="checkbox" value="" class="textonly" checked="checked" id="single-textonly-auto<?= $ki ?>">
                                                                    <!--<label for="single-textonly-auto<?= $ki ?>">{{__('video.timeline') }}</label>-->
                                                                </div>
                                                            </td>
                                                            <td >
                                                                <span class="download caption">
                                                                    <?php /* ?>
                                                                      <a data-name="<?= str_replace(' ', '_', $videoInfo->title . '_' . $captionsAutoGenerated->languageName->simpleText) ?>" href="<?= $captionAutoGenerateURL . '&asr_langs=' . $CPasrLang . '&signature=' . $CPsignatureLang . '&expire=' . $CPexpire . '&tlang=' . $captionsAutoGenerated->languageCode . '&fmt=ttml' ?>" class="dwn_load preview" target="_BLANK"><i class="fa fa-eye"></i> {{__('video.preview') }}</a>
                                                                      <? */ ?>
                                                                    <a data-name="<?= str_replace(' ', '_', $videoInfo->title . '_' . $captionsAutoGenerated->languageName->simpleText) ?>" href="<?= $captionURL ?>" class="dwn_load preview btn btn-primary" target="_BLANK"><i class="fa fa-eye"></i> {{__('video.preview') }}</a>
                                                                </span>
                                                                <span class="download">
                                                                    <a data-name="<?= str_replace(' ', '_', $videoInfo->title . '_' . $captions->name->simpleText) ?>" data-href="<?= $captionURL ?>" class="dwn_load caption-downloader btn btn-success" target="_BLANK"><i class="fa fa-download"></i> {{__('video.download') }}</a>
                                                                </span>
            <!--                                                            <span>
                                                                    <button class="share-vdo" id ="<?= isset($captions->baseUrl) ? $captions->baseUrl : '' ?>" onclick ="generateLinks(this.id)" data-toggle="modal" data-target="#share"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                                                </span>-->
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    endif;
                                                endforeach;
                                                ?>
                                            </table>
                                        <?php else: ?>

                                            <div class="tips "><span>{{__('video.info') }} </span>{{__('video.no_subtitle') }}</div>
                                        <?php endif; ?>
<!--<div class="tips"><span>{{__('video.tip') }}</span>{{__('video.tip_detail') }}</div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--inner page content End here-->
<!-- Modal start here -->
<div class="modal fade" id="share" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">{{__('video.close') }}</button>
                <h4 class="modal-title">{{__('video.share') }}</h4>
            </div>
            <div class="modal-body row">
                <div class="col-md-12 model-links">
                    <a onclick="openWindowWithPost()">{{__('video.save_to') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End here -->
<div class="modal fade" id="share-video" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">{{__('video.close') }}</button>
                <h4 class="modal-title">{{__('video.share_option') }}</h4>
            </div>
            <div class="modal-body row">
                <div class="col-md-12 model-links">
                    <div> <img src="<?= url('qrcodes/' . $videoInfo->video_id . '.png') ?>"/></div   >
                    <a data-clipboard-text="<?= url('video-search?search=' . $videoInfo->video_id); ?>" >{{__('video.copy_links') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="caption" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">{{__('video.close') }}</button>
                <h4 class="modal-title"><?= 'Caption Viewer' ?></h4>
                <!--<button  class="btn btn-success caption-downloader">Download</button>-->
            </div>
            <div class="modal-body row">

            </div>
        </div>
    </div>
</div>
<!-- Modal start here -->
<div class="modal fade" id="video-player" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">{{__('video.close') }}</button>
                <h4 class="modal-title"><?= $videoInfo->title ?></h4>
            </div>
            <div class="modal-body row">
                <div class="share-model-inr">
                    <iframe width="auto" height="540" src="https://www.youtube.com/embed/<?= $videoInfo->video_id ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End here -->
<form id="googledriveshare" method="get" action="<?= route('glogin') ?>" target="TheWindow" style="
      display: none;
      ">
    {{ csrf_field() }}
    <input type="hidden" name="filename" id ="filename" value="">
    <input type="hidden" name="fileurl" id ="fileurl" value="">
</form>
<script type="text/javascript">
    function generateLinks(fileurl) {
        var filename = "<?= $videoInfo->title ?>";
        $('#filename').val(filename);
        $('#fileurl').val(fileurl);
        openWindowWithPost()
    }
    function openWindowWithPost() {

        var f = document.getElementById('googledriveshare');
//        f.filename.value = filename;
//        f.fileurl.value = fileurl;
        window.open('', 'TheWindow');
        f.submit();
    }
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        var captionDownloader = $('.caption-downloader');
        $('#single-language .download.caption > a.preview').click(function (event) {
            var format = $(this).parent().parent().parent().find('.format').val();
            if (format == 'xml') {
                return;
            }
            event.preventDefault();
            var req = new XMLHttpRequest();
            var dataName = $(this).attr("data-name");
            var href = encodeURIComponent($(this).attr("href"));
            var PURL = "<?= url('subtitleDownload') ?>";
            var textonly = $(this).parent().parent().parent().find('.textonly').prop("checked");
//            captionDownloader.attr('data-name', dataName);
//            captionDownloader.attr('data-href', href);
//            captionDownloader.attr('data-format', format);
//            captionDownloader.attr('data-textonly', textonly);
            req.open("POST", PURL, true);
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            req.send("url=" + href + "&textonly=" + textonly + "&_token={{csrf_token()}}");
            req.onload = function (event) {
                var blob = req.response;
                var lines = blob.split('\n');
                lines.splice(0, 1);
                blob = lines.join('\n');
                $('#caption .modal-body').html(blob);//now its working
                $('#caption').modal('show');//now its working
            };
        });

        captionDownloader.click(function (event) {
            event.preventDefault();
            var req = new XMLHttpRequest();
            var dataName = $(this).attr("data-name");
            var href = $(this).attr("data-href");
            var PURL = "<?= url('subtitleDownload') ?>";
            var DUAL_PURL = "<?= url('dualSubtitleDownload') ?>";
            var format = $(this).attr('data-format');
            var textonly = $(this).attr('data-textonly');
            if (textonly == null) {
                textonly = $(this).parent().parent().parent().find('.textonly').prop("checked");
            }
            if (format == null) {
                format = $(this).parent().parent().parent().find('.format').val();
                href = encodeURIComponent(href);
            }

            if ($("#subtitle > ul > li.active > a").attr('href') == '#dual-language') {
                var href2 = $(this).attr("data-href2");
                req.open("POST", DUAL_PURL, true);
                req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                req.send("url_1=" + href + "&url_2=" + href2 + "&textonly=" + textonly + "&_token={{csrf_token()}}");
            } else {
                req.open("POST", PURL, true);
                req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                req.send("url=" + href + "&textonly=" + textonly + "&_token={{csrf_token()}}");
            }
            req.responseType = "blob";

            req.onload = function (event) {
                var blob = req.response;
                console.log(format);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = dataName + "." + format;
                link.click();
            };
//            req.send();
        });


        $('#dual-language .download > a.preview').click(function (event) {
            var format = $(this).parent().parent().parent().find('.format').val();
            event.preventDefault();
            var dataType = $(this).attr('data-type');
            var req = new XMLHttpRequest();
            var dataName = $('select.Flanguage').find(":selected").attr('data-name');
            var href1 = encodeURIComponent($('select.Flanguage').find(":selected").attr('data-href'));
            var href2 = encodeURIComponent($('select.Slanguage').find(":selected").attr('data-href'));

            var PURL = "<?= url('dualSubtitleDownload') ?>";
            var textonly = $(this).parent().parent().parent().find('.textonly').prop("checked");
            captionDownloader.attr('data-name', dataName);
            captionDownloader.attr('data-href', href1);
            captionDownloader.attr('data-href2', href2);
            captionDownloader.attr('data-format', format);
            captionDownloader.attr('data-textonly', textonly);
            req.open("POST", PURL, true);
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            req.send("url_1=" + href1 + "&url_2=" + href2 + "&textonly=" + textonly + "&_token={{csrf_token()}}");

            if (dataType != 'preview') {
                req.responseType = "blob";
            }
            req.onload = function (event) {
                var blob = req.response;
                if (dataType == 'preview') {
                    var lines = blob.split('\n');
                    lines.splice(0, 1);
                    blob = lines.join('\n');
                    $('#caption .modal-body').html(blob);
                    $('#caption').modal('show');
                } else {
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = dataName + "." + format;
                    link.click();
                }
            };
        });
    });
</script>
@endsection
