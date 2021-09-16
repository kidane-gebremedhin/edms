


<?php 
$document_edition->handleViewsCount();
?>  

<?php 
$document=$document_edition->document;
?>
<input type="hidden" class="category" value='{{$category}}' />
<input type="hidden" id="searchUrl" value="{{route('documents.playlist')}}">

<div oncontextmenu="return false">
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xs-12 col-sm-12">
                <div class="sv-video">
<div oncontextmenu="return false">
@if($document_edition->isVideo())
<script type="text/javascript">
// var url="{{ route('stream_media', $document_edition->id) }}";
// //setInterval(()=>{
// $.ajax({
// type:'get',
// url: url,
// success: function(response){
//    base64Str=response;
//   //alert(base64Str)
//    var videocontainer = document.getElementById('videoclip');
// var videosource = document.getElementById('mp4video');
// var newmp4 = /*"data:video/webm;base64, "+*/response;
//   alert(newmp4)

// //videobutton.addEventListener("click", function(event) {
// videocontainer.pause();
// videosource.setAttribute('src', newmp4);
// videocontainer.load();
// //videocontainer.setAttribute('poster', newposter); //Changes video poster image
// videocontainer.play();
// //}, false);

// },
// error: function(err){
//     alert(JSON.stringify(err))
//       console.log('File appears to be corrupted!')
//       }
// })
// //}, 10000)
</script>
<video id="videoclip" preload="none" poster="{{asset('circle_video_sharing/images/small-Video-placeholder.png')}}" style="width:100%;height:400px;" controls="controls" controlsList="nodownload" width="100%" height="100%" autoplay>
    <source id="mp4video" src="{{ route('stream_media', $document_edition->id) }}" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'></source>
</video>


@elseif($document_edition->isAudio())
<video id="videoclip" preload="none" poster="{{asset('images/audio_images/audio-bg-4.jfif')}}" style="width:100%;height:400px;" controls="controls" controlsList="nodownload" width="100%" height="100%" autoplay>
    <source id="mp4video" src="{{ route('stream_media', $document_edition->id) }}" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'></source>
</video>
<script type="text/javascript">
    
/*$(document).ready(function(){

    var stream = {
        title: "{{$document_edition->document!=null? $document_edition->document->title:''}}",
        mp3: "{{ route('stream_media', $document_edition->id) }}"
    },
    ready = false;

    $("#jquery_jplayer_1").jPlayer({
        ready: function (event) {
            ready = true;
            $(this).jPlayer("setMedia", stream);
                    $(this).jPlayer("play", 1);
},
        pause: function() {
            $(this).jPlayer("clearMedia");
        },
        error: function(event) {
            if(ready && event.jPlayer.error.type === $.jPlayer.error.URL_NOT_SET) {
                // Setup the media stream again and play it.
                $(this).jPlayer("setMedia", stream).jPlayer("play");
            }
        },
        swfPath: "{{ asset('jPlayer/dist/jplayer/')}}",
        supplied: "mp3",
        preload: "none",
        wmode: "window",
        useStateClassSkin: true,
        autoBlur: false,
        keyEnabled: true
    });
});*/
</script>
  <!-- <div style="width: 100%; height: 400px; background-color: black; background: url({{asset('images/audio_images/audio-bg-2.jfif')}}); background-repeat:no-repeat; background-size: cover;">
    <center>
    <div class="row" style="height: 140px"></div>
        <div id="jquery_jplayer_1" class="jp-jplayer"></div>
    <div id="jp_container_1" class="jp-audio-stream" role="application" aria-label="media player" style="width: 150px">
        <div class="jp-type-single">
            <div class="jp-gui jp-interface">
                <div class="jp-volume-controls">
                    <button class="jp-mute" role="button" tabindex="0">mute</button>
                    <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                    <div class="jp-volume-bar">
                        <div class="jp-volume-bar-value"></div>
                    </div>
                </div>
                <div class="jp-controls">
                    <button class="jp-play" role="button" tabindex="0">play</button>
                </div>
            </div>
            <div class="jp-details">
                <div class="jp-title" aria-label="title">&nbsp;</div>
            </div>
            <div class="jp-no-solution">
                <span>Update Required</span>
                To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
            </div>
        </div>
    </div>
    </center>
</div> -->
@elseif($document_edition->isText())
<!-- <div style="background: gray; height: 55px; width: 100%; position: absolute;"></div>
<object type="application/pdf" style="width:100%; height:400px;" class="pdfView pdfviewer"></object>
 -->
<!-- <script
    src="http://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js">
  </script> -->
<!--   <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script> -->
<!-- <script type="text/javascript" src="{{ asset('js/js-pdf-2-0-943.min.js')}}" defer></script>
 -->
 <style>
      .canvas_container {
          width: 800px;
          height: 450px;
          overflow: auto;
      }

      .canvas_container {
        background: #333;
        text-align: center;
        border: solid 3px;
      }
  </style>
     <div id="my_pdf_viewer" style="background: gold;"><!-- 
        <div id="navigation_controls">
            <button id="go_previous">Previous</button>
            <input id="current_page" value="1" type="number"/>
            <button id="go_next">Next</button>
        </div> -->
        <div id="zoom_controls"> 
            <strong>Zoom Level: </strong> 
            <button id="zoom_in">+</button>
            <strong id="currentZoomLevel" style="color: green"></strong>
            <button id="zoom_out">-</button>
        </div>

        <div class="canvas_container" style="width:100%;height:600px;overflow-y:scroll;">
            <div class="pdf_renderer"></div>
        </div>

    </div>

<script>
  var currPage = 1; 
  var currActivePage = 1; 
  var zoom = 0.8; 
  var thePDF = null;
  var numPages = 0;
  var base64Str="";
var url="{{ route('stream_text_image_base64', $document_edition->id) }}";
/*var xhr = new XMLHttpRequest();
xhr.open('GET', url, true);
//xhr.responseType = 'arraybuffer';
xhr.onload = function(e) {
   
    base64Str=this.response;
    //alert(base64Str)
     renderPdfByUrl();
};
xhr.send();*/
//  renderPdfByUrl(base64Str);
$.ajax({
    type:'get',
    url: url,
    success: function(response){
       base64Str=response;
       //alert(base64Str)
        renderPdfByUrl();
    },
    error: function(err){
          console.log('File appears to be corrupted!')
          }
    })
function renderPdfByUrl() {
    if(base64Str==""){
        alert('File appears to be corrupted!');
        return;
    }

    var pdfAsDataUri = "data:application/pdf;base64,"+base64Str; // shortened
    var pdfAsArray = convertDataURIToBinary(pdfAsDataUri);
    var documentObj=pdfjsLib.getDocument(pdfAsArray)
    //var documentObj=pdfjsLib.getDocument('http://localhost/sample.pdf')
          currPage = 1;
          $('#currentZoomLevel').html(Math.round(100*zoom)+'%')
        //This is where you start
        documentObj.then(function(pdf) {

            //Set PDFJS global object (so we can easily access in our page functions
            thePDF = pdf;

            //How many pages it has
            numPages = pdf.numPages;

            //Start with first page
            pdf.getPage(currPage).then(handlePages);
        });
        }
      function handlePages() {
        var viewport;
        thePDF.getPage(currPage).then(function(page) {
          var canvasId = 'pdf_renderer-' + currPage;
          $('.pdf_renderer').append($('<canvas/>', {'id': canvasId}));
          var canvas = document.getElementById(canvasId);
          var context = canvas.getContext('2d');
          viewport = page.getViewport(zoom);
          canvas.height = viewport.height;
          canvas.width = viewport.width;
        //Draw it on the canvas
        //document.body.appendChild(canvas);
        //alert(zoom)
        page.render({
            canvasContext: context,
            viewport: viewport
        });
        canvas.oncontextmenu = function(e) { e.preventDefault(); e.stopPropagation(); }

          var canvasIdFullScreen = 'full_screen_pdf_renderer-' + currPage;
          $('.full_screen_pdf_renderer').append($('<canvas/>', {'id': canvasIdFullScreen}));
          var canvasFullScreen = document.getElementById(canvasIdFullScreen);
          var context = canvasFullScreen.getContext('2d');
          viewport = page.getViewport(1);
          canvasFullScreen.height = viewport.height;
          canvasFullScreen.width = viewport.width;
        //Draw it on the canvas
        //document.body.appendChild(canvas);
        //alert(zoom)
        page.render({
            canvasContext: context,
            viewport: viewport
        });
        canvasFullScreen.oncontextmenu = function(e) { e.preventDefault(); e.stopPropagation(); }

        document.body.oncontextmenu = function(e) { e.preventDefault(); e.stopPropagation(); }

        })
       
        //Move to next page
        currPage++;
        if (thePDF !== null && currPage <= numPages) {
            thePDF.getPage(currPage).then(handlePages);
        }
    }
    $('#zoom_in').on('click', (e) => {
            if(zoom>=2) return
            if(thePDF == null) return;
            zoom += 0.1;
            renderPdfByUrl();
        });

        $('#zoom_out').on('click', (e) => {

            if(thePDF == null) return;
              zoom -= 0.1;
            if(zoom<=0.3) return
            renderPdfByUrl();
        });

      $('#go_previous').on('click', (e) => {
        if(currPage<=1) return
        alert('back'+currActivePage)
              currActivePage-=1;
              handlePages();
          });

        $('#go_next').on('click', (e) => {
          alert('next'+currActivePage)
          if(currActivePage>=numPages) return

              currActivePage+=1;

            handlePages();
        });

function convertDataURIToBinary(dataURI) {
    var _BASE64_MARKER = ';base64,';
   var base64Index = dataURI.indexOf(_BASE64_MARKER) + _BASE64_MARKER.length;
   var base64 = dataURI.substring(base64Index);
   var raw = window.atob(base64);
   var rawLength = raw.length;
   var array = new Uint8Array(new ArrayBuffer(rawLength));

   for(var i = 0; i < rawLength; i++) {
     array[i] = raw.charCodeAt(i);
   }
  return array;
}

    </script>
@elseif($document_edition->isImage())
<img src="{{ route('stream_text_image', $document_edition->id) }}" style="width:100%; height:400px;" class="imageView">
@endif
</div>


                </div>
                <h1><a href="#">{{$document_edition->document!=null? $document_edition->document->title:''}} </a></h1>
                <div class="author">
                    <div class="sv-views">
                        <div class="sv-views-count">
                            {{$document_edition->view_count}} {{App\Global_var::getLangString('Views', $language_strings)}}
                        </div>
                        <div class="sv-views-progress">
                            <div class="sv-views-progress-bar"></div>
                        </div>
                    </div>
                    <div class="info">
                    <div class="custom-tabs">
                        <div class="tabs-panel_">
                        
                            <a href="#" class="active dropdown-toggle" data-toggle="dropdown" data-tab="tab-1" style="padding: 10px">
                                <i class="cv cvicon-cv-about" data-toggle="tooltip" data-placement="top" title="About"></i>
                                <span>{{App\Global_var::getLangString('Basic_Info', $language_strings)}}</span>
                            </a>
                        <div class="dropdown-menu nav-menu-dropdown" style="position: relative; z-index: 100; border-bottom: 5px solid gray; border-right: 2px solid gray;">
                                <div class="col-md-10 col-md-offset-1">
                                    <h4>{{App\Global_var::getLangString('Title', $language_strings)}}: &nbsp; &nbsp; &nbsp; 
                                    <span style="font-size: 15px; color: gray"><strong>{{$document_edition->document!=null? $document_edition->document->title:''}}</strong></span></h4>

                                    <h4>{{App\Global_var::getLangString('Category', $language_strings)}}: &nbsp; &nbsp; &nbsp; 
                                    <span style="font-size: 15px; color: gray">{{$document_edition->document!=null? App\Global_var::getLangString($document_edition->document->category, $language_strings):''}}</span>
                                    </h4>
                                    <h4>{{App\Global_var::getLangString('Author', $language_strings)}}: &nbsp; &nbsp; &nbsp; 
                                    <span style="font-size: 15px; color: gray">{{$document_edition->document!=null && ($author=$document_edition->document->author)!=null? $author->firstName.' '.$author->lastName:''}}</span>
                                    </h4>

                                    <h4>{{App\Global_var::getLangString('Description', $language_strings)}}: &nbsp; &nbsp; &nbsp; 
                                    <span style="font-size: 15px; color: gray">{{$document_edition->description}}</span>
                                    </h4>
                                    <hr>
                                    <div class="row date-lic">
                                        <div class="col-lg-12">
                                            {{App\Global_var::getLangString('Year_of_Publishment', $language_strings)}}: &nbsp; &nbsp; &nbsp; 
                                            <span>{{$document_edition->yearOfPublishment}}</span>
                                        </div>
                                        <div class="col-lg-12"> 
                                            {{App\Global_var::getLangString('Uploaded_Date', $language_strings)}}: &nbsp; &nbsp; &nbsp; 
                                            <span>{{$document_edition->uploadedDateTime}}</span>
                                        </div>
                                    </div>
                                </div>  
                           </div>
                         @if($currentUser->isGranted_ID('documents.share', $document->id))
                            <a href="{{ route('documents.share', $document_edition->id) }}" style="padding: 10px">
                                <i class="cv cvicon-cv-share" data-toggle="tooltip" data-placement="top" title="Share"></i>
                                <span>{{App\Global_var::getLangString('Share', $language_strings)}}</span>
                            </a>
                            @endif
                             @if($currentUser->isGranted_ID('documents.download', $document->id))
                            <a href="{{ route('documents.download', $document_edition->id) }}" style="padding: 10px">
                                <i class="cv cvicon-cv-download" data-toggle="tooltip" data-placement="top" title="Download"></i>
                                <span>{{App\Global_var::getLangString('Download', $language_strings)}}</span>
                            </a>
                            @endif
                            @if($document_edition->isText())
                            <a class="get_ pdfFullScreenBtn" href="#" style="padding: 10px">
                                <span>{{App\Global_var::getLangString('Full_Screen', $language_strings)}}</span> &nbsp; 
                                <i class="glyphicon glyphicon-fullscreen" style="color: green_"></i>
                            </a>
                            @endif
                            
                           <!--  <a href="#">
                                <i class="cv cv cvicon-cv-goto" data-toggle="tooltip" data-placement="top" title="Jump to"></i>
                                <span>Jump to</span>
                            </a>
                            <a href="#">
                                <i class="cv cvicon-cv-plus" data-toggle="tooltip" data-placement="top" title="Add to"></i>
                                <span>Add to</span>
                            </a> -->
                            <!-- <div class="acide-panel">
                                 <a href="#"><i class="cv cvicon-cv-watch-later" data-toggle="tooltip" data-placement="top" title="Watch Later"></i></a>
                                 <a href="#"><i class="cv cvicon-cv-liked" data-toggle="tooltip" data-placement="top" title="Liked"></i></a>
                                 <a href="#"><i class="cv cvicon-cv-flag" data-toggle="tooltip" data-placement="top" title="Flag"></i></a>
                            </div> -->
                        </div>
                        <div class="clearfix"></div>

                        <!-- BEGIN tabs-content -->
                        <div class="tabs-content">
                            <!-- BEGIN tab-1 -->
                            <div class="tab-1">
                                <div>
                                    <h4>{{App\Global_var::getLangString('Title', $language_strings)}}:
                                    <small>{{$document_edition->document!=null? $document_edition->document->title:''}}</small></h4>

                                    <h4>{{App\Global_var::getLangString('Category', $language_strings)}} :
                                    <small>{{$document_edition->document!=null? App\Global_var::getLangString($document_edition->document->category, $language_strings):''}}</small>
                                    </h4>

                                    <h4>{{App\Global_var::getLangString('Description', $language_strings)}} :
                                    <small>{{$document_edition->description}}</small>
                                    </h4>
                                    <div class="row date-lic">
                                        <div class="col-lg-12">
                                            <strong>{{App\Global_var::getLangString('Year_of_Publishment', $language_strings)}}:</strong>
                                            <span>{{$document_edition->yearOfPublishment}}</span>
                                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;    
                                            <strong>{{App\Global_var::getLangString('Uploaded_Date', $language_strings)}}:</strong>
                                            <span>{{$document_edition->uploadedDateTime}}</span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END tab-1 -->
                        </div>
                        <!-- END tabs-content -->
                    </div>
                </div>
                    <div class="clearfix"></div>
                </div>
                
                 <!-- similar videos -->
                    <!-- <div class="caption" style="margin-top: 30px">
                        <div class="left">
                            <h4>Other Videos</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div> -->
                    <div class="list similar-videos" style="margin-top: 30px">

                        <div class="row">
                @foreach($document_editions as $doc_edition)
                <?php if($document_edition->id==$doc_edition->id) continue; ?>
                            <div class="col-lg-3 col-xs-12 col-sm-6 videoitem">
                                <div class="b-video">
                                    <div class="v-img">
                                         <a href="{{route('documents.play', $doc_edition->id)}}"><img src="{{asset('circle_video_sharing/images/small-'.$doc_edition->document->category.'-placeholder.png')}}" alt=""></a>
                                    </div>
                                    <div class="v-desc">
                                       <a href="{{route('documents.play', $doc_edition->id)}}">{{$doc_edition->document->title}}</a>
                                    </div>
                                    <div class="v-views">
                                        {{$doc_edition->view_count}} {{App\Global_var::getLangString('Views', $language_strings)}}
                                    </div>
                                </div>
                            </div>
                @endforeach 
                        </div>
                    </div>
                    <!-- END similar videos -->
            </div>

            <!-- right column -->
            <div class="col-lg-4 col-xs-12 col-sm-12">

                <!-- up next -->
                <div class="caption playlist">
                    <div class="left">
                        <a href="#">{{App\Global_var::getLangString('Related_Documents', $language_strings)}}</a>
                    </div>
                   
                    <div class="clearfix"></div>
                </div>

                <div class="list" style="overflow-y: auto; overflow-x: hidden; height: 600px; background: //green">
                <?php 
                    $i=1;
                    $currentCategory=null;
                 ?>
                @foreach($related_by_author_document_editions as $doc_edition)
                <?php 
                    if($document_edition->id==$doc_edition->id) 
                        continue; 
                    if($currentCategory!=$doc_edition->document->category){
                        $currentCategory=$doc_edition->document->category;
                        echo "<h1>".App\Global_var::getLangString('Related_by_author', $language_strings)." ".App\Global_var::getLangString($currentCategory, $language_strings)."</h1>";

                    }
                ?>
                    <div class="h-video playlist row">
                        <div class="col-lg-5 col-sm-5 col-xs-6">
                            <div class="v-number">
                                <span>{{$i++}}</span>
                            </div>
                            <div class="v-img">
                                <a href="{{route('documents.play', $doc_edition->id)}}"><img src="{{asset('circle_video_sharing/images/small-'.$doc_edition->document->category.'-placeholder.png')}}" alt=""></a>
                                <!-- <div class="time">15:19</div> -->
                            </div>
                        </div>
                        <div class="col-lg-7 col-sm-7 col-xs-6">
                            <div class="v-desc">
                                <a href="{{route('documents.play', $doc_edition->id)}}">{{$doc_edition->document->title}}</a>
                            </div>
                            <div class="v-views">
                                {{$doc_edition->view_count}} {{App\Global_var::getLangString('Views', $language_strings)}}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @endforeach
                    <?php $currentCategory=null; ?>
                    @foreach($related_by_publisher_document_editions as $doc_edition)
                    <?php 
                        if($document_edition->id==$doc_edition->id) 
                            continue;
                        if($currentCategory!=$doc_edition->document->category){
                            $currentCategory=$doc_edition->document->category;
                            echo "<h1>".App\Global_var::getLangString('Related_by_publisher', $language_strings)." ".App\Global_var::getLangString($currentCategory, $language_strings)."</h1>";
                        }
                     ?>

                    <div class="h-video playlist row">
                        <div class="col-lg-5 col-sm-5 col-xs-6">
                            <div class="v-number">
                                <span>{{$i++}}</span>
                            </div>
                            <div class="v-img">
                                <a href="{{route('documents.play', $doc_edition->id)}}"><img src="{{asset('circle_video_sharing/images/small-'.$doc_edition->document->category.'-placeholder.png')}}" alt=""></a>
                                <!-- <div class="time">15:19</div> -->
                            </div>
                        </div>
                        <div class="col-lg-7 col-sm-7 col-xs-6">
                            <div class="v-desc">
                                <a href="{{route('documents.play', $doc_edition->id)}}">{{$doc_edition->document->title}}</a>
                            </div>
                            <div class="v-views">
                                {{$doc_edition->view_count}} {{App\Global_var::getLangString('Views', $language_strings)}}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @endforeach
                </div>
                <!-- END up next -->

                <!-- load more -->
               <!--  <div class="loadmore">
                    <a href="#">Show more videos</a>
                </div> -->
            </div>
        </div>
    </div>
</div>

<div style="display: none; position: fixed; top: 0; bottom: 0; right: 0; left: 0; width: 100%; height: 100%; z-index: 100; background: grey" class="pdfViewFullScreen">   
<div class="col-md-12" style="z-index: 102;">
    <a class="get_ pdfExitFullScreenBtn pull-left" href="#" style="padding: 30px">
    <i class="fa fa-arrows-alt" style="color: red"></i></a>

    <a class="get_ pdfExitFullScreenBtn pull-right" href="#" style="padding: 30px">
    <i class="fa fa-arrows-alt" style="color: red"></i></a>
    <div class="canvas_container" style="width:100%;height:600px;overflow-y:scroll;">
        <div class="full_screen_pdf_renderer"></div>
    </div>
</div>
<!-- <embed src="{{ route('stream_text_image', $document_edition->id) }}#toolbar=0&navpanes=0&scrollbar=0" style=" position: fixed; top: 0; bottom: 0; right: 0; left: 0; width: 100%; height: 100%; z-index: 100" />
 -->
<div style="background: gray; height: 55px; width: 100%; position: absolute; z-index: 101"></div>
 <object class="pdfviewer" type="application/pdf" style=" position: fixed; top: 0; bottom: 0; right: 0; left: 0; width: 100%; height: 100%; z-index: 100"></object>
</div>
<img src="{{ route('stream_text_image', $document_edition->id) }}" style="display: none; position: fixed; top: 0; bottom: 0; right: 0; left: 0; width: 100%; height: 100%; z-index: 100" class="imageViewFullScreen">

</div>

<div class="col-xs-12">
    <center>{{$documents->links()}}</center>
</div>


<!-- Create Pdf from byte -->
<!-- <script type="text/javascript">
var url="{{ route('stream_text_image', $document_edition->id) }}";
var xhr = new XMLHttpRequest();
xhr.open('GET', url, true);
xhr.responseType = 'arraybuffer';
xhr.onload = function(e) {
   if (true/*this.status == 200*/) {
        var blob=new Blob([this.response], {type:"application/pdf"});
        var pdfurl = window.URL.createObjectURL(blob)+"#view=FitW";
        $(".pdfviewer").attr("data",pdfurl+'#toolbar=0&navpanes=0&scrollbar=0');
   }
};
xhr.send();
</script> -->