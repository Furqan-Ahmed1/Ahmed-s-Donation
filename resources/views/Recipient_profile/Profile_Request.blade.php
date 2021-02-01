<!DOCTYPE html>
<html>
<head>
  <title>Donation Appointments</title>
    @include('Recipient_partials.rhead')

    <style>

      h2{
        text-align: center;
      }
    </style>
</head>
<body>

    @include('Recipient_partials.navbody')
    <div class="container">
<main role="main">
      

      @if($blood_req != '[]')
      <h2>Blood Donation Request</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>ID#</th>
              <th>Blood Group</th>
              <th>Quatity Needed(ltr)</th>
              <th>Medical_Report</th>
              <th>Location To Get Donation</th>
              <th>Request</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1; ?>
            @foreach($blood_req as $d1)  
            <tr>
                <td ><?php echo $x; $x++; ?> </td>
                  <td>{{$d1->Blood_Group}}</td>
                  <td>{{$d1->Quantity_ltr}}</td>
                  <td>{{$d1->Medical_Report}}</td>
                  <td>Nearest Agha Khan Laboratory</td>
                @if($d1->Approval == 1)
                  <td>Approved</td>
                @else
                  <td>Pending</td>
                @endif
            </tr>
            @endforeach

            
          </tbody>
        </table>
      </div>
      @endif


      @if ($organ_req != '[]')
      <br><br><br><h2>Organ Donation Request</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>ID#</th>
              <th>Blood Group</th>
              <th>Organ Name</th>
              <th>Medical_Report</th>
              <th>Location To Get Donation</th>
              <th>Request</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1; ?>
            @foreach($organ_req as $d1)  
            <tr>
              <td ><?php echo $x; $x++; ?> </td>
                  <td>{{$d1->Blood_Group}}</td>
                  <td>{{$d1->Organ_Name}}</td>
                  <td>{{$d1->Medical_Report}}</td>
                  <td>Nearest Agha Khan Laboratory</td>
                @if($d1->Approval == 1)
                  <td>Approved</td>
                @else
                  <td>Pending</td>
                @endif
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif


      @if ($item_req != '[]')
      <br><br><br><h2>Item & supplies Donation Request</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>ID#</th>
              <th>Item Name</th>
              <th>Quantity</th>
              <th>Electricity Bill</th>
              <th>Gas Bill</th>
              <th>Finantial Statement</th>
              <th>Location To Get Donation</th>
              <th>Request</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1; ?>
            @foreach($item_req as $d1)  
            <tr>
              <td ><?php echo $x; $x++; ?> </td>
                  <td>{{$d1->Item_Name}}</td>
                  <td>{{$d1->Quantity}}</td>
                  <td>{{$d1->Electric_Bill}}</td>
                  <td>{{$d1->Gas_Bill}}</td>
                  <td>{{$d1->Finantial_statement}}</td>
                  <td>Nearest Branch Of Our Company</td>
                @if($d1->Approval == 1)
                  <td>Approved</td>
                @else
                  <td>Pending</td>
                @endif
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      @endif

      @if ($money_req != '[]')
      <br><br><br><h2>Money Donation Request</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>ID#</th>
              <th>Amount</th>
              <th>Electricity Bill</th>
              <th>Gas Bill</th>
              <th>Finantial Statement</th>
              <th>Location To Get Donation</th>
              <th>Request</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1; ?>
            @foreach($money_req as $d1)  
            <tr>
              <td ><?php echo $x; $x++; ?> </td>
                  <td>{{$d1->Amount}}</td>
                  <td>{{$d1->Electric_Bill}}</td>
                  <td>{{$d1->Gas_Bill}}</td>
                  <td>{{$d1->Finantial_statement}}</td>
                  <td>Nearest Branch Of Our Company</td>
                @if($d1->Approval == 1)
                  <td>Approved</td>
                @else
                  <td>Pending</td>
                @endif
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      @endif

      @if($money_req == '[]' and $item_req == '[]' and $blood_req == '[]' and $organ_req == '[]')
        <h5>Go Now and Request For You Requirement If Any :)</h5>
        <div><a href="Prove_blood">Blood Requirement</a></div>
        <div><a href="Prove_organ">Organ Requirement</a></div>
        <div><a href="Prove_money">Money Requirement</a></div>
        <div><a href="Prove_item">Item Requirement</a></div>
      @endif


    </main>
</div>



    @include('partials.script')

</body>
</html>