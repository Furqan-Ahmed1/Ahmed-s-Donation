<div class="navbar navbar-expand-md navbar-dark bg-dark mb-4" role="navigation">
    <a class="navbar-brand" href="donation"><img width=60 height=70 src="{{ asset('asset/image/Latest_logo.png') }}">Ahmed Foundation</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link" href="donation">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Donations</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown1">
                    <a class="dropdown-item" href="money_donation">Charity Funds</a>
                    <a class="dropdown-item" href="blood_donation">Blood donation</a>
                    <a class="dropdown-item" href="organ_donation">Organ donation</a>
                    <a class="dropdown-item" href="item_donation">Item&supplies donation</a>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profile</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown2">
                    <a class="dropdown-item" href="D_Profile_Appointment">Appointments</a>
                    <a class="dropdown-item" href="D_Profile_Donation_history">Donation_history</a>
                    <a class="dropdown-item" href="D_Profile_Settings">Settings</a>
                    
                </ul>
            </li>

        </ul>
   
            
            <a href="logout"><button class="btn btn-outline-success my-2 my-sm-0" type="submit"> Sign out</button></a>
       
    </div>
</div>