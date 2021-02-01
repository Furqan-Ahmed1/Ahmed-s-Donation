<!-- <!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
	@include('Donor_partials.dhead')
</head>
<body>
	@include('Donor_partials.navbody')

    <div>Thank you</div>
	

@include('partials.script')
  

</body>
</html>
 -->
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Bootstrap 4 Thank You Page Template</title>
  
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css'>
@include('Donor_partials.dhead')
</head>

<body>
	@include('Donor_partials.navbody')

  <div class="jumbotron text-xs-center">
  <h1 class="display-3">Thank You!</h1>
  <p class="lead"><strong>We have received your request for the donation and we will make sure that it gets to the most needful person.</strong> </p>
  <hr>
  <p>
    Thankyou for using Ahmed Donation
  </p>
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="donation" role="button">Continue to homepage</a>
  </p>
</div>
  
 <div style="margin:60px auto;text-align:center;">
<br>
<a><img width="40" height="40" src="{{ asset('asset/image/Latest_logo.png') }}" width="200"> <strong>Ahmed Donation</strong></p>

<a href="#" target="_blank"><strong>Donate ->></strong></a>    
<a href="#" target="_blank"><strong>Support ->></strong></a>    
<a href="#" target="_blank"><strong>#Change </strong></a>
</div>
  

</body>

</html>	