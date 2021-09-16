<div class="col-md-12">
<div class="col-md-8 col-md-offset-2 panel">
<div class="col-md-12 panel-body">
    <center><h3> {{App\Global_var::getLangString('Manage_Your_Account', $language_strings)}}
      </h3>
      <hr>
    </center>
  <div class="col-md-12">
    {{Form::open(['route'=>['users.manageAccounts', $user->id], 'method'=>'POST', 'class'=>'post'])}}
    <label class="nextUrl" nextUrl="{{route('home')}}"></label>
    <div class="col-md-12">
    <div class="col-md-6">
      {{App\Global_var::getLangString('Username', $language_strings)}}
      {{Form::text('userName', $user->userName, ['class'=>'form-control', 'placeholder'=>'Username'])}}<br>
      {{App\Global_var::getLangString('First_Name', $language_strings)}}
      {{Form::text('firstName', $user->firstName, ['class'=>'form-control', 'placeholder'=>'First Name'])}}<br>
       {{App\Global_var::getLangString('Last_Name', $language_strings)}}
      {{Form::text('lastName', $user->lastName, ['class'=>'form-control','placeholder'=>'Last Name'])}}<br>
      {{App\Global_var::getLangString('Middle_Name', $language_strings)}}
      {{Form::text('middleName', $user->middleName, ['class'=>'form-control','placeholder'=>'Middle Name'])}}<br>
      {{App\Global_var::getLangString('Phone_Number', $language_strings)}}
      {{Form::text('phoneNumber', $user->phoneNumber, ['class'=>'form-control','placeholder'=>'Phone Number'])}}<br>
    </div>
    <div class="col-md-6">
      {{App\Global_var::getLangString('Email', $language_strings)}}
      {{Form::text('email', $user->email, ['disabled'=>'disabled', 'class'=>'form-control'])}}<br>{{App\Global_var::getLangString('Old_Password', $language_strings)}}
      {{Form::password('oldPassword', ['class'=>'form-control','placeholder'=>'Old Password'])}}<br>
      {{App\Global_var::getLangString('New_Password', $language_strings)}}
      {{Form::password('password', ['class'=>'form-control','placeholder'=>'New Password','style'=>'margin-top: 4px'])}}<br>
      {{App\Global_var::getLangString('Confirm_New_Password', $language_strings)}}
      {{Form::password('cpassword', ['class'=>'form-control','placeholder'=>'Confirm New Password'])}}
    </div>
    </div>  
    <div class="col-md-12">
    <div class="col-md-6 col-md-offset-3">
      {{Form::submit(App\Global_var::getLangString('Save', $language_strings), ['class'=>'btn btn-success btn-block'])}}
      {{Form::close()}}
    </div>
    </div>
  </div>
</div>
</div>
</div>
