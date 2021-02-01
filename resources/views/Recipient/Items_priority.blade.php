<!DOCTYPE html>
<html>
<head>
    @include('Recipient_partials.rhead')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Items&Supplies_Recipeient_priority</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/prove_blood.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/js/prove_blood.jv') }}" >


</head>
<body>

    @include('Recipient_partials.navbody')

    <div class="registration-form">

        <form accept-charset="UTF-8" action="Items_priority" method="post">
            @csrf
            <div style="font-weight: 900;" class="form-icon">

                <span><i ></i></span>Recipient Details
            </div>
      


             <div class="form-group">
                <label style="font-weight: bold;">What caused the need for the specific Item?</label>
                <select name="Ip1" style="height: 45px;" class="form-control item" id="exampleFormControlSelect1" required>
                  <option disabled selected value> -- select an option -- </option>
                  <option>Natural disaster</option>
                  <option>Organ malfunction</option>
                  <option>Others</option>
                </select>
             </div>

            
            <div class="form-group">
                <label style="font-weight: bold;">what is the maximun requirement time?</label>
                <select name="Ip2" style="height: 45px;" class="form-control item" id="exampleFormControlSelect1" required>
                  <option disabled selected value> -- select an option -- </option>
                  <option>Extremely Urgent</option>
                  <option>Urgent</option>
                  <option>Can wait for some time</option>
                </select>
             </div>

             <div class="form-group">
                <label style="font-weight: bold;">What category does the item or the supply belong to?</label>
                <select name="Ip3" style="height: 45px;" class="form-control item" id="exampleFormControlSelect1" required>
                  <option disabled selected value> -- select an option -- </option>
                  <option>Food and Drinks</option>
                  <option>Household/Domestic</option>
                  <option>Educational</option>
                  <option>Wearable</option>
                  
                </select>
             </div>

              <div class="form-group">
                <label style="font-weight: bold;">what is your household monthly income?</label>
                <select name="Ip4" style="height: 45px;" class="form-control item" id="exampleFormControlSelect1" required>
                  <option disabled selected value> -- select an option -- </option>
                  <option>Below 10 thousand</option>
                  <option>Below 25 thousand but Above 10 thousand</option>
                  <option>Below 50 thousand but Above 25 thousand</option>
                  <option>Above 50 thousand</option>
                </select>
             </div>

             <div class="form-group">
                <label style="font-weight: bold;">what is your on average Elecricity Bill?</label>
                <select name="Ip5" style="height: 45px;" class="form-control item" id="exampleFormControlSelect1" required>
                  <option disabled selected value> -- select an option -- </option>
                  <option>Below 2 thousand</option>
                  <option>Below 5 thousand but Above 2 thousand</option>
                  <option>Below 10 thousand but Above 5 thousand</option>
                  <option>Above 10 thousand</option>
                </select>
             </div>

             <div class="form-group">
                <label style="font-weight: bold;">In what class category do you consider yourself in?</label>
                <select name="Ip6" style="height: 45px;" class="form-control item" id="exampleFormControlSelect1" required>
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