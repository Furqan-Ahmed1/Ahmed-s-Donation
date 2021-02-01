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
      

      @if($blood != '[]')
      <h2>Blood Donation History</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>ID#</th>
              <th>Donor Blood Group</th>
              <th>Quatity Recieved(ltr)</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1; ?>
            @foreach($blood as $d1)  
            <tr>
                <td ><?php echo $x; $x++; ?> </td>
                  <td>{{$d1->blood_group}}</td>
                  <td>{{$d1->quantity}}</td>
            </tr>
            @endforeach

            
          </tbody>
        </table>
      </div>
      @endif


      @if ($organ != '[]')
      <br><br><br><h2>Organ Donation History</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>ID#</th>
              <th>Donor Blood Group</th>
              <th>Organ Recieved</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1; ?>
            @foreach($organ as $d1)  
            <tr>
                  <td ><?php echo $x; $x++; ?> </td>
                  <td>{{$d1->blood_group}}</td>
                  <td>{{$d1->organ_name}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif


      @if ($item != '[]')
      <br><br><br><h2>Item & supplies Donation History</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>ID#</th>
              <th>Item Name</th>
              <th>Quantity Recieved</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1; ?>
            @foreach($item as $d1)  
            <tr>
              <td ><?php echo $x; $x++; ?> </td>
                  <td>{{$d1->item_name}}</td>
                  <td>{{$d1->quantity}}</td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      @endif

      @if ($money != '[]')
      <br><br><br><h2>Money Donation History</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>ID#</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1; ?>
            @foreach($money as $d1)  
            <tr>
              <td ><?php echo $x; $x++; ?> </td>
                  <td>{{$d1->amount}}</td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      @endif


    </main>
</div>



    @include('partials.script')

</body>
</html>