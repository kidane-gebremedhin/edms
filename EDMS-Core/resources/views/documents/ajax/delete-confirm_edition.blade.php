<div class="col-md-12">
	<div class="col-md-12">
		<h4 class="text-danger">
			{{App\Global_var::getLangString('Confirm_Delete', $language_strings)}}
			<a href="{{route('documents.show', $document_edition->document->id)}}" class="get btn btn-default btn-sm" nextUrl="{{route('documents.show', $document_edition->document->id)}}"> 
				{{App\Global_var::getLangString('No', $language_strings)}}
			</a>
			<a href="{{route('documents.destroy_edition', $document_edition->id)}}" value="{{$document_edition->document->id}}" class="get btn btn-danger btn-sm" nextUrl="{{route('documents.show', $document_edition->document->id)}}"><i class="fa fa-trash"></i> 
				{{App\Global_var::getLangString('Yes', $language_strings)}}
			</a>
		</h4>	
	</div>
		<div class="col-md-12">
			<div class="panel panel-success">
<div class="panel-body">
<div class="col-md-12"> 
    <div class="panel panel-warning">
        <div class="panel-heading"> 
            {{App\Global_var::getLangString('Document_Information', $language_strings)}}
        </div>  
        <div class="panel-body">
 <table class="table">
<tbody>
<tr>
<td colspan="6">
<div class="col-md-12"> 
<div class="panel panel-success">
    <div class="panel-heading"> 
        {{App\Global_var::getLangString('Editions_Information', $language_strings)}}
    </div>  
    <div class="panel-body">
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
							<a class="btn btn-success" href="{{ route('documents.download', $document_edition->id) }}"><i class="fa fa-download"></i>
							  {{App\Global_var::getLangString('Download', $language_strings)}} </a>
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
<hr>
	<div class="col-md-12">
	{{App\Global_var::getLangString('Created_By', $language_strings)}}:
	<label class="label label-default">{{$document_edition->createdByUser!=null? $document_edition->createdByUser->username():''}}</label>

	{{App\Global_var::getLangString('Updated_By', $language_strings)}}:
	<label class="label label-default">{{$document_edition->updatedByUser!=null? $document_edition->updatedByUser->username():''}}	</label>
	<br>

	{{App\Global_var::getLangString('Created_At', $language_strings)}}:
	<label class="label label-default">{{date('M j Y h:i', strtotime($document_edition->created_at))}}</label>
	{{App\Global_var::getLangString('Updated_At', $language_strings)}}:
	<label class="label label-default">{{date('M j Y h:i', strtotime($document_edition->updated_at))}}</label> 		 

</div>
</div>

</div>
</div>
</div>
</div>
