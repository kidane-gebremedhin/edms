
<div class="row">
<div class="col-md-8 col-md-offset-2">
			<h3>ከተማ {{$category->name}} <small> ንክስረዝ ኣብ ከይዲ ይርከብ</small></h3> <br>
</div>
</div>
<div class="row">
	<div class="col-md-12 col-md-offset-2">
		<h1 class="text-danger">{{$category->name}} ንክስረዝ ርግፀኛ ድዮም?</h1>
<a href="{{route('categories.destroy', $category->id)}}" value="{{$category->id}}" class="get btn btn-danger btn-lg"><i class="fa fa-trash"></i> እወ! ሰርዝ</a>

<a href="{{route('categories.index')}}" class="get btn btn-default btn-lg"> ኣይ! ተመለስ</a>
</div>
</div>

<div class="row panel-info">

	<div class="col-md-8 col-md-offset-2">
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
		</div>
<br><br>
	</div>
