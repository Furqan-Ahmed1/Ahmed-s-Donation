<!DOCTYPE html>
<html>
<head>
    <title>Personal Information</title>
    
@include('Donor_partials.dhead')

    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/donor_sidebar.css') }}" >


</head>
<body>
	@include('Donor_partials.navbody')
	
      @include('Donor_Profile.settings_sidebar')

   <div class="main">

   	  <h6>ID: <?php echo $donor_info->donor_id; ?></h6>
      <h6>First Name: <?php echo $donor_info->first_name; ?></h6>
      <h6>Last Name: <?php echo $donor_info->last_name; ?></h6>
      <h6>Email: <?php echo $donor_info->email; ?></h6>
      <h6>Date Of Birth: <?php echo $donor_info->date_of_birth; ?></h6>
      <h6>Gender: <?php echo $donor_info->gender; ?></h6>
      <h6>Phone No.: <?php echo $donor_info->phone_no; ?></h6>
      <h6>Address: <?php echo $donor_info->address; ?></h6>
      <h6>Education: <?php echo $donor_info->education; ?></h6>
      <h6>Occupation: <?php echo $donor_info->occupation; ?></h6>
      <h6>Cnic: <?php echo $donor_info->cnic; ?></h6>
      <h6>Card No.: <?php echo $donor_info->card_no; ?></h6>
      <h6>CVV: <?php echo $donor_info->cvv; ?></h6>

   </div>

@include('partials.script')
</body>
</html>