@extends("layouts.auth_master")
@section("bodyContent") 

<div class="container-fluid bg-image">
    <div class="row">
        <div class="login-wraper">
            <img src="{{asset('images/login.jpg')}}" alt="">
            <div class="banner-text">
                <div class="line"></div>
                <div class="b-text">
                    Watch <span class="color-active">millions<br> of</span> <span class="color-b1">v</span><span class="color-b2">i</span><span class="color-b3">de</span><span class="color-active">os</span> for free.
                </div>
                <div class="overtext">
                    Over 6000 videos uploaded Daily.
                </div>
            </div>
            <div class="login-window">
                <div class="l-head">
                    Sign Up for Free
                </div>
                <div class="l-form">

<form class="sign_up_post form-horizontal" method="POST" action="{{ route('register') }}">
                      <label class="nextUrl" nextUrl="{{route('login')}}" ></label>
                        {{ csrf_field() }}

                        <div class="form-group_" style="margin-bottom: 30px">
                            <label for="name" class="col-md-3 control-label">{{App\Global_var::getLangString('Email', $language_strings)}}</label>

                            <div class="col-md-8">
                                {{Form::email("email", null, ["class"=>"email signup_elem form-control", "autocomplete"=>"off", "autofocus"=>"true"])}}
                                <span class="emailErr errorSpan" style="color: red"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group_" style="margin-bottom: 30px">
                            <label for="fullName" class="col-md-3 control-label">{{App\Global_var::getLangString('First_Name', $language_strings)}}</label>
                            <div class="col-md-8">
                                {{Form::text("firstName", null, ["class"=>"firstName signup_elem form-control", "autocomplete"=>"off"])}}
                                <span class="firstNameErr errorSpan" style="color: red"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group_" style="margin-bottom: 30px">
                            <label for="fullName" class="col-md-3 control-label">{{App\Global_var::getLangString('Last_Name', $language_strings)}}</label>
                            <div class="col-md-8">
                                {{Form::text("lastName", null, ["class"=>"lastName signup_elem form-control", "autocomplete"=>"off"])}}
                                <span class="lastNameErr errorSpan" style="color: red"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group_" style="margin-bottom: 30px">
                            <label for="fullName" class="col-md-3 control-label">{{App\Global_var::getLangString('Middle_Name', $language_strings)}}</label>
                            <div class="col-md-8">
                                {{Form::text("middleName", null, ["class"=>"middleName signup_elem form-control", "autocomplete"=>"off"])}}
                                <span class="middleNameErr errorSpan" style="color: red"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group_" style="margin-bottom: 30px">
                            <label for="fullName" class="col-md-3 control-label">{{App\Global_var::getLangString('Phone_Number', $language_strings)}}</label>
                            <div class="col-md-8">
                                {{Form::text("phoneNumber", null, ["class"=>"phoneNumber_signup number signup_elem form-control", "autocomplete"=>"off"])}}
                                <span class="phoneNumberErr errorSpan" style="color: red"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group_" style="margin-bottom: 30px">
                            <label for="password" class="col-md-3 control-label">{{App\Global_var::getLangString('Password', $language_strings)}}</label>
                            <div class="col-md-8">
                                {{Form::password("password", ["class"=>"password signup_elem form-control", "autocomplete"=>"off"])}}
                                <span class="passwordErr errorSpan" style="color: red"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group_" style="margin-bottom: 30px">
                            <label for="confirmPassword" class="col-md-3 control-label">{{App\Global_var::getLangString('Confirm_Password', $language_strings)}}</label>
                            <div class="col-md-8">
                                {{Form::password("confirmPassword", ["class"=>"confirmPassword signup_elem form-control", "autocomplete"=>"off"])}}
                                <span class="confirmPasswordErr errorSpan" style="color: red"></span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-7"><button type="submit" class="btn btn-cv1">{{App\Global_var::getLangString('Register', $language_strings)}}</button></div>
                            <div class="col-lg-1 ortext">or</div>
                            <div class="col-lg-4 signuptext"><a href="{{route('public_login')}}">{{App\Global_var::getLangString('Log_In', $language_strings)}}</a></div>
                        </div>
                    </form>
<!-- 
                    <form action="signup.html">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="sample@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="**********">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">Re-type Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="**********">
                        </div>
                        <div class="row">
                            <div class="col-lg-7"><button type="submit" class="btn btn-cv1">Sign Up</button></div>
                            <div class="col-lg-1 ortext">or</div>
                            <div class="col-lg-4 signuptext"><a href="login.html">Log In</a></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 forgottext">
                                <a href="#">By clicking "Sign Up" I agree to circle's Terms of Service.</a>
                            </div>
                        </div>
                    </form> -->
                </div>
            </div>
        </div>
    </div>
</div>

@stop