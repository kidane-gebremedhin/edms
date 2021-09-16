<div class="col-md-12">
    <div class="col-md-10">
        <div class="panel panel-success">
            <div class="panel-heading">                
                {{App\Global_var::getLangString('Create_New_User', $language_strings)}} 
                <a href="{{route('users.index')}}" class="get btn btn-success btn-sm pull-right"><i class="fa fa-eye"></i> 
                {{App\Global_var::getLangString('List', $language_strings)}}</a>
                <div style="height: 12px;"></div>
            </div>
            <div class="panel-body">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="orgDetails">
                        {!!Form::open(array("route"=>"users.store", "method"=>"POST", "class"=>"post"))!!}
                        <label class="nextUrl col-md-12" nextUrl="{{route('users.index')}}" />
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Role', $language_strings)}}</label>
                                {{ Form::select('roleId', [null=>'-- --']+$roles, null, array('class'=>'roleId select2 form-control', 'required'=>'true'))}}
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
                                <?php $generatedPassword=\App\Global_var::generatePassword(6); ?>
                            <div class="form-group">
                                <label class="control-label"> {{App\Global_var::getLangString('Password', $language_strings)}}</label>
                                <input type="password" name="password" value="{{$generatedPassword}}" id="password" class="passwordField form-control" required>
                                <span id="formErrors" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword" class="control-label" > {{App\Global_var::getLangString('Confirm_Password', $language_strings)}}</label>
                                <input type="password" name="confirmPassword" value="{{$generatedPassword}}" id="confirmPassword" class="passwordField form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success col-md-6 col-md-offset-3">
                                {{App\Global_var::getLangString('Save', $language_strings)}}
                            </button>
                            <div class="col-md-3">
                            <span class="pull-right" style="font-size: 20px">  <label><input type="checkbox" name="showPassword" class="showPassword"> {{App\Global_var::getLangString('Show_Password', $language_strings)}} <i class="fa fa-eye"></i></label></span>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>