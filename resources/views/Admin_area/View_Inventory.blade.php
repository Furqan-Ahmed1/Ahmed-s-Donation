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
      <h2>Blood Donation Inventory</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>Serial #</th>
              <th>Donor ID</th>
              <th>Report ID</th>
              <th>Blood Group</th>
              <th>Quantity (ltr)</th>
              <th>Compatibility</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1 ?>
            @foreach($blood_inv as $d1)  
            <tr>
              <td><?php echo $x; $x++;?></td>
              <td>{{$d1->donor_id}}</td>
              <td >{{$d1->report_id}} </td>
              <td>{{$d1->blood_group}}</td>
              <td >{{$d1->quantity}} </td>
              <td >{{$d1->compatibility}} </td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      @endif


      @if($panel == 'organ')
      <h2>Organ Donation Inventory</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>Serial #</th>
              <th>Donor ID</th>
              <th>Report ID</th>
              <th>Blood Group</th>
              <th>Organ Name</th>
              <th>Compatibility</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1 ?>
            @foreach($organ_inv as $d1)  
            <tr>
              <td><?php echo $x; $x++;?></td>
              <td>{{$d1->donor_id}}</td>
              <td>{{$d1->report_id}} </td>
              <td>{{$d1->blood_group}}</td>
              <td>{{$d1->organ_name}} </td>
              <td>{{$d1->compatibility}} </td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      @endif
      

      @if($panel == 'items')
      <h2>Item & Supplies Donation Inventory</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>Serial #</th>
              <th>Donor ID</th>
              <th>Item Name</th>
              <th>Quantity</th>
              <th>Condition</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1 ?>
            @foreach($item_inv as $d1)  
            <tr>
              <td><?php echo $x; $x++;?></td>
              <td>{{$d1->donor_id}}</td>
              <th>{{$d1->item_name}}</th>
              <td >{{$d1->quantity}} </td>
              <td >{{$d1->condition}} </td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      @endif


      @if($panel == 'money')
      <h2>Money Donation Inventory</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>Serial #</th>
              <th>Donor ID</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1 ?>
            @foreach($money_inv as $d1)  
            <tr>
              <td><?php echo $x; $x++;?></td>
              <td>{{$d1->donor_id}}</td>
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