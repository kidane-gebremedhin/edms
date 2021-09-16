<div class="col-md-12">
<div class="col-md-12" style="padding-bottom: 10px; background: //green">
<input type="hidden" class="category" value='{{$category}}' />
<input type="hidden" id="searchUrl" value="{{route('documents.index')}}">
          <div class="col-md-3">
            <label class="col-md-12"><center>{{App\Global_var::getLangString('Title', $language_strings)}}</center></label>
            <div class="col-md-12"> 
              {!! Form::text('title', null, array('class'=>'form-control document_search_input_elem title', 'autocomplete'=>'off', 'autofocus'=>'autofocus'));!!}
            </div>
          </div>
          <div class="col-md-3">
            <label class="col-md-12"><center>{{App\Global_var::getLangString('Author', $language_strings)}}</center></label>
            <div class="col-md-12"> 
              {!! Form::select('authorId', [null=>'-- Select Author --']+$authors, null, array('class'=>'select2 form-control document_search_select_elem authorId'));!!}
            </div>
          </div>
          <div class="col-md-3">
            <label class="col-md-12"><center>{{App\Global_var::getLangString('Publisher', $language_strings)}}</center></label>
            <div class="col-md-12"> 
              {!! Form::select('publisherId', [null=>'-- Select Publisher --']+$publishers, null, array('class'=>'select2 form-control document_search_select_elem publisherId'));!!}
            </div>
          </div>
          <div class="col-md-3">
            <label class="col-md-12"><center>{{App\Global_var::getLangString('Year_of_Publishment', $language_strings)}}</center></label>
            <div class="col-md-12"> 
              {!! Form::select('yearOfPublishment', [null=>'-- Select Year of Publishment --']+$years, null, array('class'=>'select2 form-control document_search_select_elem yearOfPublishment'));!!}
            </div>
          </div>
</div>
</div>
<div class="col-md-12">
<div class="searchResultDiv">
@include('documents.ajax.index_search_result')
</div>
</div>