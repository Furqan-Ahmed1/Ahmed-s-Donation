<!DOCTYPE html>
<html>
<head>
    <title>Personal Information</title>
    
@include('Recipient_partials.rhead')

    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/donor_sidebar.css') }}" >

    <style>
      .btn1{
          display: block;
      background-color: #000000;
      width: 80px;
      height: 40px;
      line-height: 10px;
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
	@include('Recipient_partials.navbody')
	
      @include('Recipient_Profile.settings_sidebar')

   <div class="main">

      <form accept-charset="UTF-8" action="Rupdated_cardinfo" method="post">
      @csrf
   	    <h6> Update Card Information</h6>
        <input class="span3" name="card_no" placeholder="Enter card no" type="text" required><br>
        <input class="span3" name="cvv" placeholder="Enter cvv" type="text" required>
        <br><br>

        <button class="btn1" type="submit" name="button"><span>save</span></button><br>
      </form>

   </div>

@include('partials.script')
</body>
</html>