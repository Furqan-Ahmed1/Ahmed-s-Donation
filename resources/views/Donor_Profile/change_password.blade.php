<!DOCTYPE html>
<html>
<head>
    <title>Personal Information</title>
    
@include('Donor_partials.dhead')

    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/donor_sidebar.css') }}" >

    <style>
      .btn1{
          display: block;
      background-color: #000000;
      width: 80px;
      height: 40px;
      line-height: 10px;
      color: #fff;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      cursor: pointer;
      overflow: hidden;
      border-radius: 5px;
      box-shadow: 0 0 20px 0 rgba(0,0,0,.3);
      }
      span {
      width: 72%;
      line-height: inherit;
      font-size: 13px;
      text-transform: uppercase;
      }
    .btn1:hover{
      -webkit-box-shadow: -300px 0 0 #1b1e23 inset;
    }
    </style>

</head>
<body>
	@include('Donor_partials.navbody')
	
      @include('Donor_Profile.settings_sidebar')

   <div class="main">

      <form accept-charset="UTF-8" action="change_dpassword" method="post">
      @csrf
   	    <h6> Change password</h6>
        <input class="span3" name="old_password" placeholder="Current Password" type="password" required><br>
        <input class="span3" name="newpassword" placeholder="New Password" type="password" required> <br>
        <input class="span3" name="checknewpassword" placeholder="Re-Enter new Password" type="password" required> <br>
        <h6>Minimum Length:6</h6>
        <br>

        <button class="btn1" type="submit" name="button"><span>save</span></button><br>
      </form>

   </div>

@include('partials.script')
</body>
</html>