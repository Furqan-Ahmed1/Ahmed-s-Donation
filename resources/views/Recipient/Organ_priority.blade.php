<!DOCTYPE html>
<html>
<head>
    @include('Recipient_partials.rhead')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Organ_Recipeient_priority</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/prove_blood.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/js/prove_blood.jv') }}" >


</head>
<body>

    @include('Recipient_partials.navbody')

    <div class="registration-form">

        <form accept-charset="UTF-8" action="Organ_priority" method="post">
            @csrf
            <div style="font-weight: 900;" class="form-icon">

                <span><i ></i></span>Recipient Details
            </div>
      
             <div class="form-group">
                <label style="font-weight: bold;">How would you characterize the patient's condition?</label>
                <select name="Op1" style="height: 45px;" class="form-control item" id="exampleFormControlSelect1" required>
                  <option disabled selected value> -- select an option -- </option>
                  <option>Average</option>
                  <option>Severe</option>
                  <option>Critical</option>
                </select>
             </div>
            
            <div class="form-group">
                <label style="font-weight: bold;">what is the maximun requirement time?</label>
                <select name="Op2" style="height: 45px;" class="form-control item" id="exampleFormControlSelect1" required>
                  <option disabled selected value> -- select an option -- </option>
                  <option>Extremely Urgent</option>
                  <option>Urgent</option>
                  <option>Can wait for some time</option>
                </select>
             </div>

             <div class="form-group">
                <label style="font-weight: bold;">Have you checked for the specific organ from somewhere else?</label>
                <select name="Op3" style="height: 45px;" class="form-control item" id="exampleFormControlSelect1" required>
                  <option disabled selected value> -- select an option -- </option>
                  <option>Yes</option>
                  <option>No</option>
                  
                </select>
             </div>

             <div class="form-group">
                <label style="font-weight: bold;">What was the cause of the Organ failure?</label>
                <select name="Op4" style="height: 45px;" class="form-control item" id="exampleFormControlSelect1" required>
                  <option disabled selected value> -- select an option -- </option>
                  <option>Accident</option>
                  <option>Age factor</option>
                  <option>Disease</option>
                  <option>Others</option>
                </select>
             </div>

             <div class="form-group">
                <label style="font-weight: bold;">In what class category do you consider yourself in?</label>
                <select name="Op5" style="height: 45px;" class="form-control item" id="exampleFormControlSelect1" required>
                  <option disabled selected value> -- select an option -- </option>
                  <option>Rich</option>
                  <option>Middle</option>
                  <option>Poor</option>
                </select>
             </div>

            
        <br>
           
            
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