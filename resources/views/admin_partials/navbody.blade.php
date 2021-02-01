<div class="navbar navbar-expand-md navbar-dark bg-dark mb-4" role="navigation">
    <a class="navbar-brand" href="admin"><img width=60 height=70 src="{{ asset('asset/image/Latest_logo.png') }}">
    Ahmed Foundation</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="admin">Home</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="http://fontenele.github.io/bootstrap-navbar-dropdowns/" target="_blank">Github</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li> -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage Users</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown1">
                    <a class="dropdown-item" href="mng_donor">Donor</a>
                    <a class="dropdown-item" href="mng_recipient">Recipient</a>
                    <a class="dropdown-item" href="mng_blockuser">Block Users</a>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage Appointments</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown1">
                    <a class="dropdown-item" href="mng_app_blood">Blood</a>
                    <a class="dropdown-item" href="mng_app_organ">Organ</a>
                    <a class="dropdown-item" href="mng_app_items">Item&supplies</a>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage Requests</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown1">
                    <a class="dropdown-item" href="mng_req_blood">Blood</a>
                    <a class="dropdown-item" href="mng_req_items">Item&supplies</a>
                    <a class="dropdown-item" href="mng_req_money">Money</a>
                    <a class="dropdown-item" href="mng_req_organ">Organ</a>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Donation History</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown1">
                    <a class="dropdown-item" href="view_blood_history">Blood</a>
                    <a class="dropdown-item" href="view_items_history">Item&supplies</a>
                    <a class="dropdown-item" href="view_money_history">Money</a>
                    <a class="dropdown-item" href="view_organ_history">Organ</a>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Inventory</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown1">
                    <a class="dropdown-item" href="view_blood_inv">Blood</a>
                    <a class="dropdown-item" href="view_items_inv">Item&supplies</a>
                    <a class="dropdown-item" href="view_money_inv">Money</a>
                    <a class="dropdown-item" href="view_organ_inv">Organ</a>
                </ul>
            </li>

        </ul>
   
            
             <a href="logout"><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Sign out</button></a>
       
    </div>
</div>