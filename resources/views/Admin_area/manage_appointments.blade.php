<!DOCTYPE html>
<html>
<head>
	<title>Manage Appointments</title>
	@include('admin_partials.ahead')
	@include('partials.head')

  <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>

	<style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      h2{
      	text-align: center;
      }

      
      .btn1{
	      	display: block;
			background-color: #696969;
			width: 80px;
			height: 40px;
			line-height: 10px;
			margin: auto;
			color: #fff;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			cursor: pointer;
			overflow: hidden;
			border-radius: 5px;
			box-shadow: 0 0 20px 0 rgba(0,0,0,.3);
      }
      span {
			width: 72%;
			line-height: inherit;
			font-size: 13px;
			text-transform: uppercase;
			}
		  

      .btn1:hover{
       -webkit-box-shadow: -300px 0 0 #1b1e23 inset;
       }
       
  </style>


</head>
<body>

@include('admin_partials.navbody')
<div class="container">
<main role="main">
      

      @if($panel == 'blood')
      <h2>Blood Donation Appointment</h2>
      <div class="table-responsive">
        <table class="table table-striped ">
          <thead class="thead-dark ">
            <tr>
              <th>ID#</th>
              <th>Donor ID</th>
              <th>Recipient ID</th>
              <th>Report Type</th>
              <th>Blood Group</th>
              <th>Quantity</th>
              <th>Compatibility</th>
              <th>Apporval</th>
            </tr>
          </thead>
          <tbody>
            @foreach($blood_table as $d1)  
            <tr>
              <td>{{$d1->report_id}} </td>
              <td>{{$d1->donor_id}}</td>
              <td>{{$d1->recipient_id}}</td>
              <td>{{$d1->report_type}}</td>
              	<form accept-charset="UTF-8" action="mnged_bapp" method="post">
              		@csrf
              <td><select name="blood_group"  class="form-control item" id="exampleFormControlSelect1" required>
                  <option disabled selected value> -- select blood group -- </option>
                  <option>AB+</option>
                  <option>AB-</option>
                  <option>A+</option>
                  <option>A-</option>
                  <option>B+</option>
                  <option>B-</option>
                  <option>O+</option>
                  <option>O-</option> </td>
              <td><input type="text" name="quantity" class="form-control item" placeholder="in ltrs" required> </td>
              <td><select name="compatibility" class="form-control item" required>
                  <option disabled selected value> -- select compatibility value -- </option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
              </td>
              <td>
              		<input type="hidden" name="report_id" value="<?php echo $d1->report_id; ?>">
                  <input type="hidden" name="donor_id" value="<?php echo $d1->donor_id; ?>">
                  <input type="hidden" name="recipient_id" value="<?php echo $d1->recipient_id; ?>">
       			      <button class="btn1" type="submit" name="approval" value="approve"><span>Approve</span></button>

    		      </td>
       			    </form>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      @elseif ($panel == 'organ')
      <h2>Organ Donation Appointment</h2>
      <div class="table-responsive">
        <table class="table table-striped ">
          <thead class="thead-dark ">
            <tr>
              <th>ID#</th>
              <th>Donor ID</th>
              <th>Recipient ID</th>
              <th>Report Type</th>
              <th>Blood Group</th>
              <th>Organ Name</th>
              <th>Compatibility</th>
              <th>Manage</th>
            </tr>
          </thead>
          <tbody>
            @foreach($organ_table as $d1)  
            <tr>
              <td>{{$d1->report_id}} </td>
              <td>{{$d1->donor_id}}</td>
              <td>{{$d1->recipient_id}}</td>
              <td>{{$d1->report_type}}</td>
              <form accept-charset="UTF-8" action="mnged_oapp" method="post">
                  @csrf
              <td><select name="blood_group" class="form-control item" id="exampleFormControlSelect1" required>
                  <option disabled selected value> -- select blood group -- </option>
                  <option>AB+</option>
                  <option>AB-</option>
                  <option>A+</option>
                  <option>A-</option>
                  <option>B+</option>
                  <option>B-</option>
                  <option>O+</option>
                  <option>O-</option> </td>
              <td><input type="text" name="organ_name" class="form-control item" placeholder="eg. kidney" required> </td>
              <td><select name="compatibility" class="form-control item" required>
                  <option disabled selected value> -- select compatibility value -- </option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
              </td>
              <td>
                  <input type="hidden" name="report_id" value="<?php echo $d1->report_id; ?>">
                  <input type="hidden" name="donor_id" value="<?php echo $d1->donor_id; ?>">
                  <input type="hidden" name="recipient_id" value="<?php echo $d1->recipient_id; ?>">
                  <button class="btn1" type="submit" name="approval" value="approve"><span>Approve</span></button>

              </td>
                </form>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>




      @elseif ($panel == 'items')
      <h2>Item & Supplies Donation Appointment</h2>
      <div class="table-responsive">
        <table class="table table-striped ">
          <thead class="thead-dark ">
            <tr>
              <th>Donor ID</th>
              <th>Recipient ID</th>
              <th>Item Name</th>
              <th>Quantity</th>
              <th>Condition</th>
              <th>Manage</th>
            </tr>
          </thead>
          <tbody>
            @foreach($items_table as $d1)  
            <tr>
              <td>{{$d1->donor_id}}</td>
              <td>{{$d1->recipient_id}}</td>
              <form accept-charset="UTF-8" action="mnged_iapp" method="post">
                  @csrf
              <td><input type="text" name="item_name" placeholder="eg. medicines" required> </td>
              <td><input type="text" name="quantity" placeholder="in numbers" required> </td>
              <td><select name="condition" class="form-control item" required>
                  <option disabled selected value> -- select condition value -- </option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
              </td>
              <td>
                  <input type="hidden" name="donor_id" value="<?php echo $d1->donor_id; ?>">
                  <input type="hidden" name="recipient_id" value="<?php echo $d1->recipient_id; ?>">
                  <button class="btn1" type="submit" name="approval" value="approve"><span>Approve</span></button>

              </td>
                </form>
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