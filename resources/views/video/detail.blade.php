@extends('layouts.frontend')
@section('content')
<!--inner page content start here-->
<section class="content-area video">
    <div class="container">
        <div class="row banner">
            <div class="col-md-9 search-video">					
                <div class="search-container">
                    <form action="<?= url('video-search') ?>">
                        <input type="text"  autocomplete="off" placeholder="{{__('home.search_placeholder')}}" name="search" value="<?= $request->search ?>">
                        <button type="submit"><img src="images/search.png"></button>
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
                                        <tr><td>Duration</td><td><?= $videoInfo->duration ?></td></tr>
                                        <tr><td>Views </td><td> <?= $videoInfo->views ?></td></tr>
                                        <tr><td>Video ID</td><td><a href=""><?= $videoInfo->video_id ?></a></td></tr>
                                    </table>
                                </div>							
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">	
                        <div class="video_desciption">
                            <div class="video_inr">
                                <ul class="nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#video">Video</a></li>
                                    <li><a data-toggle="tab" href="#audio">Audio</a></li>
                                    <li><a data-toggle="tab" href="#subtitle">Subtitle</a></li>
                                    <li style="float: right; ">
                                        <div class="qrcode hidden-xs">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#share-video"><i class="fa fa-qrcode"></i></a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="video" class="tab-pane fade in active">
                                        <table>
                                            <tr>
                                                <th>Format</th>
                                                <th>Quality</th>
                                                <th>Resolution</th>
                                                <th>Size</th>
                                                <th>Download Links</th>			 
                                            </tr>
                                            <?php
                                            foreach ($videoInfo->full_formats as $fullFormats):
                                                
                                                $formatType = explode(';', str_replace('video/', '', $fullFormats->type))
                                                ?>
                                                <tr>
                                                    <td><?= $formatType['0'] ?></td>
                                                    <td><?= isset($fullFormats->quality_label) ? $fullFormats->quality_label : '-' ?></td>
                                                    <td><?= isset($fullFormats->size) ? $fullFormats->size : '-' ?></td>
                                                    <td>233</td>
                                                    <td>
                                                        <span class="download">
                                                            <a href="<?= isset($fullFormats->url) ? $fullFormats->url : '' ?>" class="dwn_load" download target="_BLANK">Download</a>
                                                        </span>
                                                        <span>
                                                            <button class="share-vdo"  onclick ="generateLinks('<?= isset($fullFormats->url) ? $fullFormats->url : '' ?>','<?= isset($fullFormats->filename) ? $fullFormats->filename : '' ?>')" data-toggle="modal" data-target="#share"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>									
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </table>

                                        <table>
                                            <div class="video-heading">Video without Audio	</div>
                                            <?php
                                            foreach ($videoInfo->adaptive_formats as $afullFormats):
                                                $aformatType = explode(';', str_replace('video/', '', $afullFormats->type));
                                                if (!isset($afullFormats->quality_label))
                                                    continue;

                                                if (!in_array($aformatType['0'], $videoFormat) && (!in_array($afullFormats->quality_label, $videoFormat))):
                                                    continue;
                                                endif;
                                                ?>
                                                <tr>
                                                    <td><?= $aformatType['0'] ?></td>
                                                    <td><?= isset($afullFormats->quality_label) ? $afullFormats->quality_label : '-' ?> <sup>FULL HD</sup></td>
                                                    <td><?= isset($afullFormats->size) ? $afullFormats->size : '-' ?></td>
                                                    <td><?= isset($afullFormats->bitrate) ? $afullFormats->bitrate : '-' ?></td>
                                                    <td>
                                                        <span class="download">
                                                            <a href="<?= isset($afullFormats->url) ? $afullFormats->url : '' ?>" class="dwn_load" download target="_BLANK">Download</a>
                                                        </span>
                                                        <span>
                                                            <button class="share-vdo" onclick ="generateLinks('<?= isset($afullFormats->url) ? $afullFormats->url : '' ?>','<?= isset($afullFormats->filename) ? $afullFormats->filename : '' ?>')" data-toggle="modal" data-target="#share"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </table>
                                        <div class="tips"><span>Tip</span> If download didn't start directly, right click on video in the new window and select "Save video as".</div>
                                    </div>
                                    <div id="audio" class="tab-pane fade">
                                        <table>
                                            <tr>
                                                <th>Format</th>
                                                <th>Quality</th>
                                                <th>Size</th>
                                                <th></th>
                                                <th>Download Links</th>			 
                                            </tr>

                                            <?php
                                            foreach ($videoInfo->adaptive_formats as $audiofullFormats):
                                                $audioformatType = explode(';', $audiofullFormats->type);

//                                                dd($audiofullFormats);
                                                if (!in_array($audioformatType['0'], $audioFormat)):
                                                    continue;
                                                endif;
                                                ?>
                                                <tr>
                                                    <td><?= str_replace('audio/', '', $audioformatType['0']) ?></td>
                                                    <td><?= isset($audiofullFormats->quality_label) ? $audiofullFormats->quality_label : '-' ?> <sup>FULL HD</sup></td>
                                                    <td><?= isset($audiofullFormats->bitrate) ? $audiofullFormats->bitrate : '-' ?></td>
                                                    <td></td>
                                                    <td>
                                                        <span class="download">
                                                            <a href="<?= isset($audiofullFormats->url) ? $audiofullFormats->url : '' ?>" class="dwn_load" download target="_BLANK">Download</a>
                                                        </span>
                                                        <span>
                                                            <button class="share-vdo" onclick ="generateLinks('<?= isset($audiofullFormats->url) ? $audiofullFormats->url : '' ?>','<?= isset($audiofullFormats->filename) ? $audiofullFormats->filename : '' ?>')" data-toggle="modal" data-target="#share"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>									
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </table>
                                        <div class="tips"><span>Tip</span> If download didn't start directly, right click on video in the new window and select "Save video as".</div>
                                    </div>


                                    <div id="subtitle" class="tab-pane fade">
                                        <?php if ($videoInfo->captions): ?>
                                            <table>
                                                <tr>
                                                    <th>Language</th>
                                                    <th>Type</th>
                                                    <th>Format</th>
                                                    <th></th>
                                                    <th></th>			 
                                                </tr>
                                                <?php
                                                foreach ($videoInfo->captions as $captions):
                                                    ?>
                                                    <tr>
                                                        <td><?= $captions->name->simpleText ?></td>
                                                        <td>Uploaded</td>
                                                        <td>
                                                            <select id="format" class="form-control ">
                                                                <option selected>SRT</option>
                                                                <option>XML</option>
                                                                <option>TXT</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="checkbox">
                                                                <input type="checkbox" value=""><label>Timeline</label>
                                                            </div>
                                                        </td>
                                                        <td >
                                                            <span class="download caption">
                                                                <a data-name="<?= str_replace(' ', '_', $videoInfo->title . '_' . $captions->name->simpleText) ?>" href="<?= isset($captions->baseUrl) ? $captions->baseUrl : '' ?>" class="dwn_load" download target="_BLANK">Download</a>
                                                            </span>
                                                            <span>
                                                                <button class="share-vdo"   data-toggle="modal" data-target="#share"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>									
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </table>
                                        <?php else: ?>

                                            <div class="tips "><span>Info </span>No Subtitle found</div>
                                        <?php endif; ?>
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
                <button type="button" class="close" data-dismiss="modal">Close</button>
                <h4 class="modal-title">Share</h4>
            </div>
            <div class="modal-body row">
                <div class="col-md-12 model-links">
                    <a href="">Save to dropbox</a>
                    <a href="" onclick = "openWindowWithPost()">Save to Google drive</a>
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
                <button type="button" class="close" data-dismiss="modal">Close</button>
                <h4 class="modal-title">Share option</h4>
            </div>
            <div class="modal-body row">
                <div class="col-md-12 model-links">
                    <div> <img src="<?= url('qrcodes/' . $videoInfo->video_id . '.png') ?>"/></div   >
                    <a href="">Copy links to clipboard</a>
                </div>
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
                <button type="button" class="close" data-dismiss="modal">Close</button>
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
<form id="googledriveshare" method="get" action="http://localhost/y2d2/public/glogin" target="TheWindow" style="
      display: none;
      ">
    {{ csrf_field() }}
    <input type="hidden" name="filename" id ="filename" value="">
    <input type="hidden" name="fileurl" id ="fileurl" value="">
</form>
<script type="text/javascript">
    function generateLinks( fileurl,filename){
        $('#filename').val(filename);
        $('#fileurl').val(fileurl);
       
    }
    function openWindowWithPost() {
        
        var f = document.getElementById('googledriveshare');
//        f.filename.value = filename;
//        f.fileurl.value = fileurl;
        window.open('', 'TheWindow');
        f.submit();
    }
    $(function () {
        $('.download.caption > a').click(function (event) {
            event.preventDefault();
            var req = new XMLHttpRequest();
            var fileR = $(this).attr("href");
            var dataName = $(this).attr("data-name");
            req.open("GET", fileR, true);
            req.responseType = "blob";

            req.onload = function (event) {
                var blob = req.response;
                console.log(blob.size);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = dataName + ".xml";
                link.click();
            };
            req.send();
        });
    });
</script>
@endsection
