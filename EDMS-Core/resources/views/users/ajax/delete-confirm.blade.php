<div class="col-md-12">
	<div class="col-md-8">
		<h4 class="text-danger">
			{{App\Global_var::getLangString('Confirm_Delete', $language_strings)}}
			<a href="{{route('users.index')}}" class="get btn btn-default btn-sm" nextUrl="{{route('users.destroy', $user->id)}}"> 
				{{App\Global_var::getLangString('No', $language_strings)}}
			</a>
			<a href="{{route('users.destroy', $user->id)}}" value="{{$user->id}}" class="get btn btn-danger btn-sm" nextUrl="{{route('users.index')}}"><i class="fa fa-trash"></i> 
				{{App\Global_var::getLangString('Yes', $language_strings)}}
			</a>
		</h4>	
	</div>
		<div class="col-md-8">
			<div class="panel panel-success">
				<div class="panel-heading">
					{{App\Global_var::getLangString('Detail', $language_strings)}}
					<a href="{{route('users.index')}}" class="get btn btn-success btn-sm pull-right" nextUrl="{{route('users.index')}}"><i class="fa fa-eye"></i> 
						{{App\Global_var::getLangString('List', $language_strings)}}
					</a> 	
				</div>
						<div class="panel-body">
				<table class="table">
					<tbody>
						<tr>
							<td class="col-md-4"><strong>{{App\Global_var::getLangString('Status', $language_strings)}}</strong></td><td><label class="badge {{$user->status=='active'? 'bg-green': 'bg-red'}}"> {{$user->status}}</label></td>
						</tr>
						<tr>
							<td class="col-md-4">{{App\Global_var::getLangString('First_Name', $language_strings)}}</td><td><h4>{{$user->firstName}}</h4></td>
						</tr>
						<tr>
							<td class="col-md-4">{{App\Global_var::getLangString('Last_Name', $language_strings)}}</td><td><h4>{{$user->lastName}}</h4></td>
						</tr>
						<tr>
							<td class="col-md-4">{{App\Global_var::getLangString('Middle_Name', $language_strings)}}</td><td><h4>{{$user->middleName}}</h4></td>
						</tr>
						<tr>
							<td>{{App\Global_var::getLangString('Phone_Number', $language_strings)}}</td>
							<td>
								{{$user->phoneNumber}} 
							</td>
						</tr>

						<tr>
							<td class="col-md-4">{{App\Global_var::getLangString('Email', $language_strings)}}</td><td>{{$user->email}}</td>
						</tr>
						<tr>
							<td class="col-md-4">{{App\Global_var::getLangString('Username', $language_strings)}}</td><td>{{$user->userName}}</td>
						</tr>
						<tr>
							<td class="col-md-4">{{App\Global_var::getLangString('Role', $language_strings)}}</td><td><strong>{{App\Global_var::getLangString($user->role!=null? $user->role->roleName: '', $language_strings)}}</strong></td>
						</tr>
						<!-- <tr>
							<td class="col-md-4">{{App\Global_var::getLangString('Department', $language_strings)}}</td><td><strong>{{$user->department!=null? $user->department->name: ''}}</strong></td>
						</tr> -->
						<tr>
							<td class="col-md-4">{{App\Global_var::getLangString('Created_By', $language_strings)}}</td><td>{{$user->createdByUser!=null? $user->createdByUser->username():''}}</td>
						</tr>
						<tr>
							<td class="col-md-4">{{App\Global_var::getLangString('Updated_By', $language_strings)}}</td><td>{{$user->updatedByUser!=null? $user->updatedByUser->username():''}}</td>
						</tr>
					</tbody>
				</table>

<div class="col-md-12">
<hr>
	<div class="col-md-12">
	{{App\Global_var::getLangString('Created_By', $language_strings)}}:
	<label class="label label-default">{{$user->createdByUser!=null? $user->createdByUser->username():''}}</label>

	{{App\Global_var::getLangString('Updated_By', $language_strings)}}:
	<label class="label label-default">{{$user->updatedByUser!=null? $user->updatedByUser->username():''}}	</label>
	<br>

	{{App\Global_var::getLangString('Created_At', $language_strings)}}:
	<label class="label label-default">{{date('M j Y h:i', strtotime($user->created_at))}}</label>
	{{App\Global_var::getLangString('Updated_At', $language_strings)}}:
	<label class="label label-default">{{date('M j Y h:i', strtotime($user->updated_at))}}</label> 		 

</div>
</div>

			</div>
			</div>
		</div>
	</div>
