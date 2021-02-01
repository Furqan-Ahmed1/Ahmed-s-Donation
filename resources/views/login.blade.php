<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">

    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="shortcut icon" href="{{ asset('asset/image/Latest_logo.png') }}" type="image/x-icon">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <style type="text/css">
        body{
            background-image: url(https://183263-537949-raikfcquaxqncofqfm.stackpathdns.com/wp-content/uploads/2018/05/Charitable-Donation-Programs-Boosting-your-Business-While-Serving-the-Community-e1599580239786.jpg);
            background-size: cover;
            background-attachment: fixed;
        }
        .container{


            height:38%;
            position: absolute;
            right: 0;
            left: 0;
            top: 0;
            bottom: 0;
            margin: auto;
            border-radius: 25px;
            width: 22%; 
            
            
        }
        
    </style>
  
</head>


<body>

<div  class="span3 well container" >
     <legend> Login</legend>
     <form accept-charset="UTF-8" action="login" method="post" >
        @csrf
        <label>Email</label>
        <input class="span3 form-control" name="email" placeholder="xyz@abc.com" type="email" required> <br><br>
        <label>password</label>
        <input class="span3" name="password" placeholder="Password" type="password" required> <br><br>

        <button class="btn btn-warning" type="submit" name="button">Login</button><br><br>
        <span>Dont have account?<a href="signup_phaseone">Sign up now</a></span>
     </form>

</div>

</body>
</html>