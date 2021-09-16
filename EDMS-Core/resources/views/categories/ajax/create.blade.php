<div class="row" style="padding-top:30px;">
<div class="col-md-10 col-md-offset-1">
<div class="col-md-6">
		<h3>ሓድሽ ከተማ ፍጠር</h3>
    </div>
<div class="col-md-6">
    <a href="{{route('categories.index')}}" class="get btn btn-success btn-xs navbar-right"><i class="fa fa-eye"></i> <strong>ዝርዝር ከተማታት</strong></a>
</div>
</div>
</div>
<div class="row" style="padding-top:30px;">
	<div class="col-md-10 col-md-offset-1">
  
	{{Form::open(array("route"=>"categories.store", "method"=>"POST", "class"=>"post"))!!}
    <label class="nextUrl" nextUrl="{{route('categories.index')}}" \>
 					         <div class="col-md-12 panel panel-info">
                <div class="panel-body">
                    <div class="row" style="padding-top:15px;">
                      <div class="col-md-10 form-group">
                                     <label class="label-control col-md-4">ሽም ከተማ</label>
                                     <div class="col-md-8">
                                       {{ Form::text('name', null, array('class'=>'form-control', 'required'=>'true'))}}
                                     </div>
                                 </div>
                      </div>
                      <div class="row" style="padding-top:15px;">
                          <div class="col-md-10 form-group">
                                 <label class="col-md-4 control-label"> መብርሂ</label>
                                  <div class="form-group col-md-8">
                                     {!! Form::textarea('remark', null, array('class'=>'form-control', 'rows'=>'3', 'id'=>'remark'));!!}
                                  </div>
                            </div>
                                 
                          </div>
            </div>
            <div class="row" style="padding-top:30px;">
                          <div class="col-md-12 form-group text-center">
                           
                            <button type="submit" class="btn btn-primary btn-md">
                                   <i class="fa fa-save"></i> ኣብ መዝገብ ኣቐምጥ
                            </button>
                        </div>
                      </div>
                      

                        </div>
                {{Form::close()}}
                        </div>
                        </div>


