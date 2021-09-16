<div id="ajaxContent">
  <div class="col-md-12 ">    
    <div class="col-md-12 panel panel-success"> 
        <h4><label class="badge bg-green">{{$documents!=null? $documents->count(): 0}}</label> / <label class="badge">{{$documents->total()}}</label> 
          {{App\Global_var::getLangString('New_Documents', $language_strings)}}
          </h4> 
        <div class="panel-body">
          @if($documents!=null)
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>{{App\Global_var::getLangString('Title', $language_strings)}}</th>
                <th>{{App\Global_var::getLangString('Category', $language_strings)}}</th>
                <th>{{App\Global_var::getLangString('Author', $language_strings)}}</th>
                <th>{{App\Global_var::getLangString('Phone_Number', $language_strings)}}</th>
                <th>{{App\Global_var::getLangString('Uploaded at', $language_strings)}}</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $counter=0; ?>

              @foreach($documents as $document)
              <?php $counter+=1; ?>

              <tr>
                <td>{{$counter}}</td>
                <td>{{$document->title}}</td>
                <td>{{App\Global_var::getLangString($document->category, $language_strings)}}</td>
                <td>{{$document->author!=null? $document->author->firstName.' '.$document->author->lastName.' '.$document->author->middleName: ''}}</td>
                <td>{{$document->phoneNumber}}</td>
                <td>{{$document->uploadedDateTime}}</td>
                <td>
                @if($currentUser->isGranted('documents.show'))
              <a class="get btn btn-default btn-md" href="{{route('documents.show', $document->id)}}">
                <i class="fa fa-eye"></i> 
              </a> 
               @endif
                @if($currentUser->isGranted('documents.approveNewDocument'))
                  <a class="get btn btn-md btn-success" href="{{route('documents.approveNewDocument', [$document->id, 1])}}" nextUrl="{{route('documents.newDocuments')}}"><i class="fa fa-check"></i></a>
                    <a class="get btn btn-md btn-danger" href="{{route('documents.approveNewDocument', [$document->id, 0])}}" nextUrl="{{route('documents.newDocuments')}}"><i class="fa fa-close"></i></a>
               @endif
               @if($currentUser->isLibrary_Head() || $currentUser->isAdmin())
                <a class="get btn btn-lg" href="{{route('permissions.document_role_permissions', $document->id)}}" value="{{$document->id}}">
                  <i class="fa fa-gear"></i> {{App\Global_var::getLangString('Permissions', $language_strings)}} 
                </a>
                @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <div class="panel">
            <h4>{{App\Global_var::getLangString('List_Not_Found', $language_strings)}}</h4>
          </div>
          @endif
        </div> 
      </div>
      <div class="col-md-12">
        <center>
          {{$documents->links()}}
        </center>
      </div>
    </div>
  </div>