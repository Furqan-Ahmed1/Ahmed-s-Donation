<!DOCTYPE html>
<html>
<head>
    @include('Recipient_partials.rhead')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proves_for_Blood</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/prove_blood.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/js/prove_blood.jv') }}" >


</head>
<body>

    @include('Recipient_partials.navbody')

    <div class="registration-form">

        <form accept-charset="UTF-8" action="Prove_blood" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-icon">

                <span><i ></i></span>Blood Need Details
            </div>
            
            <a style="font-weight: 900;" href="Blood_priority" class="btn btn-light form-control ">CLICK HERE: First Answer Some Personal Questions  </a>
            <br><br>
            <div class="form-group" >

                <select name="Blood_Grp" style="height: 45px;" class="form-control item" id="exampleFormControlSelect1" required>
                  <option disabled selected value> -- select blood group -- </option>
                  <option>AB+</option>
                  <option>AB-</option>
                  <option>A+</option>
                  <option>A-</option>
                  <option>B+</option>
                  <option>B-</option>
                  <option>O+</option>
                  <option>O-</option>
                </select>
            </div>
            <div class="form-group">
                <input name="Blood_Quantity" type="float" class="form-control item" placeholder="Quanlity(litres)" required>
            </div>
            <br>

                <h5 >Medical Report</h5>
                <input name="Blood_Med" type="file" class="btn btn-mdb-color btn-rounded float-left" required>

                
            
            <br><br>
            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">SUBMIT DETAILS</button>
                <br><br>
            </div>
        </form>
      
    </div>

   @include('partials.script')
</body>
</html>