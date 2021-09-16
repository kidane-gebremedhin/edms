@extends("layouts.auth_master-old")
@section("bodyContent") 
<div class="">
    <h3 style="font-family: algerian; color: orange"> <center>{{App\Global_var::getLangString($logo!=null? $logo->logoText :'E-DMS', $language_strings)}}</center> </h3>
<div class="panel-body">
<div class="col-md-12">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{App\Global_var::getLangString('Sign_Up', $language_strings)}}
                <a href="{{route('welcome')}}" class="pull-right" style="color: black"> {{App\Global_var::getLangString('Visit_Site', $language_strings)}} <b class="fa fa-globe"></b></a>
                </div>
                <div class="panel-body">
                    <form class="sign_up_post form-horizontal" method="POST" action="{{ route('register') }}">
                      <label class="nextUrl" nextUrl="{{route('login')}}" ></label>
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">{{App\Global_var::getLangString('Email', $language_strings)}}</label>

                            <div class="col-md-6">
                                {{Form::email("email", null, ["class"=>"email signup_elem form-control", "autocomplete"=>"off", "autofocus"=>"true"])}}
                                <span class="emailErr errorSpan" style="color: red"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="fullName" class="col-md-4 control-label">{{App\Global_var::getLangString('First_Name', $language_strings)}}</label>
                            <div class="col-md-6">
                                {{Form::text("firstName", null, ["class"=>"firstName signup_elem form-control", "autocomplete"=>"off"])}}
                                <span class="firstNameErr errorSpan" style="color: red"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="fullName" class="col-md-4 control-label">{{App\Global_var::getLangString('Last_Name', $language_strings)}}</label>
                            <div class="col-md-6">
                                {{Form::text("lastName", null, ["class"=>"lastName signup_elem form-control", "autocomplete"=>"off"])}}
                                <span class="lastNameErr errorSpan" style="color: red"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="fullName" class="col-md-4 control-label">{{App\Global_var::getLangString('Middle_Name', $language_strings)}}</label>
                            <div class="col-md-6">
                                {{Form::text("middleName", null, ["class"=>"middleName signup_elem form-control", "autocomplete"=>"off"])}}
                                <span class="middleNameErr errorSpan" style="color: red"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="fullName" class="col-md-4 control-label">{{App\Global_var::getLangString('Phone_Number', $language_strings)}}</label>
                            <div class="col-md-6">
                                {{Form::text("phoneNumber", null, ["class"=>"phoneNumber_signup number signup_elem form-control", "autocomplete"=>"off"])}}
                                <span class="phoneNumberErr errorSpan" style="color: red"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">{{App\Global_var::getLangString('Password', $language_strings)}}</label>
                            <div class="col-md-6">
                                {{Form::password("password", ["class"=>"password signup_elem form-control", "autocomplete"=>"off"])}}
                                <span class="passwordErr errorSpan" style="color: red"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="confirmPassword" class="col-md-4 control-label">{{App\Global_var::getLangString('Confirm_Password', $language_strings)}}</label>
                            <div class="col-md-6">
                                {{Form::password("confirmPassword", ["class"=>"confirmPassword signup_elem form-control", "autocomplete"=>"off"])}}
                                <span class="confirmPasswordErr errorSpan" style="color: red"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success btn-block">
                                    {{App\Global_var::getLangString('Register', $language_strings)}}
                                </button>
                            </div>
                              
                        </div>
                        <div class="social-auth-links text-center">
                              {{App\Global_var::getLangString('Already_have_an_account', $language_strings)}}? <a href="{{url('login')}}">{{App\Global_var::getLangString('Sign_In', $language_strings)}}</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
  </div>

@stop
