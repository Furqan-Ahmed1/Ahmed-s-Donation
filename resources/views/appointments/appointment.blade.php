<!DOCTYPE html>
<html>
<head>
	<title>Blood Appointment</title>
	<meta charset="utf-8">
	@include('Donor_partials.dhead')

<style type="text/css">
		input[type=text] {
  background-color: #3CBC8D;
  color: white;
  border: 2px solid blue;
  border-radius: 4px;
  width: 100%;
  height:50px;
}

 .button[type=submit]{
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
  width: 100%;
}
</style>

</head>

<body>

	@include('Donor_partials.navbody')

	<br><br><br>
<div class="container">
    
<main role="main">

	    @if ($donation_way == 'spec_way')
		    @if ($donation_type == 'blood')
		    <form  accept-charset="UTF-8" action="set_bapp_spec" method="post">
		    	@csrf
		  		<input type="text" name="reciever" placeholder="Enter recipent id " required><br><br>
		  		<button class="button" type="submit" name="submit" value="donated">
		        <span>Donate</span>
		  		</button><br>
	  		</form>
	  		@endif

	  		@if ($donation_type == 'organ')
		    <form  accept-charset="UTF-8" action="set_oapp_spec" method="post">
		    	@csrf
		  		<input type="text" name="reciever" placeholder="Enter recipent id " required><br><br>
		  		<button class="button" type="submit" name="submit" value="donated">
		        <span>Donate</span>
		  		</button><br>
	  		</form>
	  		@endif

	  		@if ($donation_type == 'items')
		    <form  accept-charset="UTF-8" action="set_isapp_spec" method="post">
		    	@csrf
		  		<input type="text" name="reciever" placeholder="Enter recipent id " required><br><br>
		  		<button type="submit" class="button" name="submit" value="donated">
		        <span>Donate</span>
		  		</button><br>
	  		</form>
	  		@endif

  		@endif
  		@if ($donation_way != 'spec_way')
  		@include('appointment_set');
  		@endif
</main>
</div>

@include('partials.script')

</body>
</html>