<style type="text/css">
    .dashboard-menus{
        border-bottom: 10px solid  #94b8b8;
        border-right: 10px solid  #94b8b8;
        border-radius: 10px 20px; 
    }
    .dashboard-menus:hover{
        border-left: 10px solid  #94b8b8;
        border-right: none;

    }
</style>
<div class="col-md-12">
<div class="panel-success">
     <!-- <div class="panel-heading">
        <h3 class="panel-title">{{App\Global_var::getLangString('Dashboard', $language_strings)}} - <small style="font-size: 13px">{{App\Global_var::getLangString('Control_Panel', $language_strings)}}</small></h3>
    </div> -->
<div class="panel-body">

<div class="col-md-12">
@if($currentUser->isGranted('documents.index'))
    <a class="get" href="{{route('documents.index', 'Video')}}">
    <div class="col-md-2">
        <div class="dashboard-menus panel panel-info">
            <div class="panel-body alert-success_">
                <div class="col-xs-12">
                    <img src="{{asset('images/icons/videos-2.jfif')}}" style="width: 100%;height: 60px;">
                </div>
                
            <div class="col-xs-12" >
                <h6>{{App\Global_var::getLangString('Videos', $language_strings)}} <label style="position: absolute; right: 0px" class="video_documents badge bg-orange"></label></h6>
            </div>
            </div>
        </div>
    </div>
    </a>
@endif
@if($currentUser->isGranted('documents.index'))
    <a class="get" href="{{route('documents.index', 'Audio')}}">
    <div class="col-md-2">
        <div class="dashboard-menus panel panel-info">
            <div class="panel-body alert-danger_">
                <div class="col-xs-12">
                    <img src="{{asset('images/icons/audios-4.png')}}" style="width: 100%;height: 60px;">
                </div>
                
            <div class="col-xs-12" >
                <h6>{{App\Global_var::getLangString('Audios', $language_strings)}} <label style="position: absolute; right: 0px" class="audio_documents badge bg-orange"></label></h6>
            </div>
            </div>
        </div>
    </div>
    </a>
@endif
@if($currentUser->isGranted('documents.index'))
    <a class="get" href="{{route('documents.index', 'Image')}}">
    <div class="col-md-2">
        <div class="dashboard-menus panel panel-info">
            <div class="panel-body alert-info_">
                <div class="col-xs-12">
                    <img src="{{asset('images/icons/images-3.jfif')}}" style="width: 100%;height: 60px;">
                </div>
                
            <div class="col-xs-12" >
                <h6>{{App\Global_var::getLangString('Images', $language_strings)}} <label style="position: absolute; right: 0px" class="image_documents badge bg-orange"></label></h6>
            </div>
            </div>
        </div>
    </div>
    </a>
@endif
@if($currentUser->isGranted('documents.index'))
    <a class="get" href="{{route('documents.index', 'News_Paper')}}">
    <div class="col-md-2">
        <div class="panel panel-info">
            <div class="dashboard-menus panel-body alert-warning_">
                <div class="col-xs-12">
                    <img src="{{asset('images/icons/News_Paper.png')}}" style="width: 100%;height: 60px;">
                </div>
                
            <div class="col-xs-12" >
                <h6>{{App\Global_var::getLangString('News_Paper', $language_strings)}} <label style="position: absolute; right: 0px" class="news_paper_documents badge bg-orange"></label></h6>
            </div>
            </div>
        </div>
    </div>
    </a>
@endif
@if($currentUser->isGranted('documents.index'))
    <a class="get" href="{{route('documents.index', 'Magazine')}}">
    <div class="col-md-2">
        <div class="panel panel-info">
            <div class="dashboard-menus panel-body alert-warning_">
                <div class="col-xs-12">
                    <img src="{{asset('images/icons/Magazine.png')}}" style="width: 100%;height: 60px;">
                </div>
                
            <div class="col-xs-12" >
                <h6>{{App\Global_var::getLangString('Magazine', $language_strings)}} <label style="position: absolute; right: 0px" class="magazine_documents badge bg-orange"></label></h6>
            </div>
            </div>
        </div>
    </div>
    </a>
@endif
@if($currentUser->isGranted('documents.index'))
    <a class="get" href="{{route('documents.index', 'Book')}}">
    <div class="col-md-2">
        <div class="panel panel-info">
            <div class="dashboard-menus panel-body alert-warning_">
                <div class="col-xs-12">
                    <img src="{{asset('images/icons/Book.png')}}" style="width: 100%;height: 60px;">
                </div>
                
            <div class="col-xs-12" >
                <h6>{{App\Global_var::getLangString('Book', $language_strings)}} <label style="position: absolute; right: 0px" class="book_documents badge bg-orange"></label></h6>
            </div>
            </div>
        </div>
    </div>
    </a>
@endif
@if($currentUser->isGranted('documents.index'))
    <a class="get" href="{{route('documents.index', 'Text_Document')}}">
    <div class="col-md-2">
        <div class="panel panel-info">
            <div class="dashboard-menus panel-body alert-warning_">
                <div class="col-xs-12">
                    <img src="{{asset('images/icons/Text_Document.png')}}" style="width: 100%;height: 60px;">
                </div>
                
            <div class="col-xs-12" >
                <h6>{{App\Global_var::getLangString('Text_Document', $language_strings)}} <label style="position: absolute; right: 0px" class="text_document_documents badge bg-orange"></label></h6>
            </div>
            </div>
        </div>
    </div>
    </a>
@endif

@if($currentUser->isGranted('documents.index'))
    <a class="get" href="{{route('documents.index')}}">
    <div class="col-md-2">
        <div class="panel panel-info">
            <div class="dashboard-menus panel-body alert-success_">
                <div class="col-xs-12">
                    <img src="{{asset('images/icons/documents-2.png')}}" style="width: 100%;height: 60px;">
                </div>
                
            <div class="col-xs-12" >
                <h6>{{App\Global_var::getLangString('All_Documents', $language_strings)}} <label style="position: absolute; right: 0px" class="total_documents badge bg-orange"></label></h6>
            </div>
            </div>
        </div>
    </div>
    </a>
@endif
@if($currentUser->isGranted('users.index'))
    <a class="get" href="{{route('users.index')}}">
    <div class="col-md-2">
        <div class="panel panel-info">
            <div class="dashboard-menus panel-body alert-danger_">
                <div class="col-xs-12">
                    <img src="{{asset('images/icons/users-3.jfif')}}" style="width: 100%;height: 60px;">
                </div>
                
            <div class="col-xs-12" >
                <h6>{{App\Global_var::getLangString('Users', $language_strings)}} <label style="position: absolute; right: 0px" class="total_users badge bg-orange"></label></h6>
            </div>
            </div>
        </div>
    </div>
    </a>
@endif
@if($currentUser->isGranted('logs.logsAll'))
    <a class="get" href="{{route('logs.logsAll')}}">
    <div class="col-md-2">
        <div class="panel panel-info">
            <div class="dashboard-menus panel-body alert-info_">
                <div class="col-xs-12">
                    <img src="{{asset('images/icons/logs-2.png')}}" style="width: 100%;height: 60px;">
                </div>
                
            <div class="col-xs-12" >
                <h6>{{App\Global_var::getLangString('Logs', $language_strings)}} <label style="position: absolute; right: 0px" class="badge bg-orange">*</label></h6>
            </div>
            </div>
        </div>
    </div>
    </a>
@endif
@if($currentUser->isGranted('users.approveNewUser') || $currentUser->isGranted('documents.approveNewDocument'))
    <a class="get" href="{{route('approvals_intro')}}">
    <div class="col-md-2">
        <div class="panel panel-info">
            <div class="dashboard-menus panel-body alert-warning_">
                <div class="col-xs-12">
                    <img src="{{asset('images/icons/approvals-3.png')}}" style="width: 100%;height: 60px;">
                </div>
                
            <div class="col-xs-12" >
            <h6>{{App\Global_var::getLangString('Approvals', $language_strings)}} <label style="position: absolute; right: 0px" class="unapproved_users_and_documents badge bg-orange"></label></h6>
            </div>
            </div>
        </div>
    </div>
    </a>
@endif
</div>

</div>

</div>
</div>
