<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Models\donor;
use App\Models\recipient;
use App\Models\admininfo;
use App\Models\blockuser;

class SignUp extends Controller
{
    public function signupp(request $req)
    {
    	$req->validate([
       		'first_name'=>'required',
    		'last_name'=>'required',
    		'email'=>'required|email',
    		'password'=>'required|min:6',
    		'checkpassword'=>'required',
    		'occupation'=>'required',
    		// 'date'=>'required'
    		// 'month'=>'required'
    		// 'year'=>'required'
    		'gender'=>'required',
    		'user_type'=>'required',
    		'phone'=>'required',
    		'address'=>'required',
    		'cnic'=>'required',
    	]);

    	$donor_info = NULL;
    	$recipient_info = NULL;
    	$donor_info = DB::table('donor')->where('email',$req->email)->first();
    	$recipient_info = DB::table('recipient')->where('email',$req->email)->first();
        $admin_info= DB::table('admininfo')->where('email',$req->email)->first();

        $donor_cnic = DB::table('donor')->where('cnic',$req->cinc)->first();
        $recipient_cnic = DB::table('recipient')->where('cnic',$req->cnic)->first();

    	if($donor_info !=NULL || $recipient_info !=NULL || $admin_info !=NULL)
    		return "Email already exist";

        if($donor_cnic !=NULL || $recipient_cnic !=NULL)
            return "Cnic already exist";

    	if ($req->password !=$req->checkpassword)
    	return "password does not match";

        $blockedemail= DB::table('blockuser')->where('email',$req->email)->first();
        $blockedcnic= DB::table('blockuser')->where('cnic',$req->cnic)->first();
        if($blockedemail != NULL)
            return "Entered Email is blocked";
        if($blockedcnic != NULL)
            return "Entered Cnic is blocked";

    	if($req->user_type == 'Donor')
    	{
    		$data= new donor;
	    	$data->first_name=$req->first_name;
	    	$data->last_name=$req->last_name;
	    	$data->email=$req->email;
	    	$data->password=$req->password;
	    	$data->occupation=$req->occupation;
	    	$data->gender=$req->gender;
	    	$data->phone_no=$req->phone;
	    	$data->address=$req->address;
	    	$data->cnic=$req->cnic;
	    	$data->save();

	    	$req->session()->put('data',$req->input());
	    	$req->session()->put('user_type','donor');
	    	$req->session()->put('email',$req->email);
	    	 return redirect('donation');
	    	// return "hello";
    	}
    	else if($req->user_type == 'Recipient')
    	{
    		$data= new recipient;
	    	$data->first_name=$req->first_name;
	    	$data->last_name=$req->last_name;
	    	$data->email=$req->email;
	    	$data->password=$req->password;
	    	$data->occupation=$req->occupation;
	    	$data->gender=$req->gender;
	    	$data->phone_no=$req->phone;
	    	$data->address=$req->address;
	    	$data->cnic=$req->cnic;
	    	$data->save();

	    	$req->session()->put('data',$req->input());
	    	$req->session()->put('user_type','recipient');
	    	$req->session()->put('email',$req->email);
	    	return redirect('recipient');
    	}
    	   	

    	// return $req->input();
    } 


    public function login(request $req)
    {
    	$user_info = NULL;
        $user_info = DB::table('blockuser')->where('email',$req->email)->first();
        if($user_info != NULL)
        {
            return "Your Account is blocked";
        }

    	$user_info = DB::table('donor')->where('email',$req->email)->first();
    	if($user_info != NULL)
    	{
    		if($req->password == $user_info->password)
    		{
    			$req->session()->put('data',$req->input());
    			$req->session()->put('user_type','donor');
    			$req->session()->put('email',$req->email);
    			return redirect('donation');
    			// return "Welcome";
    		}
    	}

    	$user_info = DB::table('recipient')->where('email',$req->email)->first();
    	if($user_info != NULL)
    	{
    		if($req->password == $user_info->password)
    		{
    			$req->session()->put('data',$req->input());
    			$req->session()->put('user_type','recipient');
    			$req->session()->put('email',$req->email);

    			return view('recipient');
    		}
    	}


        $user_info = DB::table('admininfo')->where('email',$req->email)->first();
        if($user_info != NULL)
        {
            if($req->password == $user_info->password)
            {
                $req->session()->put('data',$req->input());
                $req->session()->put('user_type','admin');
                $req->session()->put('email',$req->email);
                return redirect('admin');
            }
        }

    	return "Incorrect Passowrd";	
    }

    public function donor()		
    {
    	if(session()->has('data') && session()->get('user_type') == 'donor')
		{
			//$donate = DB::table('recipient')->get();
			 // $donate= donations::get();
			return view('donation');
			// return view('donation');
		}
	    return redirect('login');
    }

    

    public function recipient()
    {
    	if(session()->has('data') && session()->get('user_type') == 'recipient')
		{
			return view('recipient');
		}
	    return redirect('login');
    }

    public function login_check()
    {
    	if(session()->has('data'))
		{
			if(session()->get('user_type') == 'donor')
				return redirect('donation');
			else if(session()->get('user_type') == 'recipient')
				return redirect('recipient');
            else if(session()->get('user_type') == 'admin')
                return redirect('admin');
		}
	    return view('login');
    }

    public function logout()
    {
    	if(session()->has('data'))
		{
			session()->pull('data');
            session()->pull('user_type');
            session()->pull('email');
		}
	    return redirect('login');
    }
}

?>