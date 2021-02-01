<!DOCTYPE html>
<html>
<head>
  <title>Donation History</title>
    @include('admin_partials.ahead')

    <style>

      h2{
        text-align: center;
      }
    </style>
</head>
<body>

    @include('admin_partials.navbody')
    <div class="container">
<main role="main">
      

      @if($panel == 'blood')
      <h2>Blood Donation History</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>Serial #</th>
              <th>Donor ID</th>
              <th>Recipient ID</th>
              <th>Report ID</th>
              <th>Quantity (ltr)</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1 ?>
            @foreach($blood_his as $d1)  
            <tr>
              <td><?php echo $x; $x++;?></td>
              <td>{{$d1->donor_id}}</td>
              <td>{{$d1->recipient_id}}</td>
              <td >{{$d1->donor_report_id}} </td>
              <td >{{$d1->quantity}} </td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      @endif


      @if($panel == 'organ')
      <h2>Organ Donation History</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>Serial #</th>
              <th>Donor ID</th>
              <th>Recipient ID</th>
              <th>Report ID</th>
              <th>Organ Name</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1 ?>
            @foreach($organ_his as $d1)  
            <tr>
              <td><?php echo $x; $x++;?></td>
              <td>{{$d1->donor_id}}</td>
              <td>{{$d1->recipient_id}}</td>
              <td >{{$d1->donor_report_id}} </td>
              <td >{{$d1->organ_name}} </td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      @endif
      

      @if($panel == 'items')
      <h2>Item & Supplies Donation History</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>Serial #</th>
              <th>Donor ID</th>
              <th>Recipient ID</th>
              <th>Item Name</th>
              <th>Quantity</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1 ?>
            @foreach($item_his as $d1)  
            <tr>
              <td><?php echo $x; $x++;?></td>
              <td>{{$d1->donor_id}}</td>
              <td>{{$d1->recipient_id}}</td>
              <th>{{$d1->item_name}}</th>
              <td >{{$d1->quantity}} </td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      @endif


      @if($panel == 'money')
      <h2>Money Donation History</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>Serial #</th>
              <th>Donor ID</th>
              <th>Recipient ID</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1 ?>
            @foreach($money_his as $d1)  
            <tr>
              <td><?php echo $x; $x++;?></td>
              <td>{{$d1->donor_id}}</td>
              <td>{{$d1->recipient_id}}</td>
              <td >{{$d1->amount}} </td>
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