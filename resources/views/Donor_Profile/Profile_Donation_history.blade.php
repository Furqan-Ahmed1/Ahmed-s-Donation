<!DOCTYPE html>
<html>
<head>
  <title>Donation History</title>
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
      

      @if($blood != '[]')
      <h2>Blood Donation History</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>Recipient ID</th>
              <th>Report ID</th>
              <th>Quantity (ltr)</th>
              <th>Recipient Name</th>
              <th>Recipient Email</th>
              <th>Phone No.</th>
            </tr>
          </thead>
          <tbody>
            @foreach($blood as $d1)  
            <tr>
              <td>{{$d1->recipient_id}}</td>
              <td >{{$d1->donor_report_id}} </td>
              <td >{{$d1->quantity}} </td>
              <td >{{$d1->first_name.' '.$d1->last_name}}</td>
              <td >{{$d1->email}} </td>
              <td >{{$d1->phone_no}} </td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      @endif


      @if($organ != '[]')
      <h2>Organ Donation History</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>Recipient ID</th>
              <th>Report ID</th>
              <th>Organ Name</th>
              <th>Recipient Name</th>
              <th>Recipient Email</th>
              <th>Phone No.</th>
            </tr>
          </thead>
          <tbody>
            @foreach($organ as $d1)  
            <tr>
              <td>{{$d1->recipient_id}}</td>
              <td >{{$d1->donor_report_id}} </td>
              <td >{{$d1->organ_name}} </td>
              <td >{{$d1->first_name.' '.$d1->last_name}}</td>
              <td >{{$d1->email}} </td>
              <td >{{$d1->phone_no}} </td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      @endif
      

      @if($item != '[]')
      <h2>Item & Supplies Donation History</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>Recipient ID</th>
              <th>Item Name</th>
              <th>Quantity</th>
              <th>Recipient Name</th>
              <th>Recipient Email</th>
              <th>Phone No.</th>
            </tr>
          </thead>
          <tbody>
            @foreach($item as $d1)  
            <tr>
              <td>{{$d1->recipient_id}}</td>
              <th>{{$d1->item_name}}</th>
              <td >{{$d1->quantity}} </td>
              <td >{{$d1->first_name.' '.$d1->last_name}}</td>
              <td >{{$d1->email}} </td>
              <td >{{$d1->phone_no}} </td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      @endif


      @if($money != '[]')
      <h2>Money Donation History</h2><br>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>Recipient ID</th>
              <th>Amount</th>
              <th>Recipient Name</th>
              <th>Recipient Email</th>
              <th>Phone No.</th>
            </tr>
          </thead>
          <tbody>
            @foreach($money as $d1)  
            <tr>
              <td>{{$d1->recipient_id}}</td>
              <td >{{$d1->amount}} </td>
              <td >{{$d1->first_name.' '.$d1->last_name}}</td>
              <td >{{$d1->email}} </td>
              <td >{{$d1->phone_no}} </td>
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