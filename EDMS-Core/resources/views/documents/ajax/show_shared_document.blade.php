<?php
        $document=$shared_document_edition->document;
        $sharedByUser=$shared_document_edition->sharedByUser;
        $sharedToUser=$shared_document_edition->sharedToUser;
        $document_edition=$document->editions->first();

?>

<div class="col-md-12">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-success">
			<div class="panel-heading" >
				<h4> 
					{{App\Global_var::getLangString('Detail', $language_strings)}} 
				</h4>		
			</div>
			<div class="panel-body">
			
			<table class="table">
				<tbody>
					<tr>
						<td><strong>{{App\Global_var::getLangString('Title', $language_strings)}}</strong></td><td><h4>{{$document->title}}</h4></td>
					</tr>
					<tr>
						<td><strong>{{App\Global_var::getLangString('Document_Type', $language_strings)}}</strong></td><td><h4>{{$document->category}}</h4></td>
					</tr>
					<tr>
						<td><strong>{{App\Global_var::getLangString('Year_of_Publishment', $language_strings)}}</strong></td><td><h4>{{$document_edition->yearOfPublishment}}</h4></td>
					</tr>
					<tr>
						<td><strong>{{App\Global_var::getLangString('Shared_By', $language_strings)}}</strong></td><td><h4>{{$sharedByUser->email}}</h4></td>
					</tr>
					@if($currentUser->isAdmin() && $shared_document_edition->sharedToUserId!=$currentUser->id)
					<tr>
						<td><strong>{{App\Global_var::getLangString('Shared_To', $language_strings)}}</strong></td><td><h4>{{$sharedToUser->email}}</h4></td>
					</tr>
					@endif
					<tr>
						<td><strong>{{App\Global_var::getLangString('Date', $language_strings)}}</strong></td><td><h4>{{$shared_document_edition->sharedDateTime}}</h4></td>
					</tr>
					<tr>
						<td colspan="2">
						<center>
							@if($currentUser->isGranted_ID('documents.show', $document->id))
				              <a class="get_ btn btn-success btn-lg" href="{{route('documents.play', $document_edition->id)}}"><i class="fa fa-play"></i></a>
				            @endif
				       </center>
						</td>
					</tr>
				</tbody>
			</table>
                      
	</div>
	</div>
	</div>

</div>
			