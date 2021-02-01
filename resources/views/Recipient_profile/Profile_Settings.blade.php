<!DOCTYPE html>
<html>
<head>
    <title>Personal Information</title>
    
@include('Recipient_partials.rhead')

    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/donor_sidebar.css') }}" >


</head>
<body>
	@include('Recipient_partials.navbody')
	
      @include('Recipient_profile.settings_sidebar')

   <div class="main">

   	  <h6>ID: <?php echo $recipient_info->recipient_id; ?></h6>
      <h6>First Name: <?php echo $recipient_info->first_name; ?></h6>
      <h6>Last Name: <?php echo $recipient_info->last_name; ?></h6>
      <h6>Email: <?php echo $recipient_info->email; ?></h6>
      <h6>Date Of Birth: <?php echo $recipient_info->date_of_birth; ?></h6>
      <h6>Gender: <?php echo $recipient_info->gender; ?></h6>
      <h6>Phone No.: <?php echo $recipient_info->phone_no; ?></h6>
      <h6>Address: <?php echo $recipient_info->address; ?></h6>
      <h6>Education: <?php echo $recipient_info->education; ?></h6>
      <h6>Occupation: <?php echo $recipient_info->occupation; ?></h6>
      <h6>Cnic: <?php echo $recipient_info->cnic; ?></h6>
      <h6>Card No.: <?php echo $recipient_info->card_no; ?></h6>
      <h6>CVV: <?php echo $recipient_info->cvv; ?></h6>

   </div>

@include('partials.script')
</body>
</html>