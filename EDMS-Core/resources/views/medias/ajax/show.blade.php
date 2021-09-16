<?php 
$document_edition->handleViewsCount();
?>

<div class="col-md-12" style="margin-top: -60px">
<div class="panel panel-success">
    <div class="panel-heading">

    </div>
    <div class="panel-body" style="height: 200px">
    <div class="col-md-10 col-md-offset-1">
@if($document_edition->isVideo_Audio())
<div class="col-md-12" oncontextmenu="return false">
    {{--
    @if($document_edition->isVideo())
            <video id="video1"  width="1000" autoplay controls controlsList="nodownload">
                <source src="{{ route('stream_media', $document_edition->id) }}" type="video/mp4">
                Your browser does not support HTML5 video.
              </video>
        
            @elseif($document_edition->isAudio())
              <embed src="{{ route('stream_media', $document_edition->id) }}" width="1000" height="500" type="audio/mp3" />
            @endif
            --}}
<div class="grid">
            <header>
                <h1>Pl<span>a</span>y<span>e</span>r</h1>
                <p>
                    A simple, accessible and customisable media player for
                    <button type="button" class="faux-link" data-source="video">
                        <svg class="icon">
                            <title>HTML5</title>
                            <path
                                d="M14.738.326C14.548.118 14.28 0 14 0H2c-.28 0-.55.118-.738.326S.98.81 1.004 1.09l1 11c.03.317.208.603.48.767l5 3c.16.095.338.143.516.143s.356-.048.515-.143l5-3c.273-.164.452-.45.48-.767l1-11c.026-.28-.067-.557-.257-.764zM12 4H6v2h6v5.72l-4 1.334-4-1.333V9h2v1.28l2 .666 2-.667V8H4V2h8v2z"
                            ></path></svg
                        >Video</button
                    >,
                    <button type="button" class="faux-link" data-source="audio">
                        <svg class="icon">
                            <title>HTML5</title>
                            <path
                                d="M14.738.326C14.548.118 14.28 0 14 0H2c-.28 0-.55.118-.738.326S.98.81 1.004 1.09l1 11c.03.317.208.603.48.767l5 3c.16.095.338.143.516.143s.356-.048.515-.143l5-3c.273-.164.452-.45.48-.767l1-11c.026-.28-.067-.557-.257-.764zM12 4H6v2h6v5.72l-4 1.334-4-1.333V9h2v1.28l2 .666 2-.667V8H4V2h8v2z"
                            ></path></svg
                        >Audio</button
                    >,
                    <button type="button" class="faux-link" data-source="youtube">
                        <svg class="icon" role="presentation">
                            <title>YouTube</title>
                            <path
                                d="M15.8,4.8c-0.2-1.3-0.8-2.2-2.2-2.4C11.4,2,8,2,8,2S4.6,2,2.4,2.4C1,2.6,0.3,3.5,0.2,4.8C0,6.1,0,8,0,8
                   s0,1.9,0.2,3.2c0.2,1.3,0.8,2.2,2.2,2.4C4.6,14,8,14,8,14s3.4,0,5.6-0.4c1.4-0.3,2-1.1,2.2-2.4C16,9.9,16,8,16,8S16,6.1,15.8,4.8z
                    M6,11V5l5,3L6,11z"
                            ></path></svg
                        >YouTube
                    </button>
                    and
                    <button type="button" class="faux-link" data-source="vimeo">
                        <svg class="icon" role="presentation">
                            <title>Vimeo</title>
                            <path
                                d="M16,4.3c-0.1,1.6-1.2,3.7-3.3,6.4c-2.2,2.8-4,4.2-5.5,4.2c-0.9,0-1.7-0.9-2.4-2.6C4,9.9,3.4,5,2,5
                       C1.9,5,1.5,5.3,0.8,5.8L0,4.8c0.8-0.7,3.5-3.4,4.7-3.5C5.9,1.2,6.7,2,7,3.8c0.3,2,0.8,6.1,1.8,6.1c0.9,0,2.5-3.4,2.6-4
                       c0.1-0.9-0.3-1.9-2.3-1.1c0.8-2.6,2.3-3.8,4.5-3.8C15.3,1.1,16.1,2.2,16,4.3z"
                            ></path></svg
                        >Vimeo
                    </button>
                </p>

                <p>
                    Premium video monetization from
                    <a href="https://vi.ai/publisher-video-monetization/?aid=plyrio" target="_blank" class="no-border">
                        <img src="https://cdn.plyr.io/static/vi-logo-24x24.svg" alt="ai.vi" />
                        <span class="sr-only">ai.vi</span>
                    </a>
                </p>

                <div class="call-to-action">
                    <a href="https://github.com/sampotts/plyr" target="_blank" class="button js-shr">
                        <svg class="icon" role="presentation">
                            <title>GitHub</title>
                            <path
                                d="M8,0.2c-4.4,0-8,3.6-8,8c0,3.5,2.3,6.5,5.5,7.6
            C5.9,15.9,6,15.6,6,15.4c0-0.2,0-0.7,0-1.4C3.8,14.5,3.3,13,3.3,13c-0.4-0.9-0.9-1.2-0.9-1.2c-0.7-0.5,0.1-0.5,0.1-0.5
            c0.8,0.1,1.2,0.8,1.2,0.8C4.4,13.4,5.6,13,6,12.8c0.1-0.5,0.3-0.9,0.5-1.1c-1.8-0.2-3.6-0.9-3.6-4c0-0.9,0.3-1.6,0.8-2.1
            c-0.1-0.2-0.4-1,0.1-2.1c0,0,0.7-0.2,2.2,0.8c0.6-0.2,1.3-0.3,2-0.3c0.7,0,1.4,0.1,2,0.3c1.5-1,2.2-0.8,2.2-0.8
            c0.4,1.1,0.2,1.9,0.1,2.1c0.5,0.6,0.8,1.3,0.8,2.1c0,3.1-1.9,3.7-3.7,3.9C9.7,12,10,12.5,10,13.2c0,1.1,0,1.9,0,2.2
            c0,0.2,0.1,0.5,0.6,0.4c3.2-1.1,5.5-4.1,5.5-7.6C16,3.8,12.4,0.2,8,0.2z"
                            ></path>
                        </svg>
                        Download on GitHub
                    </a>
                </div>
            </header>

            <main>
                <div id="container">
         <video width="1000" controls crossorigin playsinline poster="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg" id="player">
                <source
                    src="{{ route('stream_media', $document_edition->id) }}"
                    type="video/mp4"
                    size="576"
                />
                <source
                    src="{{ route('stream_media', $document_edition->id) }}"
                    type="video/mp4"
                    size="720"
                />
                <source
                    src="{{ route('stream_media', $document_edition->id) }}"
                    type="video/mp4"
                    size="1080"
                />

                <!-- Caption files -->
                <track
                    kind="captions"
                    label="English"
                    srclang="en"
                    src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt"
                    default
                />
                <track
                    kind="captions"
                    label="Français"
                    srclang="fr"
                    src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt"
                />

                <!-- Fallback for browsers that don't support the <video> element -->
                <a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" download
                    >Download</a
                >
            </video> 
                </div>

                <ul>
                    <li class="plyr__cite plyr__cite--video" hidden>
                        <small>
                            <svg class="icon">
                                <title>HTML5</title>
                                <path
                                    d="M14.738.326C14.548.118 14.28 0 14 0H2c-.28 0-.55.118-.738.326S.98.81 1.004 1.09l1 11c.03.317.208.603.48.767l5 3c.16.095.338.143.516.143s.356-.048.515-.143l5-3c.273-.164.452-.45.48-.767l1-11c.026-.28-.067-.557-.257-.764zM12 4H6v2h6v5.72l-4 1.334-4-1.333V9h2v1.28l2 .666 2-.667V8H4V2h8v2z"
                                ></path>
                            </svg>
                            <a
                                href="https://itunes.apple.com/au/movie/view-from-a-blue-moon/id1041586323"
                                target="_blank"
                                >View From A Blue Moon</a
                            >
                            &copy; Brainfarm
                        </small>
                    </li>
                    <li class="plyr__cite plyr__cite--audio" hidden>
                        <small>
                            <svg class="icon" title="HTML5">
                                <title>HTML5</title>
                                <path
                                    d="M14.738.326C14.548.118 14.28 0 14 0H2c-.28 0-.55.118-.738.326S.98.81 1.004 1.09l1 11c.03.317.208.603.48.767l5 3c.16.095.338.143.516.143s.356-.048.515-.143l5-3c.273-.164.452-.45.48-.767l1-11c.026-.28-.067-.557-.257-.764zM12 4H6v2h6v5.72l-4 1.334-4-1.333V9h2v1.28l2 .666 2-.667V8H4V2h8v2z"
                                ></path>
                            </svg>
                            <a href="http://www.kishibashi.com/" target="_blank"
                                >Kishi Bashi &ndash; &ldquo;It All Began With A Burst&rdquo;</a
                            >
                            &copy; Kishi Bashi
                        </small>
                    </li>
                    <li class="plyr__cite plyr__cite--youtube" hidden>
                        <small>
                            <a href="https://www.youtube.com/watch?v=bTqVqk7FSmY" target="_blank"
                                >View From A Blue Moon</a
                            >
                            on&nbsp;
                            <span class="color--youtube">
                                <svg class="icon" role="presentation">
                                    <title>YouTube</title>
                                    <path
                                        d="M15.8,4.8c-0.2-1.3-0.8-2.2-2.2-2.4C11.4,2,8,2,8,2S4.6,2,2.4,2.4C1,2.6,0.3,3.5,0.2,4.8C0,6.1,0,8,0,8
                                   s0,1.9,0.2,3.2c0.2,1.3,0.8,2.2,2.2,2.4C4.6,14,8,14,8,14s3.4,0,5.6-0.4c1.4-0.3,2-1.1,2.2-2.4C16,9.9,16,8,16,8S16,6.1,15.8,4.8z
                                    M6,11V5l5,3L6,11z"
                                    ></path></svg
                                >YouTube
                            </span>
                        </small>
                    </li>
                    <li class="plyr__cite plyr__cite--vimeo" hidden>
                        <small>
                            <a href="https://vimeo.com/40648169" target="_blank">Toob “Wavaphon” Music Video</a>
                            on&nbsp;
                            <span class="color--vimeo">
                                <svg class="icon" role="presentation">
                                    <title>Vimeo</title>
                                    <path
                                        d="M16,4.3c-0.1,1.6-1.2,3.7-3.3,6.4c-2.2,2.8-4,4.2-5.5,4.2c-0.9,0-1.7-0.9-2.4-2.6C4,9.9,3.4,5,2,5
                               C1.9,5,1.5,5.3,0.8,5.8L0,4.8c0.8-0.7,3.5-3.4,4.7-3.5C5.9,1.2,6.7,2,7,3.8c0.3,2,0.8,6.1,1.8,6.1c0.9,0,2.5-3.4,2.6-4
                               c0.1-0.9-0.3-1.9-2.3-1.1c0.8-2.6,2.3-3.8,4.5-3.8C15.3,1.1,16.1,2.2,16,4.3z"
                                    ></path></svg
                                >Vimeo
                            </span>
                        </small>
                    </li>
                </ul>
            </main>
        </div>

<!-- 
    <div class="col-md-12">
        <hr>
    <div class="col-md-10">
        <div class="col-md-12">
            <strong>{{App\Global_var::getLangString('Title', $language_strings)}}:</strong> {{$document_edition->document!=null? $document_edition->document->title:''}}  
        <strong class="pull-right" style="margin-right: 50px"> {{App\Global_var::getLangString('Views', $language_strings)}}: <label class="badge bg-orange">{{$document_edition->view_count}}</label></strong>
        </div>
        <div class="col-md-12">
             <strong>{{App\Global_var::getLangString('Uploaded_Date', $language_strings)}}:</strong> {{$document_edition->uploadedDateTime}}  
        </div>
        <div class="col-md-12">
             <strong>{{App\Global_var::getLangString('Size', $language_strings)}}:</strong> {{$document_edition->sizeInfo()}} 
        </div>
    </div>
    <div class="col-md-2">
    @if($currentUser->isGranted_ID('documents.download', $document_edition->id))
    <a class="btn btn-success" href="{{ route('documents.download', $document_edition->id) }}"><i class="fa fa-download"></i>
      {{App\Global_var::getLangString('Download', $language_strings)}}
    </a>
    @endif
    </div>
    </div>
 -->
</div>
@elseif($document_edition->isText_Image())
<div class="col-md-12">

<!--     <div class="col-md-12">
        <hr>
    <div class="col-md-10">
        <div class="col-md-12">
            <strong>{{App\Global_var::getLangString('Title', $language_strings)}}:</strong> {{$document_edition->document!=null? $document_edition->document->title:''}} 
        <strong class="pull-right" style="margin-right: 50px"> {{App\Global_var::getLangString('Views', $language_strings)}}: <label class="badge bg-orange">{{$document_edition->view_count}}</label></strong>
        </div>
        <div class="col-md-12">
             <strong>{{App\Global_var::getLangString('Size', $language_strings)}}:</strong> {{$document_edition->sizeInfo()}} &nbsp;   &nbsp;   
             <strong>{{App\Global_var::getLangString('Uploaded_Date', $language_strings)}}: </strong>{{$document_edition->uploadedDateTime}} 
        </div>
    </div>
    <div class="col-md-2">
    @if($currentUser->isGranted_ID('documents.download', $document_edition->id))
    <a class="btn btn-success" href="{{ route('documents.download', $document_edition->id) }}"><i class="fa fa-download"></i>
      {{App\Global_var::getLangString('Download', $language_strings)}}
    </a>
    @endif
    </div>
    </div>
 -->
<iframe src="{{ route('stream_text_image', $document_edition->id) }}"  width="100%" height="15000" ></iframe>
<div style="position: fixed; top: 0px; bottom: 0px; right: 0px; left: 0px;">
</div> 

<!--     <div class="col-md-12" style="background: gray; height: 1px; margin-top: 10px"></div>
      <embed src="{{ route('stream_text_image', $document_edition->id) }}#toolbar=0&navpanes=0&scrollbar=0" width="1000" height="500" />
 -->
{{-- <iframe src="http://docs.google.com/gview?url={{ route('stream_text_image', $document_edition->id) }}&embedded=true" style="width:600px; height:500px;" frameborder="0">
</iframe>--}}

</div>
@endif


    <div class="col-md-12">
        <hr>
    <div class="col-md-10">
        <div class="col-md-12">
            <strong>{{App\Global_var::getLangString('Title', $language_strings)}}:</strong> {{$document_edition->document!=null? $document_edition->document->title:''}}  
        <strong class="pull-right" style="margin-right: 50px"> {{App\Global_var::getLangString('Views', $language_strings)}}: <label class="badge bg-orange">{{$document_edition->view_count}}</label></strong>
        </div>
        <div class="col-md-12">
             <strong>{{App\Global_var::getLangString('Year_of_Publishment', $language_strings)}}:</strong> {{$document_edition->yearOfPublishment}}  
        </div>
        <div class="col-md-12">
             <strong>{{App\Global_var::getLangString('Size', $language_strings)}}:</strong> {{$document_edition->sizeInfo()}} 
        </div>
    </div>
    <div class="col-md-2">
    @if($currentUser->isGranted_ID('documents.download', $document_edition->id))
    <a class="btn btn-success" href="{{ route('documents.download', $document_edition->id) }}"><i class="fa fa-download"></i>
      {{App\Global_var::getLangString('Download', $language_strings)}}
    </a>
    @endif
    </div>
    </div>

</div>
</div>
</div>

</div>


<script type='text/javascript'>
   document.addEventListener("contextmenu", function (e) {
        e.preventDefault();
        //alert("here")
        return false;
    }, false);
</script>