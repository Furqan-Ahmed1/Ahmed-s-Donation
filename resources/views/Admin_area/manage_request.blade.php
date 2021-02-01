<!DOCTYPE html>
<html>
<head>
	<title>Manage Request</title>
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
      <h2>Blood Donation Request</h2>
      <div class="table-responsive">
        <table class="table table-striped ">
          <thead class="thead-dark ">
            <tr>
              <th>Recipient ID</th>
              <th>Blood Group</th>
              <th>Quantity(ltrs)</th>
              <th>Medical Report</th>
              <th>Conclusion rating</th>
              <th>Apporval</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pblood_table as $d1)  
            <tr>
              <td>{{$d1->recipient_id}} </td>
              <td>{{$d1->Blood_Group}}</td>
              <td>{{$d1->Quantity_ltr}}</td>
              <form accept-charset="UTF-8" action="viewProof" method="post">
                @csrf
              <td>
                  <input type="hidden" name="proof" value="<?php echo $d1->Medical_Report; ?>">
                  <button class="btn1" type="submit" name="view"><span>View</span></button>
              </td>
              </form>
              <td>{{$d1->Conclusion_rating}}</td>
              	<form accept-charset="UTF-8" action="mnged_breq" method="post">
              		@csrf
              <td>
              		
                  <input type="hidden" name="recipient_id" value="<?php echo $d1->recipient_id; ?>">
       			      <button class="btn1" type="submit" name="approval" value="approve"><span>Approve</span></button>
       			      <button class="btn1" type="submit" name="approval" value="reject"><span>Reject</span></button>

    		      </td>
       			    </form>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      @elseif ($panel == 'organ')
      <h2>Organ Donation Request</h2>
      <div class="table-responsive">
        <table class="table table-striped ">
          <thead class="thead-dark ">
            <tr>
              <th>Recipient ID</th>
              <th>Blood Group</th>
              <th>Quantity(ltrs)</th>
              <th>Medical Report</th>
              <th>Conclusion rating</th>
              <th>Apporval</th>
            </tr>
          </thead>
          <tbody>
            @foreach($porgan_table as $d1)  
            <tr>
              <td>{{$d1->recipient_id}} </td>
              <td>{{$d1->Blood_Group}}</td>
              <td>{{$d1->Organ_Name}}</td>
              <form accept-charset="UTF-8" action="viewProof" method="post">
                @csrf
              <td>
                  <input type="hidden" name="proof" value="<?php echo $d1->Medical_Report; ?>">
                  <button class="btn1" type="submit" name="view"><span>View</span></button>
              </td>
              </form>
              <td>{{$d1->Conclusion_rating}}</td>
              <form accept-charset="UTF-8" action="mnged_oreq" method="post">
                  @csrf
              <td>
                  <input type="hidden" name="recipient_id" value="<?php echo $d1->recipient_id; ?>">
                  <button class="btn1" type="submit" name="approval" value="approve"><span>Approve</span></button>
                  <button class="btn1" type="submit" name="approval" value="reject"><span>Reject</span></button>

              </td>
                </form>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>




      @elseif ($panel == 'items')
      <h2>Item & Supplies Donation Request</h2>
      <div class="table-responsive">
        <table class="table table-striped ">
          <thead class="thead-dark ">
            <tr>
              <th>Recipient ID</th>
              <th>Item Name</th>
              <th>Quantity</th>
              <th>Electric_Bill</th>
              <th>Gas_Bill</th>
              <th>Financial_statement</th>
              <th>Conclusion_rating</th>
              <th>Apporval</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pitems_table as $d1)  
            <tr>
              <td>{{$d1->recipient_id}} </td>
              <td>{{$d1->Item_Name}}</td>
              <td>{{$d1->Quantity}} </td>
              <form accept-charset="UTF-8" action="viewProof" method="post">
                @csrf
              <td>
                  <input type="hidden" name="proof" value="<?php echo $d1->Electric_Bill; ?>">
                  <button class="btn1" type="submit" name="view"><span>View</span></button>
              </td>
              </form>
              <form accept-charset="UTF-8" action="viewProof" method="post">
                @csrf
              <td>
                  <input type="hidden" name="proof" value="<?php echo $d1->Gas_Bill; ?>">
                  <button class="btn1" type="submit" name="view"><span>View</span></button>
              </td>
              </form>              
              <form accept-charset="UTF-8" action="viewProof" method="post">
                @csrf
              <td>
                  <input type="hidden" name="proof" value="<?php echo $d1->Finantial_statement; ?>">
                  <button class="btn1" type="submit" name="view"><span>View</span></button>
              </td>
              </form>
              <td>{{$d1->Conclusion_rating}} </td>
              <td>
              <form accept-charset="UTF-8" action="mnged_ireq" method="post">
                  @csrf
                  <input type="hidden" name="recipient_id" value="<?php echo $d1->recipient_id; ?>">
                  <button class="btn1" type="submit" name="approval" value="approve"><span>Approve</span></button>
                  <button class="btn1" type="submit" name="approval" value="reject"><span>Reject</span></button>

              </td>
                </form>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>


      @elseif ($panel == 'money')
      <h2>Money Donation Request</h2>
      <div class="table-responsive">
        <table class="table table-striped ">
          <thead class="thead-dark ">
            <tr>
              <th>Recipient ID</th>
              <th>Amount</th>
              <th>Electric_Bill</th>
              <th>Gas_Bill</th>
              <th>Financial_statement</th>
              <th>Conclusion_rating</th>
              <th>Apporval</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pmoney_table as $d1)  
            <tr>
              <td>{{$d1->recipient_id}} </td>
              <td>{{$d1->Amount}}</td>
              <form accept-charset="UTF-8" action="viewProof" method="post">
                @csrf
              <td>
                  <input type="hidden" name="proof" value="<?php echo $d1->Electric_Bill; ?>">
                  <button class="btn1" type="submit" name="view"><span>View</span></button>
              </td>
              </form>
              <form accept-charset="UTF-8" action="viewProof" method="post">
                @csrf
              <td>
                  <input type="hidden" name="proof" value="<?php echo $d1->Gas_Bill; ?>">
                  <button class="btn1" type="submit" name="view"><span>View</span></button>
              </td>
              </form>              
              <form accept-charset="UTF-8" action="viewProof" method="post">
                @csrf
              <td>
                  <input type="hidden" name="proof" value="<?php echo $d1->Finantial_statement; ?>">
                  <button class="btn1" type="submit" name="view"><span>View</span></button>
              </td>
              </form>
              <td>{{$d1->Conclusion_rating}} </td>
              <td>
              <form accept-charset="UTF-8" action="mnged_mreq" method="post">
                  @csrf
                  <input type="hidden" name="recipient_id" value="<?php echo $d1->recipient_id; ?>">
                  <button class="btn1" type="submit" name="approval" value="approve"><span>Approve</span></button>
                  <button class="btn1" type="submit" name="approval" value="reject"><span>Reject</span></button>

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