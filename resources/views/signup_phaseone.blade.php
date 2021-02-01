<!DOCTYPE html>
<html>
<head>
    <title>SignUp</title>
   
   <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="shortcut icon" href="{{ asset('asset/image/Latest_logo.png') }}" type="image/x-icon">

    <style type="text/css">
    	body{
    		background-image: url(https://i.guim.co.uk/img/media/e04e9e8e1f3ca4cf91cdc35f151fb628f0492e58/0_0_3000_1995/master/3000.jpg?width=1225&quality=85&auto=format&fit=max&s=fe14082447d65ea1f6de17c24cbe4541);
    		background-size: cover;
    		background-attachment: fixed;
    	}
      .container{

           position:relative;
            right: 0;
            left: 450px;
            top: 50;
            bottom: 0;
            
            border-radius: 25px;
            width: 22%; 
            height: 100%;
            
    </style>

.
</head>
<body>
<!--"{{URL::to('/signupp')}}"  to go to nxt url-->	
    <div class="span3 well container">
      <legend> Registration</legend>

    <form accept-charset="UTF-8" action="signup_phaseone" method="post">
    	@csrf
    	<label>First Name</label>
        <input class="span3" name="first_name" placeholder="Enter First Name" type="text" required><br><br>
        <label>Last Name</label>
        <input class="span3" name="last_name" placeholder="Enter Last name" type="text" required><br><br>
        <label>Email</label>
        <input class="span3" name="email" placeholder="xyz@abc.com" type="email" required> <br><br>
        <label>password</label>
        <input class="span3" name="password" placeholder="Password" type="password" required> <br><br>
        <input class="span3" name="checkpassword" placeholder="Re-Enter Password" type="password" required> <br><br>
        <label>Occupation</label>
        <input class="span3" name="occupation" placeholder="Eg: Engineer" type="text" required><br>
        <!-- <label>Date of Birth</label>
    	<input class="span3" name="date" placeholder="dd" type="text"><br>
    	<input class="span3" name="month" placeholder="mm" type="text"><br>
    	<input class="span3" name="year" placeholder="yyyy" type="text"><br> -->

		<label>Gender</label>
		<input type="radio" name="gender" value="M"> M
        <input type="radio" name="gender" value="F"> F
      	<br><br>

      	<label>Who are you?</label>
		<input type="radio" name="user_type" value="Donor" required> Donor
        <input type="radio" name="user_type" value="Recipient" required> Recipient
      	<br><br>

      	<label>Phone Number</label>
      	<input class="span3" name="phone" placeholder="Enter Phone Number" type="text" required><br><br>
      	<label>Address</label>
      	<input class="span3" name="address" placeholder="Enter Address" type="text" required><br><br>
      	<label>Cnic</label>
      	<input class="span3" name="cnic" placeholder="xxxxxxxxxxxxx" type="text" required> <br><br>
        <button class="btn btn-warning" type="submit" name="button">Register</button><br>
        <span>Already have an account? <a href="login">Login</a></span>
    </form>
</div> 
</body>
</html>