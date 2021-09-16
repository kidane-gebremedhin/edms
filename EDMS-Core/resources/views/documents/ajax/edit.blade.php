<?php
$document_edition=$document->editions->first()
?>
<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4>
                    {{App\Global_var::getLangString('Edit', $language_strings)}}
                </h4>
            </div>
            <div class="panel-body">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="orgDetails">
                        {!!Form::model($document, array("route"=>["documents.update", $document->id], "method"=>"POST", "class"=>"post_", "files"=>true))!!}
                        <label class="nextUrl" nextUrl="{{route('documents.show', $document->id)}}" />
                    <div class="col-md-4"> 
                        <div class="panel panel-warning">
                            <div class="panel-heading"> 
                                {{App\Global_var::getLangString('Document_Information', $language_strings)}}
                            </div>  
                        <div class="panel-body">
                            <div class="form-group">
                                {{ Form::select('category', [null=>'-- Document Type --']+$document_categories, null, array('class'=>'category select2 form-control', 'required'=>'true'))}}
                            </div>
                            <div class="form-group">
                                {{ Form::select('subCategory', [null=>'-- Sub sub-category --']+$document_sub_categories, null, array('class'=>'subCategory select2 form-control', 'required'=>'true'))}}
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Title', $language_strings)}}</label>
                                {{ Form::text('title', null, array('class'=>'form-control', 'required'=>'true'))}}
                            </div>
                            <div class="form-group">
                                <label for="roleId" class="control-label"> {{App\Global_var::getLangString('Edition', $language_strings)}}</label>
                                {{ Form::number('edition', $document_edition!=null? $document_edition->edition: null, array('class'=>'edition form-control', 'required'=>'true', 'min'=>'1'))}}<br>
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Select_File', $language_strings)}}</label>
                                {{ Form::file('file', null, array('class'=>'form-control', 'required'=>'true'))}}
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Summery', $language_strings)}}</label>
                                {{ Form::textarea('summery', null, array('class'=>'form-control', 'rows'=>'2'))}}
                            </div>
                            
                            <div class="form-group">
                                <label for="roleId" class="control-label"> {{App\Global_var::getLangString('Location', $language_strings)}}</label>
                                {{ Form::text('location', null, array('class'=>'location form-control'))}}<br>
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Description', $language_strings)}}</label>
                                {{ Form::textarea('description', null, array('class'=>'form-control', 'rows'=>'2'))}}
                            </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4"> 
                        <div class="panel panel-warning">
                            <div class="panel-heading"> 
                                {{App\Global_var::getLangString('Author_Information', $language_strings)}}
                            </div>  
                        <div class="panel-body">
                            <div class="form-group">
                                <!-- <label class="control-label"> {{App\Global_var::getLangString('Author', $language_strings)}}</label> -->
                                {{ Form::select('authorId', [null=>'-- Select Author --']+$authors, null, array('class'=>'authorId select2 form-control'))}}
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('First_Name', $language_strings)}}</label>
                                {{ Form::text('firstName', $document->author!=null? $document->author->firstName: null, array('class'=>'firstName author_elem form-control', 'required'=>'true'))}}
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Last_Name', $language_strings)}}</label>
                                {{ Form::text('lastName', $document->author!=null? $document->author->lastName: null, array('class'=>'lastName author_elem form-control'))}}
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Middle_Name', $language_strings)}}</label>
                                {{ Form::text('middleName', $document->author!=null? $document->author->middleName: null, array('class'=>'middleName author_elem form-control'))}}
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Email', $language_strings)}}</label>
                                {{ Form::email('author_email', $document->author!=null? $document->author->email: null, array('class'=>'author_email author_elem form-control'))}}
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Phone_Number', $language_strings)}}</label>
                                {{ Form::text('author_phoneNumber', $document->author!=null? $document->author->phoneNumber: null, array('class'=>'author_phoneNumber author_elem form-control'))}}
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="col-md-4"> 
                        <div class="panel panel-warning">
                            <div class="panel-heading"> 
                                {{App\Global_var::getLangString('Publisher_Information', $language_strings)}}
                            </div>  
                        <div class="panel-body">
                            <div class="form-group">
                                <!-- <label class="control-label"> {{App\Global_var::getLangString('Publisher', $language_strings)}}</label> -->
                                {{ Form::select('publisherId', [null=>'-- Select Publisher --']+$publishers, $document_edition!=null? $document_edition->publisherId: null, array('class'=>'publisherId select2 form-control'))}}
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Year_of_Publishment', $language_strings)}}</label>

                        {{ Form::select('yearOfPublishment', [null=>'-- Select Year --']+$years, $document_edition!=null? $document_edition->yearOfPublishment: null, array('class'=>'yearOfPublishment select2 form-control', 'required'=>'true'))}}

                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Name', $language_strings)}}</label>
                                {{ Form::text('name', $document_edition->publisher!=null? $document_edition->publisher->name: null, array('class'=>'name publisher_elem form-control', 'required'=>'true'))}}
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Year_of_Establishment', $language_strings)}}</label>

                        {{ Form::select('yearOfEstablishment', [null=>'-- Select Year --']+$years, $document_edition->publisher!=null? $document_edition->publisher->yearOfEstablishment: null, array('class'=>'yearOfEstablishment publisher_elem select2 form-control', 'required'=>'true'))}}

                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Email', $language_strings)}}</label>
                                {{ Form::email('publisher_email', $document_edition->publisher!=null? $document_edition->publisher->email: null, array('class'=>'publisher_email publisher_elem form-control'))}}
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Phone_Number', $language_strings)}}</label>
                                {{ Form::text('publisher_phoneNumber', $document_edition->publisher!=null? $document_edition->publisher->phoneNumber: null, array('class'=>'publisher_phoneNumber publisher_elem form-control'))}}
                            </div>
                        </div>
                        </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success col-md-6 col-md-offset-3">
                                {{App\Global_var::getLangString('Save', $language_strings)}}
                            </button>
                        </div>
                    {{Form::close()}}
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>