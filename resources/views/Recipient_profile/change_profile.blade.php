<!DOCTYPE html>
<html>
<head>
    <title>Personal Information</title>
    
@include('Recipient_partials.rhead')

    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/donor_sidebar.css') }}" >

    <style>
    	.btn1{
	      	display: block;
			background-color: #696969;
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
	@include('Recipient_partials.navbody')
	
      @include('Recipient_Profile.settings_sidebar')

   <div class="main">

   		<form accept-charset="UTF-8" action="change_rinfo" method="post">
    	@csrf
    	<h6>Change will be saved once you press save button</h6>
    	<label>First Name</label>
        <input name="first_name" placeholder="Enter First Name" type="text"><br><br>
        <label>Last Name</label>
        <input name="last_name" placeholder="Enter Last name" type="text"><br><br>
        <label>Email(You will be logged out if you change email)</label>
        <input name="email" placeholder="xyz@abc.com" type="email"> <br><br>
        <label>Occupation</label>
        <input name="occupation" placeholder="Eg: Engineer" type="text"><br>
        <label>Education</label>
        <input name="education" placeholder="Eg: Inter" type="text"><br>
        <label>Date of Birth</label>
    	<input name="date" placeholder="dd" type="text">
    	<input name="month" placeholder="mm" type="text">
    	<input name="year" placeholder="yyyy" type="text"><br>

		<label>Gender</label>
		<input type="radio" name="gender" value="M"> M
        <input type="radio" name="gender" value="F"> F
      	<br><br>

      	<label>Phone Number</label>
      	<input name="phone" placeholder="Enter Phone Number" type="text"><br>
      	<label>Address</label>
      	<input name="address" placeholder="Enter Address" type="text"><br><br>
        <button class="btn1" type="submit" name="button"><span>save</span></button><br>
    </form>

   </div>

@include('partials.script')
</body>
</html>