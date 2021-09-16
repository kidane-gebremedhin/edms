<div id="ajaxContent">
  <div class="col-md-12">
    <div class="col-md-8 panel panel-success">
      <h4><label class="badge bg-green">{{$departments!=null? $departments->count(): 0}}</label> / <label class="badge">{{$departments->total()}}</label> 
        {{App\Global_var::getLangString('Departments', $language_strings)}}
        <a class="get btn btn-success btn-sm navbar-right" href="{{route('departments.create')}}" nextUrl="{{route('departments.create')}}"><i class="fa fa-plus"></i> 
          {{App\Global_var::getLangString('Add', $language_strings)}}
        </a>
      </h4>
      @if(count($departments)>0)
      <table class="table table-striped table-hover">
        <thead>
          <th>#</th>
          <th>
            {{App\Global_var::getLangString('Name', $language_strings)}}
          </th>
          <th>
            {{App\Global_var::getLangString('Remark', $language_strings)}}
          </th>
          <th></th>
        </thead>
        <tbody>
          <?php $count=1; ?>
          @foreach($departments as $department)
          <tr>
            <td>{{$count++}}</td>
            <td>{{$department->name}}</td>
            <td>{{strlen($department->remark)>50? substr($department->remark, 0, 50).'...': $department->remark}}
            </td>
            <td>			
              <ul class="nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="height: 20px; background: #fff">
                    {{App\Global_var::getLangString('Actions', $language_strings)}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-departmentmenu pull-right">
                    <li>
                      <a class="get btn btn-lg" href="{{route('departments.show', $department->id)}}" value="{{$department->id}}" nextUrl="{{route('departments.show', $department->id)}}">
                        <i class="fa fa-eye"></i> 
                        {{App\Global_var::getLangString('View', $language_strings)}}
                      </a>
                    </li>
                    <li>
                      <a class="get btn btn-lg" href="{{route('departments.edit', $department->id)}}" value="{{$department->id}}" nextUrl="{{route('departments.edit', $department->id)}}">
                        <i class="fa fa-edit"></i> 
                        {{App\Global_var::getLangString('Edit', $language_strings)}}
                      </a>
                    </li>
                    <li><a class="get btn btn-lg" href="{{route('departments.delete', $department->id)}}" value="{{$department->id}}" nextUrl="{{route('departments.delete', $department->id)}}"><i class="fa fa-trash"></i> 
                      {{App\Global_var::getLangString('Delete', $language_strings)}}
                    </a></li>
                  </ul>
                </li>
              </ul>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <div class="col-md-12"><hr><h4 class="col-md-offset-2">
        {{App\Global_var::getLangString('List_Not_Found', $language_strings)}}
      </h4></div>
      @endif
    </div>
  </div>
  <div class="col-md-8">
    <center>
      {{$departments->links()}}
    </center>
  </div>
</div>
