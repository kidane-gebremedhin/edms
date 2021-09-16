<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{asset('images/'.$logo->logoImage)}}" sizes="32x32" />

    <title>{{App\Global_var::getLangString($logo!=null? $logo->logoText :'E-DMS', $language_strings)}}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('circle_video_sharing/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- player -->
    <link rel="stylesheet" href="{{asset('circle_video_sharing/js/vendor/player/johndyer-mediaelement-89793bc/build/mediaelementplayer.min.css')}}" />

    <!-- Theme CSS -->
    <link href="{{asset('circle_video_sharing/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('circle_video_sharing/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('circle_video_sharing/css/font-circle-video.css')}}" rel="stylesheet">

    <link href="{{ asset('css/tinymce/css/select2.min.css')}}" rel="stylesheet" >

    <!-- font-family: 'Hind', sans-serif; -->
    <link href='https://fonts.googleapis.com/css?family=Hind:400,300,500,600,700|Hind+Guntur:300,400,500,700' rel='stylesheet' type='text/css'>
    <!-- Docs styles -->
<!--     <link rel="stylesheet" href="{{asset('dist/demo.css')}}" /> -->

<script src="{{asset('circle_video_sharing/js/jquery.min.js')}}"></script>
<script src="{{asset('circle_video_sharing/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- JPlayer -->

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="{{ asset('jPlayer/dist/skin/pink.flag/css/jplayer.pink.flag.min.css')}}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ asset('jPlayer/dist/jplayer/jquery.jplayer.min.js')}}"></script>
<!-- end of Jplayer -->
</head>

<body class="single-video light">
<input type="hidden" id="searchUrl" value="{{route('documents.playlist')}}">

@if(!\App\Global_var::isChrome())
    <div id="message-error-displayer" style="margin-top: 30px">
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
           <strong id="message-error">{{App\Global_var::getLangString('This_System_Is_Fully_Supported_in_Chrome', $language_strings)}}</strong>
          </div>
    </div>
@endif

<!-- logo, menu, search, avatar -->
<div class="container-fluid">
    <div class="row">
        <div class="navbar-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        @if(!$currentUser->isPublic())
                        <a href="{{route('home')}}"> 
                        <h3 style="font-family: georgia; color: black"> 
                        <i class="fa fa-dashboard" style="color: orange"></i> {{App\Global_var::getLangString('Dashboard', $language_strings)}} 
                        </h3>
                        </a>
                    @endif
                    </div>
                    <div class="col-md-9">
                    <a href="{{route(!$currentUser->isPublic()? 'home':'welcome')}}"> 
                    <h3 style="font-family: algerian; color: orange;"> {{App\Global_var::getLangString($logo!=null? $logo->logoText :'E-DMS', $language_strings)}}
                    </h3>
                    </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1 col-sm-2 col-xs-2">
                    <a class="navbar-brand" href="{{route(!$currentUser->isPublic()? 'home':'welcome')}}"><img src="{{asset('images/'.$logo->logoImage)}}" alt="Project name" class="logo" style="background-color: green; border-radius: 50%; height: 60px; width: 60px; "/></a>
                    </div>
                    <div class="col-lg-3 col-sm-10 col-xs-10"  style="margin-top: 20px">
                            <div class="col-md-6">
                             {!! Form::select('category', [null=>App\Global_var::getLangString('Category', $language_strings)]+$categories, null, array('class'=>'select2 form-control document_search_select_elem category'));!!}
                            </div>
                            <div class="col-md-6">
                             {!! Form::select('yearOfPublishment', [null=>App\Global_var::getLangString('Year_of_Publishment', $language_strings)]+$years, null, array('class'=>'select2 form-control document_search_select_elem yearOfPublishment'));!!}
                            </div>
                    </div>
                    <div class="visible-xs visible-sm clearfix"></div>
                    <div class="col-lg-6 col-sm-8 col-xs-12">
                        <form action="search.html" method="post">
                            <div class="topsearch">
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-search"></i></span>
                                    <input type="text" class="form-control document_search_input_elem title" placeholder="{{App\Global_var::getLangString('Search_by_title_or_author', $language_strings)}}" aria-describedby="sizing-addon2">
                                    <div class="input-group-btn">
                                        <span type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-search"></i><i class="fa fa-globe"></i>&nbsp;&nbsp;&nbsp;</span><!-- /
                                        <ul class="dropdown-menu">
                                            <li><a href="#"><i class="cv cvicon-cv-relevant"></i> Relevant</a></li>
                                            <li><a href="#"><i class="cv cvicon-cv-calender"></i> Recent</a></li>
                                            <li><a href="#"><i class="cv cvicon-cv-view-stats"></i> Viewed</a></li>
                                            <li><a href="#"><i class="cv cvicon-cv-star"></i> Top Rated</a></li>
                                            <li><a href="#"><i class="cv cvicon-cv-watch-later"></i> Longest</a></li>
                                        </ul> -->
                                    </div><!-- /btn-group -->
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="visible-xs clearfix"></div>
                    <div class="col-lg-2 col-sm-4  col-xs-8">
                        <!-- <div class="avatar pull-left">
                            <img src="{{asset('circle_video_sharing/images/avatar.png')}}" alt="avatar" />
                            <span class="status"></span>
                        </div> -->
                        <div class="selectuser col-md-5 pull-left">
                            <div class="btn-group pull-right dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    {{$currentUser->isPublic()? App\Global_var::getLangString('Guest', $language_strings): $currentUser->firstName}}
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                @if($currentUser->isPublic())
                                    <li><a href="{{route('login')}}">{{App\Global_var::getLangString('Login', $language_strings)}}</a></li>
                                    <li><a href="{{route('register')}}">{{App\Global_var::getLangString('Sign_Up', $language_strings)}}</a></li>
                                @else
                                    <li><a class="btn btn-warning btn-flat btn-block" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i>
                                <span>
                                 {{App\Global_var::getLangString('Sign_Out', $language_strings)}}
                                </span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }} 
                           </form></li>
                                @endif
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix">
                        <div class="dropdown pull-right" style="margin-top: 25px">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{App\Global_var::getLangString('Language', $language_strings)}} <b class="caret"></b></a>
            <ul class="dropdown-menu nav-menu-dropdown">
                <li>
                    <a class="get_"  href="{{route('language_strings.changeLanguage', 'tig')}}"> {{App\Global_var::getLangString('Tigrigna', $language_strings)}} <i class="fa {{\Session::get('selectedLang')=='tig'? 'fa-check':''}}"></i></a>
                </li>
                <li>
                    <a class="get_"  href="{{route('language_strings.changeLanguage', 'amh')}}"> {{App\Global_var::getLangString('Amharic', $language_strings)}} <i class="fa {{\Session::get('selectedLang')=='amh'? 'fa-check':''}}"></i> </a>
                </li>
                <li>
                    <a class="get_"  href="{{route('language_strings.changeLanguage', 'eng')}}"> {{App\Global_var::getLangString('English', $language_strings)}} <i class="fa {{\Session::get('selectedLang')=='eng'? 'fa-check':''}}"></i></a>
                </li>
                   
                </ul>
            </div> 
                        </div>
                    </div>
                
                    <div class="col-md-11 col-md-offset-1">
                    <div class="col-md-2">
                     {!! Form::select('subCategory', [null=>App\Global_var::getLangString('Sub_category', $language_strings)]+$sub_categories, null, array('class'=>'select2 form-control document_search_select_elem subCategory'));!!}
                    </div>
                    <div class="col-md-8">
                        <div class="row summerySearchDiv" style="display: none;">
                            {!! Form::textarea('summery', null, array('class'=>'form-control document_search_select_elem__ summery', 'rows'=>'1', 'placeholder'=>App\Global_var::getLangString('Summery', $language_strings)));!!}
                            <button class="closeSummerySearchBtn btn btn-warning btn-xs" style="color: red; display: none; position: absolute; top: 0; right: 0">X</button>
                        </div>
                        <div class="row summerySearchBtn">
                            <a href="#" class="showSummerySearchBtn " style="color: orange;"><strong>{{App\Global_var::getLangString('Search_by_content_summery', $language_strings)}}</strong></a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="pull-right">
                        @if(!$currentUser->isPublic())
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{App\Global_var::getLangString('User_Mannual', $language_strings)}} <b class="caret"></b></a>
                            <ul class="dropdown-menu nav-menu-dropdown">
                            <li>
                                <a class="get_" target="_blank" href="{{asset('mannuals/User-Mannual-Tigrigna.pdf')}}">
                                <i class="fa fa-circle-o"></i> <span>                            {{App\Global_var::getLangString('Tigrigna', $language_strings)}} {{App\Global_var::getLangString('User_Mannual', $language_strings)}}
                                </span>
                              </a>
                            </li>
                            <li>
                                <a class="get_" target="_blank" href="{{asset('mannuals/User-Mannual-English.pdf')}}"><i class="fa fa-circle-o"></i> {{App\Global_var::getLangString('English', $language_strings)}} {{App\Global_var::getLangString('User_Mannual', $language_strings)}}</a>
                            </li>
                            </ul>
                    @else
                       <a href="{{$logo->website}}" target="_blank" style="color: orange"> <i class="fa fa-globe"></i> {{App\Global_var::getLangString('Website', $language_strings)}}</a>
                    @endif
                        </div>
                    </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<div class="col-md-12" style="height: 50px;">
 <div class="messageArea" style="position: fixed; top: 80px; width: 90%; z-index: 99; display: none;" >
    <div class="col-md-12" style="height:50px">
    <div id="validation-error-message-displayer" style="display: none; height: 50px;">
        <div class="alert alert-warning alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h3 class='text-warnning'>Operation Failed </h3>
                   <strong id="validation-error-message"></strong>
          </div>
          </div>
       <div id="message-success-displayer" style="display: none">
        <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                   <strong id="message-success"></strong>
          </div>
          </div>
          <div id="message-error-displayer" style="display: none">
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                   <strong id="message-error"></strong>
                  </div>
            </div>
       </div>
  </div>

<div class="sessionMessageArea col-md-12" style="position: relative; width: 100%; top:20px; height:50px; z-index: 99; display: block;">
 @if (Session::has('danger'))
<div class="alert alert-danger">{{ Session::get('danger') }}</div>
@elseif (Session::has('success'))
<div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
<div class="col-md-8 col-md-offset-2">
@if ($errors->any())
        {!! implode('', $errors->all('<div style="color: red;">:message</div>')) !!}
@endif
 </div>
 </div>
</div>

<!-- /logo -->
<div id="container" class="searchResultDiv">
     @yield('bodyContent') 
</div>

<!-- footer -->
<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="container padding-def">
                <div class="col-lg-1  col-sm-2 col-xs-12 footer-logo">
                    <a class="navbar-brand" href="{{route(!$currentUser->isPublic()? 'home':'welcome')}}"><img src="{{asset('images/'.$logo->logoImage)}}" alt="Project name" class="logo" style="background-color: green; border-radius: 50%; height: 60px; width: 60px; " /></a>
                </div>
                <div class="col-lg-7  col-sm-7 col-xs-12">
                    <div class="delimiter"></div>
                    <div class="f-copy">
                        <ul class="list-inline">
                           <!--  <li><a href="#">Terms</a></li>
                            <li><a href="#">Privacy</a></li> -->
                            <li>Copyrights &copy; {{date('Y')}} <a href="{{$logo->website}}" target="_blank">{{$logo!=null? $logo->logoText :' EDMS'}}</a> {{App\Global_var::getLangString('All_Rights_Reserved', $language_strings)}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /footer -->




<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script  src="{{asset('circle_video_sharing/js/vendor/player/johndyer-mediaelement-89793bc/build/mediaelement-and-player.min.js')}}"></script>
<script src="{{asset('circle_video_sharing/js/custom.js')}}"></script>

<script src="{{asset('js/tinymce/js/select2.full.min.js')}}"></script>
 <script src="{{asset('js/tinymce/tinymce/tinymce.min.js')}}"></script>

<!-- <script src="{{asset('dist/demo.js')}}" crossorigin="anonymous"></script> -->
 @include("_Script._myScript")

 <script type="text/javascript">
      $(".select2").select2();/*------uses for combined dropdown with input*/
 </script>

<script type="text/javascript">
    function iframeLoaded(){
        var head = $("iframe").contents().find("head");
        var css = '<style type="text/css">' +
                  '.ndfHFb-c4YZDc-Wrql6b{display:none}; ' +
                  '</style>';
        $(head).append(css);

       // $('.ndfHFb-c4YZDc-Wrql6b').remove();
    }
</script>

</body>
</html>
