<div class="col-md-12">
    <div class="col-md-10 col-md-offset-0">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4>
                    {{App\Global_var::getLangString('Edit', $language_strings)}}
                </h4>
            </div>
            <div class="panel-body">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="orgDetails">
                        {!!Form::model($user, array("route"=>["users.update", $user->id], "method"=>"POST", "class"=>"post"))!!}
                        <label class="nextUrl" nextUrl="{{route('users.show', $user->id)}}" ></label>
                                                    <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Role', $language_strings)}}</label>
                                {{ Form::select('roleId', [null=>'-- --']+$roles, $user->role->roleName, array('class'=>'roleId select2 form-control', 'required'=>'true'))}}
                            </div>
                            <!-- <div class="form-group">
                                <label for="roleId" class="control-label"> {{App\Global_var::getLangString('Department', $language_strings)}}</label>
                                {{ Form::select('departmentId', [null=>'-- --']+$departments, null, array('class'=>'departmentId select2 form-control', 'required'=>'true'))}}<br>
                            </div>  -->
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('First_Name', $language_strings)}}</label>
                                {{ Form::text('firstName', null, array('class'=>'form-control', 'required'=>'true'))}}
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Last_Name', $language_strings)}}</label>
                                {{ Form::text('lastName', null, array('class'=>'form-control', 'required'=>'true'))}}
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Middle_Name', $language_strings)}}</label>
                                {{ Form::text('middleName', null, array('class'=>'form-control', 'required'=>'true'))}}
                            </div>
                            
                        </div>
                        <div class="col-md-6">                              
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Email', $language_strings)}}</label>
                                {{ Form::email('email', null, array('class'=>'form-control', 'required'=>'true'))}}
                            </div>                             
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Username', $language_strings)}}</label>
                                {{ Form::text('userName', null, array('class'=>'form-control', 'required'=>'true'))}}
                            </div>
                            <div class="form-group">
                                <label class="control-label" > {{App\Global_var::getLangString('Phone_Number', $language_strings)}}</label>
                                {{ Form::text('phoneNumber', null, array('class'=>'phoneNumber number form-control', 'required'=>'true'))}}
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Password', $language_strings)}}</label>
                                {{Form::password("password", ['id'=>'password', 'class'=>'form-control'])}}
                                <span id="formErrors" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword" class="control-label" > {{App\Global_var::getLangString('Confirm_Password', $language_strings)}}</label>
                                {{Form::password("confirmPassword", ['id'=>'confirmPassword', 'class'=>'form-control'])}}
                            </div>
                        </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary col-md-6 col-md-offset-3">
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