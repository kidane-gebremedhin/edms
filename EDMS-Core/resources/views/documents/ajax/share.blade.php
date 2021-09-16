<div class="col-md-12">
	<div class=" col-md-10 col-md-offset-1">
		<div class="panel panel-success">
			<div class="panel-heading">	
				<h4> 
				<i class="fa fa-share"></i> 
					{{App\Global_var::getLangString('Share', $language_strings)}} 
				</h4>		
			</div>
			<div class="panel-body">
				<h4>{{$document->title}}</h4>
				<hr>
				{!!Form::open(array("route"=>['documents.share', $document->id], "method"=>"POST", "class"=>"post"))!!}
                        <label class="nextUrl col-md-12" nextUrl="{{route('documents.show', $document->id)}}" />
                        <div class="col-md-2">                              
                                <label class="control-label"> {{App\Global_var::getLangString('Receipents', $language_strings)}}</label>
                            </div>
                        <div class="col-md-6">
                          {{ Form::select('userIds[]', $users, null, array('class'=>'select2 form-control', 'multiple'=>'multiple', 'required'=>'true'))}}
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success btn-block col-md-6 col-md-offset-3">
                            <i class="fa fa-send"></i> 
                                {{App\Global_var::getLangString('Share', $language_strings)}}
                            </button>
                        </div>
                        {{Form::close()}}

                    <div class="col-md-12">
                    <hr>
           			{{App\Global_var::getLangString('You_can_share_to_multiple_users_at_once', $language_strings)}}
           			<hr>
                    </div>
			</div>
		</div>
</div>
</div>