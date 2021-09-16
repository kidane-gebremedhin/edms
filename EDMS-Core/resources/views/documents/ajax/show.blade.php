<div class="col-md-12">
	<div class="col-md-12">
		<div class="panel panel-success">
			<div class="panel-heading" >
				<h4> 
					{{App\Global_var::getLangString('Detail', $language_strings)}}

					@if($currentUser->isGranted('documents.index'))
					<a href="{{route('documents.index')}}" class="get btn btn-success btn-sm pull-right"><i class="fa fa-eye"></i> <strong>
						{{App\Global_var::getLangString('List', $language_strings)}}
					</strong></a>
					@endif		 
				</h4>		
			</div>
			<div class="panel-body">

            
<div class="col-md-12"> 
    <div class="panel panel-warning">
        <div class="panel-heading"> 
            {{App\Global_var::getLangString('Document_Information', $language_strings)}}
        </div>  
        <div class="panel-body">
 <table class="table">
 <thead>
 	<th>{{App\Global_var::getLangString('Title', $language_strings)}}</th>
 	<th>{{App\Global_var::getLangString('Category', $language_strings)}}</th>
 	<th>{{App\Global_var::getLangString('Sub_category', $language_strings)}}</th>
	<th>{{App\Global_var::getLangString('Uploaded_Date', $language_strings)}}</th>
	@if($document->location!=null)
	 <th>{{App\Global_var::getLangString('Location', $language_strings)}}</th>
	@endif
	<!-- <th>{{App\Global_var::getLangString('Updated_By', $language_strings)}}</th>
 --> </thead>
<tbody>
<tr>
	<td><h4>{{$document->title}}</h4></td>
 	<td><h4>{{App\Global_var::getLangString($document->category, $language_strings)}}</h4></td>
	<td><h4>{{App\Global_var::getLangString($document->subCategory, $language_strings)}}</h4></td>
	<td><h4>{{$document->uploadedDateTime}}</h4></td>
	@if($document->location!=null)
	 <td><h4>{{$document->location}}</h4></td>
	@endif
	<!--<td>{{$document->updatedByUser!=null? $document->updatedByUser->username():''}}</td> -->
</tr>
@if($document->summery!=null)
<tr>
<th>{{App\Global_var::getLangString('Summery', $language_strings)}}</th>
	<td colspan="6">{{$document->summery}}</td>
</tr>
@endif
<tr>
<td colspan="4">
		<div class="col-md-12"> 
	    <div class="panel panel-warning">
	        <div class="panel-heading"> 
	            {{App\Global_var::getLangString('Author_Information', $language_strings)}}
	        </div>  
	        <div class="panel-body">
       @if($document->author!=null)
                 <table class="table">
                 <thead>
                 	<td>{{App\Global_var::getLangString('First_Name', $language_strings)}}</td>
                 	<td>{{App\Global_var::getLangString('Last_Name', $language_strings)}}</td>
                 	<td>{{App\Global_var::getLangString('Middle_Name', $language_strings)}}</td>
                 	<td>{{App\Global_var::getLangString('Phone_Number', $language_strings)}}</td>
                 	<td>{{App\Global_var::getLangString('Email', $language_strings)}}</td>
                 	<td>{{App\Global_var::getLangString('Created_By', $language_strings)}}</td>
                 	<td>{{App\Global_var::getLangString('Updated_By', $language_strings)}}</td>

                 </thead>
					<tbody>
						<tr>
							<td><h4>{{$document->author->firstName}}</h4></td>
							<td><h4>{{$document->author->lastName}}</h4></td>
							<td><h4>{{$document->author->middleName}}</h4></td>
							<td>
								{{$document->author->phoneNumber}} 
							</td>
							<td>{{$document->author->email}}</td>
						    <td>{{$document->author->createdByUser!=null? $document->author->createdByUser->username():''}}</td>
							<td>{{$document->author->updatedByUser!=null? $document->author->updatedByUser->username():''}}</td>
						</tr>
					</tbody>
				</table>
			@endif
        </div>
        </div>
    </div>
</td>
</tr>
<tr>
<td colspan="6">
<div class="col-md-12"> 
<div class="panel panel-success">
    <div class="panel-heading"> 
        {{App\Global_var::getLangString('Editions_Information', $language_strings)}}

        @if($currentUser->isGranted_ID('documents.create_edition', $document->id))
        <a class="get btn btn-success btn-xs pull-right" href="{{route('documents.create_edition', $document->id)}}"><i class="fa fa-plus"></i> {{App\Global_var::getLangString('Upload_New_Edition', $language_strings)}}</a>
        @endif
    </div>  
    <div class="panel-body">
	@if($document->editions!=null)
       @foreach($document->editions as $document_edition)
		<div class="col-md-12"> 
            <div class="panel panel-warning">
                <div class="panel-heading"> 
                    <u>{{App\Global_var::getLangString('Edition', $language_strings)}} - {{$document_edition->edition}}</u>
                </div>  
                <div class="panel-body">
                     <table class="table">
                     <thead>
                     	<th>{{App\Global_var::getLangString('Edition', $language_strings)}}</th>
                     	<th>{{App\Global_var::getLangString('Description', $language_strings)}}</th>
                     	<th>{{App\Global_var::getLangString('Path', $language_strings)}}</th>
                     	<th>{{App\Global_var::getLangString('Size', $language_strings)}}</th>
                     	<th>{{App\Global_var::getLangString('Year_of_Publishment', $language_strings)}}</th>
                     	<th>{{App\Global_var::getLangString('Uploaded_at', $language_strings)}}</th>
                     	<th>{{App\Global_var::getLangString('Created_By', $language_strings)}}</th>
                     	<th>{{App\Global_var::getLangString('Updated_By', $language_strings)}}</th>
                     </thead>
					<tbody>
					<tr>
						<td>
							{{$document_edition->edition}} 
						</td>
						<td>
							{{$document_edition->description}} 
						</td>
						<td>
							@if($currentUser->isGranted_ID('documents.play', $document_edition->id))
							<u><a href="{{route('documents.play', $document_edition->id)}}">{{$document_edition->getFileName()}}</a></u> 
							<br>
							@endif
							@if($currentUser->isGranted_ID('documents.download', $document_edition->id))
							<a class="btn btn-success btn-xs " href="{{ route('documents.download', $document_edition->id) }}"><i class="fa fa-download"></i>
							  {{App\Global_var::getLangString('Download', $language_strings)}} </a>
							@endif
                        	@if($currentUser->isGranted_ID('documents.edit', $document->id))
					        <a class="get btn btn-warning btn-xs" href="{{route('documents.edit_edition', $document_edition->id)}}"><i class="fa fa-edit"></i> {{App\Global_var::getLangString('Edit_Edition', $language_strings)}}</a>
					        @endif
                        	@if($currentUser->isGranted_ID('documents.delete', $document->id))
					        <a class="get btn btn-danger btn-xs" href="{{route('documents.delete_edition', $document_edition->id)}}"><i class="fa fa-trash"></i> {{App\Global_var::getLangString('Delete_Edition', $language_strings)}}</a>
					        @endif
						</td>
						<td>
							{{$document_edition->sizeInfo()}} 
						</td>
						<td>
							{{$document_edition->yearOfPublishment}} 
						</td>
						<td>
							{{$document_edition->uploadedDateTime}} 
						</td>
						<td>{{$document_edition->createdByUser!=null? $document_edition->createdByUser->username():''}}</td>
						<td>{{$document_edition->updatedByUser!=null? $document_edition->updatedByUser->username():''}}</td>
					</tr>
					<tr>
						<td colspan="8">

      <div class="col-md-12"> 
            <div class="panel panel-warning">
                <div class="panel-heading"> 
                    {{App\Global_var::getLangString('Publisher_Information', $language_strings)}}
                </div>  
                <div class="panel-body">
		       @if($document_edition->publisher!=null)
                 <table class="table">
                 	<thead>
                 		<td>{{App\Global_var::getLangString('Name', $language_strings)}}</td>
                 		<td>{{App\Global_var::getLangString('Year_of_Establishment', $language_strings)}}</td>
                 		<td>{{App\Global_var::getLangString('Email', $language_strings)}}</td>
                 		<td>{{App\Global_var::getLangString('Phone_Number', $language_strings)}}</td>
                 		<td>{{App\Global_var::getLangString('Created_By', $language_strings)}}</td>
                 		<td>{{App\Global_var::getLangString('Updated_By', $language_strings)}}</td>
                 	</thead>
					<tbody>
						<tr>
							<td><h4>{{$document_edition->publisher->name}}</h4></td>
							<td><h4>{{$document_edition->publisher->yearOfEstablishment}}</h4></td>
							<td><h4>{{$document_edition->publisher->email}}</h4></td>
							<td>
								{{$document_edition->publisher->phoneNumber}} 
							</td>
							<td>{{$document_edition->publisher->createdByUser!=null? $document_edition->publisher->createdByUser->username():''}}</td>
							<td>{{$document_edition->publisher->updatedByUser!=null? $document_edition->publisher->updatedByUser->username():''}}</td>
						</tr>

					</tbody>
				</table>
			@endif
	            </div>
	            </div>
  		</div>
						</td>
					</tr>
					</tbody>
				</table>
 				</div>
	            </div>
            </div>

		@endforeach
	@endif
	</div>
    </div>
</div>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>


<div class="col-md-12">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-success">
   <div class="panel-heading"> 
<strong>{{App\Global_var::getLangString('Shares', $language_strings)}}:</strong> <label class="badge bg-orange"> {{count($document->shares)}}</label>
</div>
<div class="panel-body">
<table class="table">
	<thead>
		<th>{{App\Global_var::getLangString('Shared_By', $language_strings)}}</th>
		<th>{{App\Global_var::getLangString('Shared_To', $language_strings)}}</th>
		<th>{{App\Global_var::getLangString('Date', $language_strings)}}</th>
	</thead>
	<tbody>
@foreach ($document->shares  as $share) 
   <tr>
   <td>{{$share->sharedByUser!=null? $share->sharedByUser->email:''}}</td>
   	<td>{{$share->sharedToUser!=null? $share->sharedToUser->email:''}}</td>
   	<td>{{date('M j Y h:i', strtotime($share->created_at))}}</td>
   </tr>
 @endforeach
	</tbody>
</table>			
</div>
</div>
</div>
</div>

<div class="col-md-12">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-success">
   <div class="panel-heading"> 
<strong>{{App\Global_var::getLangString('Views', $language_strings)}}:</strong> <label class="badge bg-orange"> {{$document->views()}}</label>
</div>
<div class="panel-body">
<table class="table table-hover">
	<thead>
		<th>{{App\Global_var::getLangString('Role', $language_strings)}}</th>
		<th>{{App\Global_var::getLangString('Views', $language_strings)}}</th>
	</thead>
	<tbody>
@foreach ($roles as $role) 
   <tr>
   <td>{{App\Global_var::getLangString($role->roleName, $language_strings)}}</td>
   	<td>{{$document->views_per_role($role->id)}}</td>
   </tr>
 @endforeach
	</tbody>
</table>			
</div>
</div>
</div>
</div>

<div class="col-md-12">
<hr>
	<div class="col-md-12">
	{{App\Global_var::getLangString('Created_By', $language_strings)}}:
	<label class="label label-default">{{$document->createdByUser!=null? $document->createdByUser->username():''}}</label>

	{{App\Global_var::getLangString('Updated_By', $language_strings)}}:
	<label class="label label-default">{{$document->updatedByUser!=null? $document->updatedByUser->username():''}}	</label>
	<br>

	{{App\Global_var::getLangString('Created_At', $language_strings)}}:
	<label class="label label-default">{{date('M j Y h:i', strtotime($document->created_at))}}</label>
	{{App\Global_var::getLangString('Updated_At', $language_strings)}}:
	<label class="label label-default">{{date('M j Y h:i', strtotime($document->updated_at))}}</label> 		 

</div>
</div>
<div class="col-md-12">
<hr>
	<div class="col-md-4 pull-right">

	@if($currentUser->isGranted_ID('documents.edit', $document->id))
	<a href="{{route('documents.edit', $document->id)}}" value="{{$document->id}}" class="get btn btn-sm btn-primary" nextUrl="{{route('documents.edit', $document->id)}}"><i class="fa fa-edit"></i> 
		{{App\Global_var::getLangString('Edit', $language_strings)}}
	</a>
    @endif
	
	@if($currentUser->isGranted_ID('documents.delete', $document->id))
	<a href="{{route('documents.delete', $document->id)}}" value="{{$document->id}}" class="get btn btn-sm btn-danger" nextUrl="{{route('documents.delete', $document->id)}}"><i class="fa fa-trash"></i> 
		{{App\Global_var::getLangString('Delete', $language_strings)}}
	</a>
    @endif

	@if($currentUser->isGranted_ID('documents.share', $document->id))
       <a class="get btn btn-success btn-sm" href="{{ route('documents.share', $document->id) }}"><i class="fa fa-share"></i>
                 </a>
    @endif
</div>
</div>
			</div>
		</div>
	</div>

</div>