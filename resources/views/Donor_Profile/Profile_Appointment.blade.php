<!DOCTYPE html>
<html>
<head>
  <title>Donation Appointments</title>
    @include('Donor_partials.dhead')

    <style>

      h2{
        text-align: center;
      }
    </style>
</head>
<body>

    @include('Donor_partials.navbody')
    <div class="container">
<main role="main">
      

      @if($blood_table != '[]')
      <h2>Blood Donation Appoinments</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>ID#</th>
              <th>Blood Group</th>
              <th>Location To Donate</th>
              <th>Request</th>
            </tr>
          </thead>
          <tbody>
            @foreach($blood_table as $d1)  
            <tr>
                <td >{{$d1->report_id}} </td>
                @if($d1->compatibility != NULL and $d1->compatibility > 2 )
                  <td>{{$d1->blood_group}}</td>
                  <td>Nearest Agha Khan Laboratory</td>
                  <td>Approved</td>
                @elseif($d1->compatibility != NULL and $d1->compatibility < 3)
                  <td>--</td>
                  <td>--</td>
                  <td>Rejected</td>
                @else
                  <td>--</td>
                  <td>Nearest Agha Khan Laboratory</td>
                  <td>Pending</td>
                @endif
            </tr>
            @endforeach

            
          </tbody>
        </table>
      </div>
      @endif


      @if ($organ_table != '[]')
      <br><br><br><h2>Organ Donation Appoinments</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>ID#</th>
              <th>Blood Group</th>
              <th>Organ Name</th>
              <th>Location To Donate</th>
              <th>Request</th>
            </tr>
          </thead>
          <tbody>
            @foreach($organ_table as $d1)  
            <tr>
              <td>{{$d1->report_id}} </td>
              @if($d1->compatibility != NULL)
              <td>{{$d1->blood_group}}</td>
              <td>{{$d1->organ_name}}</td>
              <td>Nearest Agha Khan Laboratory</td>
              <td>Approved</td>
              @elseif($d1->compatibility != NULL and $d1->compatibility < 3)
              <td>--</td>
              <td>--</td>
              <td>--</td>
              <td>Rejected</td>
              @else
              <td>--</td>
              <td>--</td>
              <td>Nearest Agha Khan Laboratory</td>
              <td>Pending</td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif


      @if ($item_table != '[]')
      <br><br><br><h2>Item & supplies Donation Appoinments</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>ID#</th>
              <th>Location To Donate</th>
              <th>Request</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1;?>
            @foreach($item_table as $d1)  
            <tr>
              @if($d1->item_name != NULL)
              <td><?php echo $x; $x++;?></td>
              <td>Nearest Branch of Our Company</td>
              <td>Approved</td>
              @else
              <td><?php echo $x; $x++;?></td>
              <td>Nearest Branch of Our Company</td>
              <td>Pending</td>
              @endif
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      @endif

      @if($item_table == '[]' and $blood_table == '[]' and $organ_table == '[]')
        <h5>Go Now and Request For You Requirement If Any :)</h5>
        <div><a href="blood_donation">Blood Requirement</a></div>
        <div><a href="organ_donation">Organ Requirement</a></div>
        <div><a href="money_donation">Money Requirement</a></div>
        <div><a href="item_donation">Item Requirement</a></div>
      @endif


    </main>
</div>



    @include('partials.script')

</body>
</html>