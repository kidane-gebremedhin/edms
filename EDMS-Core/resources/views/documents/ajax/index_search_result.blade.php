
  <div class="panel col-md-12">
  <div class="col-md-12 ">    
    <div class="col-md-12 panel"> 
        <h4><label class="badge bg-green">{{$documents!=null? $documents->count(): 0}}</label> / <label class="badge">{{$documents->total()}}</label> 
          {{App\Global_var::getLangString('Documents', $language_strings)}}
          @if($currentUser->isGranted('documents.create'))
          <a class="get btn btn-success btn-sm navbar-right" href="{{route('documents.create')}}" nextUrl="{{route('documents.create')}}"><i class="fa fa-plus"></i> 
            @endif
            {{App\Global_var::getLangString('Add', $language_strings)}}
          </a></h4> 
        <div class="panel-body">
  @if(count($documents)>0)
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>{{App\Global_var::getLangString('Title', $language_strings)}}</th>
                <th>{{App\Global_var::getLangString('Category', $language_strings)}}</th>
                <th>{{App\Global_var::getLangString('Sub_category', $language_strings)}}</th>
                <th>{{App\Global_var::getLangString('Author', $language_strings)}}</th>
                <th>{{App\Global_var::getLangString('Uploaded_at', $language_strings)}}</th>
                <th>{{App\Global_var::getLangString('Views', $language_strings)}}</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $counter=0; ?>

              @foreach($documents as $document)
              <?php $counter+=1; ?>

              <tr>
                <td>{{$counter}}</td>
                <td>{{$document->title/*strlen($document->title)<=30? $document->title: substr($document->title, 0, 30).' ...'*/}}</td>
                <td>{{App\Global_var::getLangString($document->category, $language_strings)}}</td>
                <td>{{App\Global_var::getLangString($document->subCategory, $language_strings)}}</td>
                <td>{{$document->author!=null? $document->author->firstName.' '.$document->author->lastName.' '.$document->author->middleName: ''}}</td>
                <td>{{$document->uploadedDateTime}}</td>
                <td>
                <label class="badge bg-orange">{{$document->views()}}</label>
                </td>
                <td>
              @if(count($document->editions)>0)
              <?php 
                $document_edition=$document->editions->first();
               ?>
               
              @if($currentUser->isGranted_ID('documents.show', $document->id))
              <a class="get_ btn btn-success btn-sm" href="{{route('documents.play', $document_edition->id)}}"><i class="fa fa-play"></i></a>
              @endif
              @if($currentUser->isGranted_ID('documents.download', $document->id))
              <a class="btn btn-success btn-sm" href="{{ route('documents.download', $document_edition->id) }}"><i class="fa fa-download"></i>
                 </a>
              @endif
              @if($currentUser->isGranted_ID('documents.share', $document->id))
              <a class="get btn btn-success btn-sm" href="{{ route('documents.share', $document->id) }}"><i class="fa fa-share"></i>
                 </a>
              @endif
              @endif
               
                  <ul class="nav navbar-right">
                    <li class="">
                      <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style=" color: orange">
                        {{App\Global_var::getLangString('Actions', $language_strings)}}
                        <span class=" fa fa-angle-down"></span>
                      </a>
                      <ul class="dropdown-menu dropdown-usermenu pull-right">
                        @if($currentUser->isAdmin() || $currentUser->isLibrary_Head())
                        <li>
                          <a class="get btn btn-lg" href="{{route('permissions.document_role_permissions', $document->id)}}" value="{{$document->id}}">
                            <i class="fa fa-gear"></i> {{App\Global_var::getLangString('Permissions', $language_strings)}} 
                          </a>
                        </li>
                        @endif
                         
                        @if($currentUser->isGranted_ID('documents.show', $document->id))
                        <li>
                          <a class="get btn btn-lg" href="{{route('documents.show', $document->id)}}" value="{{$document->id}}">
                            <i class="fa fa-eye"></i> {{App\Global_var::getLangString('View', $language_strings)}} 
                          </a>
                        </li>
                        @endif
                        @if($currentUser->isGranted_ID('documents.edit', $document->id))
                        <li>
                          <a class="get btn btn-lg" href="{{route('documents.edit', $document->id)}}" value="{{$document->id}}">
                            <i class="fa fa-edit"></i> {{App\Global_var::getLangString('Edit', $language_strings)}} 
                          </a>
                        </li>
                        @endif
                        @if($currentUser->isGranted_ID('documents.delete', $document->id))
                        <li><a class="get btn btn-lg" href="{{route('documents.delete', $document->id)}}" value="{{$document->id}}"><i class="fa fa-trash"></i> {{App\Global_var::getLangString('Delete', $language_strings)}} 
                        </a></li>
                        @endif
                        

                      </ul>
                    </li>
                  </ul>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        <div class="col-md-12">
        <center>
          {{$documents->links()}}
        </center>
        </div>
  @else
  <div class="col-md-12" style="padding: 50px">
        <h3><center>{{App\Global_var::getLangString('List_Not_Found', $language_strings)}}</center></h3>
  </div>
  @endif
        </div> 
      </div>
      
    </div>

  </div>
