<!DOCTYPE html>
<html>
<head>
	<title>Manage User</title>
	@include('admin_partials.ahead')
	@include('partials.head')

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
<main role="main" >
      

      @if($panel == 'donor')
      <h2>Donors</h2>
      <div class="table-responsive">
        <table class="table table-striped ">
          <thead class="thead-dark ">
            <tr>
              <th>ID#</th>
              <th>First_name</th>
              <th>Last_name</th>
              <th>Email</th>
              <th>Date_of_birth</th>
              <th>Gender</th>
              <th>Phone_no#</th>
              <th>Address</th>
              <th>Education</th>
              <th>Occupation</th>
              <th>Cnic</th>
              <th>Card_no</th>
              <th>Cvv</th>
              <th>Manage</th>
            </tr>
          </thead>
          <tbody>
            @foreach($All_donors as $d1)  
            <tr>
              <td>{{$d1->donor_id}} </td>
              <td>{{$d1->first_name}}</td>
              <td>{{$d1->last_name}}</td>
              <td>{{$d1->email}} </td>
              <td>{{$d1->date_of_birth}}</td>
              <td>{{$d1->gender}}</td>
              <td>{{$d1->phone_no}} </td>
              <td>{{$d1->address}}</td>
              <td>{{$d1->education}}</td>
              <td>{{$d1->occupation}} </td>
              <td>{{$d1->cnic}}</td>
              <td>{{$d1->card_no}}</td>
              <td>{{$d1->cvv}}</td>
              <td>
              	<form accept-charset="UTF-8" action="mnged_user" method="post">
              		@csrf
              		<input type="hidden" name="donor_id" value="<?php echo $d1->donor_id; ?>">
                  <input type="hidden" name="user_kind" value="donor">

       			          <button class="btn1" type="submit" name="handle" value="block"><span>Block</span></button>
                  <button class="btn1" type="submit" name="handle" value="remove"><span>Remove</span></button>
                 

       			 </form>
    		  </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      @elseif ($panel = 'recipient')
      <h2>Recipient</h2>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>ID#</th>
              <th>First_name</th>
              <th>Last_name</th>
              <th>Email</th>
              <th>Date_of_birth</th>
              <th>Gender</th>
              <th>Phone_no#</th>
              <th>Address</th>
              <th>Education</th>
              <th>Occupation</th>
              <th>Cnic</th>
              <th>Card_no</th>
              <th>Cvv</th>
              <th>Manage</th>
            </tr>
          </thead>
          <tbody>
            @foreach($All_recipient as $d1)  
            <tr>
              <td>{{$d1->recipient_id}} </td>
              <td>{{$d1->first_name}}</td>
              <td>{{$d1->last_name}}</td>
              <td>{{$d1->email}} </td>
              <td>{{$d1->date_of_birth}}</td>
              <td>{{$d1->gender}}</td>
              <td>{{$d1->phone_no}} </td>
              <td>{{$d1->address}}</td>
              <td>{{$d1->education}}</td>
              <td>{{$d1->occupation}} </td>
              <td>{{$d1->cnic}}</td>
              <td>{{$d1->card_no}}</td>
              <td>{{$d1->cvv}}</td>
              <td>
              	<form accept-charset="UTF-8" action="mnged_user" method="post">
              		@csrf
              		<input type="hidden" name="recipient_id" value="<?php echo $d1->recipient_id; ?>">
       			      <input type="hidden" name="user_kind" value="recipient">
                   <button class="btn1" type="submit" name="handle" value="remove"><span>Remove</span></button>
                    <button class="btn1" type="submit" name="handle" value="block"><span>Block</span></button>

       			    </form>
    		  </td>
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