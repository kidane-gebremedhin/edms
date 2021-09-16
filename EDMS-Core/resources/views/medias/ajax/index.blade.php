{{--<div class="col-md-12">
<div class="col-md-6" style="text-align:center"> 
  <button onclick="playPause()">Play/Pause</button> 
  <button onclick="makeBig()">Big</button>
  <button onclick="makeSmall()">Small</button>
  <button onclick="makeNormal()">Normal</button>
  <br><br>
  <video id="video1" width="420">
    <source src="{{ route('stream_video') }}" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>
</div> 

<!-- Audio -->
<div class="col-md-6" style="text-align:center"> 
  <button onclick="a_playPause()">Play/Pause</button> 
  <button onclick="a_makeBig()">Big</button>
  <button onclick="a_makeSmall()">Small</button>
  <button onclick="a_makeNormal()">Normal</button>
  <br><br>
  <audio id="audio1" width="420">
    <source src="{{ route('stream_audio') }}" type="audio/mp3">
    Your browser does not support HTML5 audio.
  <source src="{{ route('stream_audio') }}" type="audio/ogg">

  </audio>
</div> 

<div class="col-md-6" style="text-align:center"> 
<object data="{{asset('image1.jpg')}}"></object>
</div>
</div>
<script> 
var myVideo = document.getElementById("video1"); 

function playPause() { 
  if (myVideo.paused) 
    myVideo.play(); 
  else 
    myVideo.pause(); 
} 

function makeBig() { 
    myVideo.width = 1000; 
} 

function makeSmall() { 
    myVideo.width = 320; 
} 

function makeNormal() { 
    myVideo.width = 620; 
} 
</script> 

<script> 
var myAudio = document.getElementById("audio1"); 

function a_playPause() { 
  if (myAudio.paused) 
    myAudio.play(); 
  else 
    myAudio.pause(); 
} 

function a_makeBig() { 
    myAudio.width = 1000; 
} 

function a_makeSmall() { 
    myAudio.width = 320; 
} 

function a_makeNormal() { 
    myAudio.width = 620; 
} 
</script> 

--}}


<link href="{{asset('jPlayer/dist/skin/pink.flag/css/jplayer.pink.flag.min.css')}}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{asset('jPlayer/dist/jplayer/jquery.jplayer.min.js')}}"></script>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){

  $("#jquery_jplayer_1").jPlayer({
    ready: function () {
      $(this).jPlayer("setMedia", {
        title: "Big Buck Bunny Trailer",
        m4v: "{{ route('stream_video') }}",
        poster: "image1.png"
      });
    },
    play: function() { // To avoid multiple jPlayers playing together.
      $(this).jPlayer("pauseOthers");
    },
    swfPath: "{{asset('jPlayer/dist/jplayer')}}",
    supplied: "webmv, ogv, m4v",
    globalVolume: true,
    useStateClassSkin: true,
    autoBlur: false,
    smoothPlayBar: true,
    keyEnabled: true
  });

  $("#jquery_jplayer_2").jPlayer({
    ready: function () {
      $(this).jPlayer("setMedia", {
        title: "Incredibles Teaser",
        m4v: "{{ route('stream_video') }}",
        poster: "image1.png"
      });
    },
    play: function() { // To avoid multiple jPlayers playing together.
      $(this).jPlayer("pauseOthers");
    },
    swfPath: "{{asset('jPlayer/dist/jplayer')}}",
    supplied: "webmv, ogv, m4v",
    cssSelectorAncestor: "#jp_container_2",
    globalVolume: true,
    useStateClassSkin: true,
    autoBlur: false,
    smoothPlayBar: true,
    keyEnabled: true
  });

  $("#jquery_jplayer_3").jPlayer({
    ready: function () {
      $(this).jPlayer("setMedia", {
        title: "Finding Nemo Teaser",
        m4v: "{{ route('stream_video') }}",
        poster: "image1.png"
      });
    },
    play: function() { // To avoid multiple jPlayers playing together.
      $(this).jPlayer("pauseOthers");
    },
    swfPath: "{{asset('jPlayer/dist/jplayer')}}",
    supplied: "webmv, ogv, m4v",
    cssSelectorAncestor: "#jp_container_3",
    globalVolume: true,
    useStateClassSkin: true,
    autoBlur: false,
    smoothPlayBar: true,
    keyEnabled: true
  });
});
//]]>
</script>

<div class="col-md-12">
<div class="col-md-6">
<div id="jp_container_1" class="jp-video jp-video-270p" role="application" aria-label="media player" style="margin-bottom: 30px">
  <div class="jp-type-single">
    <div id="jquery_jplayer_1" class="jp-jplayer"></div>
    <div class="jp-gui">
      <div class="jp-video-play">
        <button class="jp-video-play-icon" role="button" tabindex="0">play</button>
      </div>
      <div class="jp-interface">
        <div class="jp-progress">
          <div class="jp-seek-bar">
            <div class="jp-play-bar"></div>
          </div>
        </div>
        <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
        <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
        <div class="jp-details">
          <div class="jp-title" aria-label="title">&nbsp;</div>
        </div>
        <div class="jp-controls-holder">
          <div class="jp-volume-controls">
            <button class="jp-mute" role="button" tabindex="0">mute</button>
            <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
            <div class="jp-volume-bar">
              <div class="jp-volume-bar-value"></div>
            </div>
          </div>
          <div class="jp-controls">
            <button class="jp-play" role="button" tabindex="0">play</button>
            <button class="jp-stop" role="button" tabindex="0">stop</button>
          </div>
          <div class="jp-toggles">
            <button class="jp-repeat" role="button" tabindex="0">repeat</button>
            <button class="jp-full-screen" role="button" tabindex="0">full screen</button>
          </div>
        </div>
      </div>
    </div>
    <div class="jp-no-solution">
      <span>Update Required</span>
      To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
    </div>
  </div>
</div>
</div>
<div class="col-md-6">
<div id="jp_container_2" class="jp-video jp-video-270p" role="application" aria-label="media player" style="margin-bottom: 30px">
  <div class="jp-type-single">
    <div id="jquery_jplayer_2" class="jp-jplayer"></div>
    <div class="jp-gui">
      <div class="jp-video-play">
        <button class="jp-video-play-icon" role="button" tabindex="0">play</button>
      </div>
      <div class="jp-interface">
        <div class="jp-progress">
          <div class="jp-seek-bar">
            <div class="jp-play-bar"></div>
          </div>
        </div>
        <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
        <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
        <div class="jp-details">
          <div class="jp-title" aria-label="title">&nbsp;</div>
        </div>
        <div class="jp-controls-holder">
          <div class="jp-volume-controls">
            <button class="jp-mute" role="button" tabindex="0">mute</button>
            <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
            <div class="jp-volume-bar">
              <div class="jp-volume-bar-value"></div>
            </div>
          </div>
          <div class="jp-controls">
            <button class="jp-play" role="button" tabindex="0">play</button>
            <button class="jp-stop" role="button" tabindex="0">stop</button>
          </div>
          <div class="jp-toggles">
            <button class="jp-repeat" role="button" tabindex="0">repeat</button>
            <button class="jp-full-screen" role="button" tabindex="0">full screen</button>
          </div>
        </div>
      </div>
    </div>
    <div class="jp-no-solution">
      <span>Update Required</span>
      To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
    </div>
  </div>
</div>
</div>
<div class="col-md-6">
<div id="jp_container_3" class="jp-video jp-video-270p" role="application" aria-label="media player" style="margin-bottom: 30px">
  <div class="jp-type-single">
    <div id="jquery_jplayer_3" class="jp-jplayer"></div>
    <div class="jp-gui">
      <div class="jp-video-play">
        <button class="jp-video-play-icon" role="button" tabindex="0">play</button>
      </div>
      <div class="jp-interface">
        <div class="jp-progress">
          <div class="jp-seek-bar">
            <div class="jp-play-bar"></div>
          </div>
        </div>
        <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
        <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
        <div class="jp-details">
          <div class="jp-title" aria-label="title">&nbsp;</div>
        </div>
        <div class="jp-controls-holder">
          <div class="jp-volume-controls">
            <button class="jp-mute" role="button" tabindex="0">mute</button>
            <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
            <div class="jp-volume-bar">
              <div class="jp-volume-bar-value"></div>
            </div>
          </div>
          <div class="jp-controls">
            <button class="jp-play" role="button" tabindex="0">play</button>
            <button class="jp-stop" role="button" tabindex="0">stop</button>
          </div>
          <div class="jp-toggles">
            <button class="jp-repeat" role="button" tabindex="0">repeat</button>
            <button class="jp-full-screen" role="button" tabindex="0">full screen</button>
          </div>
        </div>
      </div>
    </div>
    <div class="jp-no-solution">
      <span>Update Required</span>
      To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
    </div>
  </div>
</div>
</div>
</div>
