@extends("layouts.auth_master-old")
@section("bodyContent") 
  <div id="container" class="col-md-12" style="padding-top: 0px;//40px">
    <div class="text-center">
      <img class="text-center" src="{{asset('images/'.$logo->logoImage)}}" alt="Logo" style="height: 160px; border-radius: 50%;padding-bottom: 10px;">
    </div>
      <div class="col-md-12" style="position: fixed; top: 0; left: 0; background: radial-gradient(green 5%, yellow 60%, #44bb44 35%);" >
        <span style="font-size: 30px; font-family: algerian; color: gold; text-shadow: 4px 6px black;"> <center>{{App\Global_var::getLangString($logo!=null? $logo->logoText :'E-DMS', $language_strings)}}</center> </span>
      </div>
<div class="login-box" style="margin-top:10px; ">
<div class="panel panel-success">
<div class="panel-heading">
  {{App\Global_var::getLangString('Sign_In', $language_strings)}}
  <a href="{{route('welcome')}}" class="pull-right" style="color: black"> {{App\Global_var::getLangString('Visit_Site', $language_strings)}} <b class="fa fa-globe"></b></a>
</div>
<div class="panel-body">
  <div class="login-box-body">
    <p class="login-box-msg" style="margin-top: -30px;">
  {!!Form::model(array( url('/login') , "method"=>"POST", "class"=>"post_"))!!}
      <div class="form-group has-feedback">
        <input autocomplete="off" id="email" type="text" class="form-control" name="email" value="{{ old('email') }}"  placeholder="{{App\Global_var::getLangString('Email', $language_strings)}}" autofocus="true">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="password" type="password" class="form-control" name="password" placeholder="{{App\Global_var::getLangString('Password', $language_strings)}}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        {{Form::select('selectedLang', $languages, null, ['class'=>'form-control'])}}
      </div>
      <div class="row">
          <!-- /.col -->
        <div class="col-md-12">
          <button type="submit" class="btn btn-success btn-block btn-flat"><i> </i> 
  {{App\Global_var::getLangString('Log_In', $language_strings)}}
          </button>
        </div>
        <!-- /.col -->
      </div>
{{Form::close()}}
  </div>
  <div class="social-auth-links text-center">
      {{App\Global_var::getLangString('Have_not_you_an_account', $language_strings)}}? <a href="{{url('register')}}">  {{App\Global_var::getLangString('Sign_Up', $language_strings)}}</a>
    </div>
    <div class="social-auth-links text-center">
      <a href="{{ url('/password/reset') }}"></i> {{App\Global_var::getLangString('Forgot_Password', $language_strings)}}</a>
    </div>
  </div>
  </div>

  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</div>
@stop
