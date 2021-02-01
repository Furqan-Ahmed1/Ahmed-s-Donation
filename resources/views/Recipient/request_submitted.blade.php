<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>set appointment</title>
  
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css'>
@include('Recipient_partials.rhead')
</head>

<body>
@include('Recipient_partials.navbody')
<br>
  <div class="jumbotron text-xs-center">
  <h1 class="display-3">Your request have been submitted!</h1>
  <br>
  <p class="lead"><strong>Kindly wait for the administration to approve your request.</strong> </p>
  <hr>
  <p>
    Thankyou for using Ahmed Donation
  </p>
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="recipient" role="button">Continue</a>
  </p>
</div>
  
 <div style="margin:60px auto;text-align:center;">
<a><img width="40" height="40" src="{{ asset('asset/image/Latest_logo.png') }}" width="200"> <strong>Ahmed Donation</strong></p>

<a href="#" target="_blank"><strong>Request ->></strong></a>    
<a href="#" target="_blank"><strong>Support ->></strong></a>    
<a href="#" target="_blank"><strong>#Change </strong></a>
</div>
  
	@include('partials.script')
</body>

</html>	