
<div class="row">
<div class="col-md-10 col-md-offset-1">
<a href="{{route('categories.index')}}" class="get btn btn-success btn-xs navbar-right"><i class="fa fa-eye"></i> <strong>ሓድሽ ከተማ መዝግብ</strong></a>
			<h3>ከተማ: {{$category->name}} </h3> <br>
</div>
</div>

<div class="row panel-info">

	<div class="col-md-10 col-md-offset-1">
	<br><br>
	<table class="table">
		<tbody>
			<tr>
				<td class="col-md-4"><h4><strong>ሽም ከተማ</strong></h4></td><td><h4>{{$category->name}}</h4></td>
			</tr>
			<tr>
				<td class="col-md-4"><h4><strong>መብርሂ</strong></h4></td><td><h4>{{$category->remark}}</h4></td>
			</tr>
			<tr>
				<td class="col-md-4"><h4><strong>ሽም ዝፈጠሮ ተጠቃሚ</strong></h4></td><td><h4>{{$category->createdByUser->name}}</h4></td>
			</tr>
		</tbody>
	</table>
	</div>
</div>
<div class="col-md-10 col-md-offset-2">		 
<hr>
<div class="col-md-offset-6">
			ዝተፈጠረሉ ዕለት: <label class="label label-default">{{date('M j Y H:i', strtotime($category->created_at))}}</label> 
			<a href="{{route('categories.edit', $category->id)}}" value="{{$category->id}}" class="get btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
			<a href="{{route('categories.delete', $category->id)}}" value="{{$category->id}}" class="get btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
		</div>
<br><br>
	</div>
