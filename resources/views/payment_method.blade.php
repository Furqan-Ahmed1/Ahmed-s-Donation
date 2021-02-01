<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    
    <link rel="stylesheet" type="text/css" href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
@include('Donor_partials.dhead')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
 
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/paymentMethod2.css') }}" >

</head>
<body>

 @include('Donor_partials.navbody')  
 


<div class="card mt-50 mb-50">

    <div class="card-title mx-auto"> Donate Money </div>
    <div class="nav">
        <ul class="mx-auto">
            <li class="active"><a href="donate_money">Payment</a></li>
        </ul>
    </div>
    <form accept-charset="UTF-8" action="donate_now" method="post"> 
        @csrf
        @if ($card_noo->card_no != NULL)
     <span id="card-header">Saved card:</span>
        <div class="row row-1">
            <div class="col-2"><img class="img-fluid" src="https://img.icons8.com/color/48/000000/mastercard-logo.png" /></div>
            <div class="col-7">{{$card_noo->card_no}} </div>
            <div class="col-3 d-flex justify-content-center"> <a href="remove_card">Remove card</a> </div>

        </div> 
        @endif
        @if ($card_noo->card_no == NULL)
        <span id="card-header">Add new card:</span>
        
        <div class="row three">
            <div class="col-7">
                <div class="row-1">
                    <div class="row row-2"> <span id="card-inner">Card number</span> </div>
                    <div class="row row-2"> <input type="text" name="card_no" placeholder="xxxx" required> </div>
                </div>
            </div>
                    <div class="col-2 "> <input type="text" name="cvv" placeholder="CVV" required> </div>
            <!-- <div class="col-2"> <input type="text" nameplaceholder="Exp. date"> </div> -->
            </div>
        @endif
        @if ($donation_way == 'spec_way')
        <div class="row-1">
            <div class="row row-2"> <span id="card-inner">Recipient ID</span> </div>
            <div class="row row-2"> <input type="text" name="reciever" placeholder="eg: 100" required> </div>
            <input type="hidden" name="donation_way" value="spec_way">
        </div>
        @endif
        <div class="row-1">
            <div class="row row-2"> <span id="card-inner">Amount</span> </div>
            <div class="row row-2"> <input type="text" name="amount" placeholder="eg: 1000" required> </div>
        </div>
        @if ($donation_way == 'sys_way')
        <input type="hidden" name="donation_way" value="sys_way">
        @endif
        <br><br>
        <button class="btn d-flex mx-auto" type="submit" name="submit" value="donated"><b>Donate</b></button>
    </form>
</div>


@include('partials.script')
</body>
</html>