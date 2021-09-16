<div id="ajaxContent">

<div class="row col-md-12">
<a class="get btn btn-success btn-xs navbar-right" href="{{route('categories.create')}}"><i class="fa fa-plus"></i> ሓድሽ ከተማ መዝግብ</a>

</div>
<div class="row">

	<div class="panel panel-info col-md-12 col-md-offset-0">
{{$categories->links()}}
	<h2><label class="badge bg-green">{{$categories!=null? $categories->count(): 0}}</label> ካብ <label class="badge">{{$categories->total()}}</label> ከተማታት</h2>
@if($categories!=null)
		<table class="table table-striped">
			<thead>
        		<th>ሽም ከተማ</th>
            <th>መብርሂ</th>
				<th></th>
				
			</thead>
			<tbody>
				@foreach($categories as $category)
          <tr>
          <td>{{$category->name}}</td>
          <td>{{strlen($category->remark)>50? substr($category->remark, 0, 50).'...': $category->remark}}
          </td>
		<td>			
<ul class="nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                   Actions
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-categorymenu pull-right">
                    <li>
                    <a class="get btn btn-lg" href="{{route('categories.show', $category->id)}}" value="{{$category->id}}">
                       <i class="fa fa-eye"></i> View 
                       </a>
                    </li>
                    <li>
                      <a class="get btn btn-lg" href="{{route('categories.edit', $category->id)}}" value="{{$category->id}}">
                       <i class="fa fa-edit"></i> Edit 
                       </a>
                    </li>
                    <li><a class="get btn btn-lg" href="{{route('categories.delete', $category->id)}}" value="{{$category->id}}"><i class="fa fa-trash"></i> Delete 
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
  <div class="panel"><h2>ዝተመዝገቡ ከተማታት የለውን</h2></div>
@endif
	</div>
</div>

</div>
