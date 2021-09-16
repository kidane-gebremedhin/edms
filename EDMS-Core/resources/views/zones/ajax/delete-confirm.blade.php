<div class="col-md-12">
	<div class="col-md-8 ">
		<h4 class="text-danger">
			{{App\Global_var::getLangString('Confirm_Delete', $language_strings)}}
			<a href="{{route('zones.index')}}" class="get btn btn-default btn-sm" nextUrl="{{route('zones.destroy', $zone->id)}}"> 
				{{App\Global_var::getLangString('No', $language_strings)}}
			</a>
			<a href="{{route('zones.destroy', $zone->id)}}" value="{{$zone->id}}" class="get btn btn-danger btn-sm" nextUrl="{{route('zones.index')}}"><i class="fa fa-trash"></i> 
				{{App\Global_var::getLangString('Yes', $language_strings)}}
			</a>
		</h4>	

	</div>
	<div class="col-md-8 ">
		<div class="panel panel-info">
			<div class="panel-heading">

				<h4>{{App\Global_var::getLangString('Detail', $language_strings)}}</h4> 		
			</div>
			<div class="panel-body">
				<table class="table">
					<tbody>
						<tr>
							<td><strong>{{App\Global_var::getLangString('Name', $language_strings)}}</strong></td><td><h4>{{$zone->name}}</h4></td>
						</tr>
						<tr>
							<td><strong>{{App\Global_var::getLangString('Region', $language_strings)}}</strong></td><td><h4>{{$zone->region!=null? $zone->region->name:''}}</h4></td>
						</tr>
						<tr>
							<td><strong>{{App\Global_var::getLangString('Remark', $language_strings)}}</strong></td><td><h4>{{$zone->remark}}</h4></td>
						</tr>
						<tr>
							<td><strong>{{App\Global_var::getLangString('Created_By', $language_strings)}}</strong></td><td><h4>{{$zone->createdByUser!=null? $zone->createdByUser->name:''}}</h4></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-10">
		<hr>
		{{App\Global_var::getLangString('Created_At', $language_strings)}}: <label class="label label-default">{{date('M j Y h:i', strtotime($zone->created_at))}}</label> {{App\Global_var::getLangString('Updated_At', $language_strings)}}: <label class="label label-default">{{date('M j Y h:i', strtotime($zone->updated_at))}}</label> 
		 
	</div>
</div>
