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
      
      <h2>Blocked Users</h2>
      <div class="table-responsive">
        <table class="table table-striped ">
          <thead class="thead-dark ">
            <tr>
              <th>ID#</th>
              <th>Email</th>
              <th>Cnic</th>
              <th>Manage</th>
            </tr>
          </thead>
          <tbody>
            @foreach($blockeduser as $d1)  
            <tr>
              <td>{{$d1->blockeduser_id}} </td>
              <td>{{$d1->email}} </td>
              <td>{{$d1->cnic}}</td>
              <td>
              	<form accept-charset="UTF-8" action="Removeblock_user" method="post">
              		@csrf
              		<input type="hidden" name="blockeduser_id" value="<?php echo $d1->blockeduser_id; ?>">
       			       <button class="btn1" type="submit" name="submit"><span>Remove</span></button>
       			    </form>
    		     </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
 </main>
</div>



@include('partials.script')


</body>
</html>