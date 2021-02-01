<!DOCTYPE html>
<html>
<head>
  <title>Item & Supplies Donation</title>
    @include('Donor_partials.dhead')

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
      

    .btn2{
      margin:auto;
    background: #000000;
    -webkit-transition-duration: 0.5s;
    -webkit-transition-timing-function: linear;
    box-shadow:0px 0 0 #A9A9A9  inset;
  }

  .btn2:hover{
      -webkit-box-shadow: -300px 0 0 #A9A9A9 inset;
  }

  button {
  
    display:block;
  position: absolute;
    top: 50%;
  cursor: pointer;
  position: relative;
  padding: 1.5rem 3rem;
  border-radius: 3.75rem;
  line-height: 1rem;
  font-size: 1rem;
  font-weight: 1000;
  }

  .btn2 span {
    color: transparent;
    background-image: linear-gradient(0deg, #ffffe4 0%, #ffffe4 100%);
    -webkit-background-clip: text;
    background-clip: text;
    filter: drop-shadow(0 2px 2px hsla(290, 100%, 20%, 1));
  }

  .btn2::before {
    content: "";
    display: block;
    height: 0.25rem;
    position: absolute;
    top: 0.5rem;
    left: 50%;
    transform: translateX(-50%);
    width: calc(100% - 7.5rem);
    background: #fff;
    border-radius: 100%;
    
    opacity: 0.7;
    background-image: linear-gradient(-270deg, rgba(255,255,255,0.00) 0%, #FFFFFF 20%, #FFFFFF 80%, rgba(255,255,255,0.00) 100%);
  }

  .btn2::after {
    content: "";
    display: block;
    height: 0.25rem;
    position: absolute;
    bottom: 0.75rem;
    left: 50%;
    transform: translateX(-50%);
    width: calc(100% - 7.5rem);
    background: #fff;
    border-radius: 100%;
    
    filter: blur(1px);
    opacity: 0.05;
    background-image: linear-gradient(-270deg, rgba(255,255,255,0.00) 0%, #FFFFFF 20%, #FFFFFF 80%, rgba(255,255,255,0.00) 100%);
  }
    </style>
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css')}}" rel="stylesheet">

</head>
<body>



@include('Donor_partials.navbody')
<div class="container">

<main role="main">
        <h2>Item & Supplies Donation</h2>

      <div>
        <form accept-charset="UTF-8" action="set_isapp" method="post">
          @csrf
          <button class="btn2" type="submit" name="donating" value="sys_way">
            <!-- <span><a href="payment_area">Donate System way</a></span> -->
            <span>Donate System way</span>
          </button><br>
          <button class="btn2" type="submit" name="donating" value="spec_way">
            <!-- <span><a href="payment_area">Donate to specfic person</a></span> -->
            <span>Donate to specfic person</span>
          </button>
        </form>
      </div>
     
    

      <h2>PEOPLE WHO NEED YOUR HELP!</h2>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark ">
            <tr>
              <th>Request ID</th>
              <th>Recipient ID</th>
              <th>Item Name</th>
              <th>Quantity Needed</th>
              <th>Electricity Bill</th>
              <th>Gas Bill</th>
              <th>Finantcial Statement</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1; ?>
            @foreach($reci_table as $d1)  
            <tr>
              <td><?php echo $x; $x++; ?></td>
              <td>{{$d1->recipient_id}} </td>
              <td>{{$d1->Item_Name}}</td>
              <td>{{$d1->Quantity}}</td>
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