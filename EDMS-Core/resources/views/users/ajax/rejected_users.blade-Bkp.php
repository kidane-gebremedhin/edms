<div id="ajaxContent">
  <div class="col-md-12 ">    
    <div class="col-md-12 panel panel-info"> 
        <h4><label class="badge bg-green">{{$users!=null? $users->count(): 0}}</label> / <label class="badge">{{$users->total()}}</label> 
          {{App\Global_var::getLangString('Rejected_Users', $language_strings)}}
        </h4> 
        <div class="panel-body">
          @if($users!=null)
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>{{App\Global_var::getLangString('Email', $language_strings)}}</th>
                <th>{{App\Global_var::getLangString('Role', $language_strings)}}</th>
                <!-- <th>{{App\Global_var::getLangString('Department', $language_strings)}}</th> -->
                <th>{{App\Global_var::getLangString('Phone_Number', $language_strings)}}</th>
                <th>{{App\Global_var::getLangString('Registration_Date', $language_strings)}}</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $counter=0; ?>

              @foreach($users as $user)
              <?php $counter+=1; ?>

              <tr>
                <td>{{$counter}}</td>
                <td>{{$user->email}}</td>
                <td>{{App\Global_var::getLangString($user->role!=null? $user->role->roleName: '', $language_strings)}}</td>
                <!-- <td>{{$user->department!=null? $user->department->name: ''}}</td> -->
                <td>{{$user->phoneNumber}}</td>
                <td>{{date('M j Y h:i', strtotime($user->created_at))}}</td>
                <td>

              @if($currentUser->isGranted('users.show'))
              <a class="get btn btn-default btn-md" href="{{route('users.show', $user->id)}}">
                <i class="fa fa-eye"></i> 
              </a> 
               @endif
                @if($currentUser->isGranted('users.approveNewUser'))
                  <a class="get btn btn-md btn-success" href="{{route('users.approveNewUser', [$user->id, 1])}}" nextUrl="{{route('users.rejectedUsers')}}"><i class="fa fa-check"></i></a>
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
          {{$users->links()}}
        </center>
      </div>
    </div>
  </div>