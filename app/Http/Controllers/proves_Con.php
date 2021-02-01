<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Models\recipient;
use App\Models\Prove_for_blood_req;
use App\Models\Prove_for_organ_req;
use App\Models\Prove_for_money_req;
use App\Models\Prove_for_items_req;
use App\Models\medicalreport;
use App\Models\bloodhistory;
use App\Models\organhistory;
use App\Models\moneyhistory;
use App\Models\itemhistory;


$GLOBALS['Priorityvalue'] =0;


class Proves_Con extends Controller
{

    public function R_Profile_Requests()
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {
            $id_check = DB::table('recipient')->where('email',session()->get('email'))->first();

            $blood_req = DB::table('prove_for_blood')->where('recipient_id',$id_check->recipient_id)->get();

            $organ_req = DB::table('prove_for_organ')->where('recipient_id',$id_check->recipient_id)->get();

            $item_req = DB::table('prove_for_items')->where('recipient_id',$id_check->recipient_id)->get();

            $money_req = DB::table('prove_for_money')->where('recipient_id',$id_check->recipient_id)->get();

            return view('Recipient_profile.Profile_Request')->with('blood_req',$blood_req)->with('organ_req',$organ_req)->with('item_req',$item_req)->with('money_req',$money_req);

        }
        return redirect('login');
    }

    public function R_Profile_Donation_history()
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {
            $own_id = DB::table('recipient')->where('email',session()->get('email'))->first();

            $blood = DB::table('bloodhistory')->join('medicalreport','bloodhistory.donor_report_id','=','medicalreport.report_id')->where([['recipient_id',$own_id->recipient_id],['quantity','<>',0]])->get(); //recipient bloodhistory tables are joined

            $organ = DB::table('organhistory')->join('medicalreport','organhistory.donor_report_id','=','medicalreport.report_id')->where([['recipient_id',$own_id->recipient_id],['organ_name','<>',NULL]])->get(); //recipient organhistory tables are joined

            $item = DB::table('itemhistory')->where([['recipient_id',$own_id->recipient_id],['item_name','<>',NULL]])->get(); //recipient itemhistory  tables are joined

            $money = DB::table('moneyhistory')->where([['recipient_id',$own_id->recipient_id],['amount','<>',0]])->get(); //recipient moneyhistory  tables are joined

            return view('Recipient_profile.Donation_history')->with('blood',$blood)->with('organ',$organ)->with('item',$item)->with('money',$money);
        }
        return redirect('login');
    }


    public function R_Profile_Settings()
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {
            $recipient_info = DB::table('recipient')->where('email',session()->get('email'))->first();

              return view('Recipient_Profile.Profile_Settings')->with('recipient_info',$recipient_info);
        }
        return redirect('login');
    }

    public function Rchange_Pinfo()
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {
            $recipient_info = DB::table('recipient')->where('email',session()->get('email'))->first();

              return view('Recipient_Profile.change_profile')->with('recipient_info',$recipient_info);
        }
        return redirect('login');
    }

    public function change_rinfo(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {
            $change_temp = DB::table('recipient')->where('email',session()->get('email'));
            if( $req->first_name != NULL)
            {
                $change_temp->update(['first_name'=> $req->first_name]);
            }
            if( $req->last_name != NULL)
            {
                $change_temp->update(['last_name'=> $req->last_name]);
            }
            if( $req->occupation != NULL)
            {
                $change_temp->update(['occupation'=> $req->occupation]);
            }
            if( $req->education != NULL)
            {
                $change_temp->update(['education'=> $req->education]);
            }
            if( $req->date != NULL && $req->month != NULL && $req->year != NULL)
            {
                $change_temp->update(['date_of_birth'=> $req->date.'-'.$req->month.'-'.$req->year]);
            }
            if( $req->gender != NULL)
            {
                $change_temp->update(['gender'=> $req->gender]);
            }
            if( $req->phone != NULL)
            {
                $change_temp->update(['phone'=> $req->phone]);
            }
            if( $req->address != NULL)
            {
                $change_temp->update(['address'=> $req->address]);
            }
            if( $req->email != NULL)
            {
                $change_temp->update(['email'=> $req->email]);
                return redirect('logout');
            }

            $recipient_info = DB::table('recipient')->where('email',session()->get('email'))->first();
            return view('Recipient_Profile.Profile_Settings')->with('recipient_info',$recipient_info);
        }
        return redirect('login');
    }

    public function Rupdate_Pcardinfo()
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {
            return view('Recipient_Profile.update_cardinfo');
        }
        return redirect('login');
    }

    public function Rupdated_cardinfo(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {
            $req->validate([
                'card_no'=>'required',
                'cvv'=>'required',
             ]);

            $table_info = DB::table('recipient')->where('email',session()->get('email'));

            $table_info->update(['card_no'=>$req->card_no]);
            $table_info->update(['cvv'=>$req->cvv]);

            $recipient_info = DB::table('recipient')->where('email',session()->get('email'))->first();
            return view('Recipient_Profile.Profile_Settings')->with('recipient_info',$recipient_info);
        }
        return redirect('login');
    }

    public function Rchange_pass()
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {
            return view('Recipient_Profile.change_password');
        }
        return redirect('login');
    }

    public function change_rpassword(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {
            $req->validate([
                'old_password'=>'required',
                'newpassword'=>'required|min:6',
                'checknewpassword'=>'required|min:6',
            ]);
            $oldpass = DB::table('recipient')->where('email',session()->get('email'))->first();
            if($req->old_password != $oldpass->password)
            {
                return "wrong old password";
            }

            if ($req->newpassword !=$req->checknewpassword)
            {
                return "password does not match";
            }

            DB::table('recipient')->where('email',session()->get('email'))->update(['password'=> $req->newpassword]);
            
            $recipient_info = DB::table('recipient')->where('email',session()->get('email'))->first();
            return view('Recipient_Profile.Profile_Settings')->with('recipient_info',$recipient_info);
        }
        return redirect('login');
    }

    public function BloodData(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {
            session_start();
            $Priorityvalue=0;

        	$req->validate([
           		'Blood_Grp'=>'required',
        		'Blood_Quantity'=>'required|integer',
        		'Blood_Med'=>'required',
      
        		]);


                $reci_table = DB::table('recipient')->where('email',session()->get('email'))->first();

                $check = DB::table('prove_for_blood')->where('recipient_id',$reci_table->recipient_id)->get();
                if($check != '[]')
                {
                    return "Your request is already pending";
                }

        		$data= new Prove_for_blood_req;
                $data->recipient_id = $reci_table->recipient_id;
        		$data->Blood_Group=$req->Blood_Grp;
        		$data->Quantity_ltr=$req->Blood_Quantity;

                $files = $req->file('Blood_Med');
                $extension = $files->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $files->move('images/',$filename);

        		$data->Medical_Report=$filename;
                $data->Approval = 0;
                
                $Priorityvalue = $_SESSION['Priority'];

                if ( ($data->Blood_Group=="AB-") || ($data->Blood_Group=="AB+") || ($data->Blood_Group=="O-") || ($data->Blood_Group=="O+"))
                { $Priorityvalue+=2; }

                if($data->Quantity_ltr > 3)
                    { $Priorityvalue+=3; }

        		$data->Conclusion_rating=$Priorityvalue;
        		$data->save();

                $_SESSION['Priority'] = 0;      //refereshing priority value

        		return redirect('Submit_Request');
             }
        return redirect('login');
    }

    public function BloodPriorityValue(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {
            session_start();
            $req->validate([
                'bp1'=>'required',
                'bp2'=>'required',
                'bp3'=>'required',
                'bp4'=>'required',
                'bp5'=>'required'
            ]);
            $data=0;

            if ($req->bp1=='Average')  { $data+=1;}  
            elseif ($req->bp1=='Severe')  { $data+=2;}  
            elseif ($req->bp1=='Critical')  { $data+=3;} 

            if ($req->bp2=='Extremely Urgent')  { $data+=3;}  
            elseif ($req->bp2=='Urgent')  { $data+=2;}  
            elseif ($req->bp2=='Can wait for some time')  { $data+=1;}         

            if ($req->bp3=='Yes')  { $data+=2;}  
            elseif ($req->bp3=='No')  { $data+=1;}  

            if ($req->bp4=='Accident')  { $data+=3;}  
            elseif ($req->bp4=='Organ malfunction')  { $data+=2;}  
            elseif ($req->bp4=='Others')  { $data+=1;}        
            
            if ($req->bp5=='Rich')  { $data+=1;}
            elseif ($req->bp5=='Middle')  { $data+=2;}  
            elseif ($req->bp5=='Poor')  { $data+=3;} 
                                           
            $_SESSION['Priority'] = $data;

             return redirect('Prove_blood');
         }
        return redirect('login');
    }

    public function OrganData(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {
        	$req->validate([
           		'Blood_grp'=>'required',
        		'Organ_name'=>'required',
        		'Organ_med'=>'required',
      
        		]);
            session_start();
            $Priorityvalue=0;


                $reci_table = DB::table('recipient')->where('email',session()->get('email'))->first();

                $check = DB::table('prove_for_organ')->where('recipient_id',$reci_table->recipient_id)->get();
                if($check != '[]')
                {
                    return "Your request is already pending";
                }

        		$data= new Prove_for_organ_req;
                $data->recipient_id = $reci_table->recipient_id;
        		$data->Blood_Group=$req->Blood_grp;
        		$data->Organ_Name=strtoupper($req->Organ_name);

                $files = $req->file('Organ_med');
                $extension = $files->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $files->move('images/',$filename);

                $data->Medical_Report=$filename;
                $data->Approval = 0;

                $Priorityvalue = $_SESSION['Priority4'];

                if ( ($data->Blood_Group=="AB-") || ($data->Blood_Group=="AB+") || ($data->Blood_Group=="O-") || ($data->Blood_Group=="O+"))
                { $Priorityvalue+=2; }

        		$data->Conclusion_rating=$Priorityvalue;
        		$data->save();

                $_SESSION['Priority4']=0;
                
        		return redirect('Submit_Request');
            }
        return redirect('login');
    }

    public function OrganPriorityValue(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {
            $req->validate([
                'Op1'=>'required',
                'Op2'=>'required',
                'Op3'=>'required',
                'Op4'=>'required',
                'Op5'=>'required'
            ]);
            session_start();
            $data=0;

            if ($req->Op1=='Average')  { $data+=1;}  
            elseif ($req->Op1=='Severe')  { $data+=2;}  
            elseif ($req->Op1=='Critical')  { $data+=3;} 

            if ($req->Op2=='Extremely Urgent')  { $data+=3;}  
            elseif ($req->Op2=='Urgent')  { $data+=2;}  
            elseif ($req->Op2=='Can wait for some time')  { $data+=1;}         

            if ($req->Op3=='Yes')  { $data+=2;}  
            elseif ($req->Op3=='No')  { $data+=1;}           

            if ($req->Op4=='Accident')  { $data+=4;}  
            elseif ($req->Op4=='Age factor')  { $data+=3;}  
            elseif ($req->Op4=='Disease')  { $data+=2;}        
            elseif ($req->Op4=='Others')  { $data+=1;}        
            
            if ($req->Op5=='Rich')  { $data+=1;}  
            elseif ($req->Op5=='Middle')  { $data+=2;}  
            elseif ($req->Op5=='Poor')  { $data+=3;} 

                                           
            $_SESSION['Priority4'] = $data;

             return redirect('Prove_organ');
         }
        return redirect('login');
    }

    
    public function ItemData(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {

            session_start();
            $Priorityvalue=0;

        	$req->validate([
           		'item_name'=>'required',
           		'quantity'=>'required',
        		'electric'=>'required',
        		 'gas'=>'required',
        		 'finance'=>'required',
      
        		]);

                $reci_table = DB::table('recipient')->where('email',session()->get('email'))->first();

                $check = DB::table('prove_for_items')->where('recipient_id',$reci_table->recipient_id)->get();
                if($check != '[]')
                {
                    return "Your request is already pending";
                }

        		$data= new Prove_for_items_req;
                $data->recipient_id = $reci_table->recipient_id;
        		$data->Item_Name=strtoupper($req->item_name);
        		$data->Quantity=$req->quantity;
        		
                $files = $req->file('electric');
                $extension = $files->getClientOriginalExtension();
                $filename = 'electric'.time().'.'.$extension;
                $files->move('images/',$filename);

                $data->Electric_Bill=$filename;

                $files = $req->file('gas');
                $extension = $files->getClientOriginalExtension();
                $filename = 'gas'.time().'.'.$extension;
                $files->move('images/',$filename);

                $data->Gas_Bill=$filename;

                $files = $req->file('finance');
                $extension = $files->getClientOriginalExtension();
                $filename = 'finance'.time().'.'.$extension;
                $files->move('images/',$filename);

                $data->Finantial_statement=$filename;
                
        		$Priorityvalue = $_SESSION['Priority2'];
                $data->Conclusion_rating=$Priorityvalue;
                $data->Approval = 0;
        		$data->save();    		
    	    	$_SESSION['Priority2'] =0;
    	    	
                return redirect('Submit_Request');
	    }
        return redirect('login');
    }

    public function ItemPriorityValue(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {
            $req->validate([
                'Ip1'=>'required',
                'Ip2'=>'required',
                'Ip3'=>'required',
                'Ip4'=>'required',
                'Ip5'=>'required',
                'Ip6'=>'required'
            ]);
            session_start();
            $data=0;

            if ($req->Ip1=='Natural disaster')  { $data+=3;}  
            elseif ($req->Ip1=='Organ malfunction')  { $data+=2;}  
            elseif ($req->Ip1=='Others')  { $data+=1;} 

            if ($req->Ip2=='Extremely Urgent')  { $data+=3;}  
            elseif ($req->Ip2=='Urgent')  { $data+=2;}  
            elseif ($req->Ip2=='Can wait for some time')  { $data+=1;}         

            if ($req->Ip3=='Food and Drink')  { $data+=4;}  
            elseif ($req->Ip3=='Household/Domestic')  { $data+=3;}  
            elseif ($req->Ip3=='Educational')  { $data+=2;}  
            elseif ($req->Ip3=='Wearable')  { $data+=1;}  

            if ($req->Ip4=='Below 10 thousand')  { $data+=4;}  
            elseif ($req->Ip4=='Below 25 thousand but Above 10 thousand')  { $data+=3;}  
            elseif ($req->Ip4=='Below 50 thousand but Above 25 thousand')  { $data+=2;}        
            elseif ($req->Ip4=='Above 50 thousand')  { $data+=1;}        
            
            if ($req->Ip5=='Below 2 thousand')  { $data+=4;}  
            elseif ($req->Ip5=='Below 5 thousand but Above 2 thousand')  { $data+=3;}  
            elseif ($req->Ip5=='Below 10 thousand but Above 5 thousand')  { $data+=2;} 
            elseif ($req->Ip5=='Above 10 thousand')  { $data+=1;} 

            if ($req->Ip6=='Rich')  { $data+=1;}  
            elseif ($req->Ip6=='Middle')  { $data+=2;}  
            elseif ($req->Ip6=='Poor')  { $data+=3;} 
                                           
            $_SESSION['Priority2'] = $data;

             return redirect('Prove_item');
         }
        return redirect('login');
    }



    public function MoneyData(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {
            session_start();
            $Priorityvalue=0;

        	$req->validate([
           		'amount'=>'required|integer',
        		'electric'=>'required',
        		'gas'=>'required',
        		'finance'=>'required',
      
        		]);

                $reci_table = DB::table('recipient')->where('email',session()->get('email'))->first();

                $check = DB::table('prove_for_money')->where('recipient_id',$reci_table->recipient_id)->get();
                if($check != '[]')
                {
                    return "Your request is already pending";
                }

        		$data= new Prove_for_money_req;
                $data->recipient_id = $reci_table->recipient_id;
        		$data->Amount=$req->amount;

                $files = $req->file('electric');
                $extension = $files->getClientOriginalExtension();
                $filename = 'electric'.time().'.'.$extension;
                $files->move('images/',$filename);

                $data->Electric_Bill=$filename;

                $files = $req->file('gas');
                $extension = $files->getClientOriginalExtension();
                $filename = 'gas'.time().'.'.$extension;
                $files->move('images/',$filename);

                $data->Gas_Bill=$filename;

                $files = $req->file('finance');
                $extension = $files->getClientOriginalExtension();
                $filename = 'finance'.time().'.'.$extension;
                $files->move('images/',$filename);

                $data->Finantial_statement=$filename;

        		$Priorityvalue = $_SESSION['Priority3'];
                $data->Conclusion_rating=$Priorityvalue;
                $data->Approval = 0;
        		$data->save();    		
    	    	
    	    	$_SESSION['Priority3'] = 0;
    	    	return redirect('Submit_Request');
        }
        return redirect('login');
    }

    public function MoneyPriorityValue(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'recipient')
        {
            $req->validate([
                'Mp1'=>'required',
                'Mp2'=>'required',
                'Mp3'=>'required',
                'Mp4'=>'required',
                'Mp5'=>'required',
                'Mp6'=>'required',
                'Mp7'=>'required',
                'Mp8'=>'required',
                'Mp9'=>'required',
                'Mp10'=>'required'
            ]);
            session_start();
            $data=0;

            if ($req->Mp1=='Rich')  { $data+=1;}  
            elseif ($req->Mp1=='Middle')  { $data+=2;}  
            elseif ($req->Mp1=='Poor')  { $data+=3;} 

            if ($req->Mp2=='Extremely Urgent')  { $data+=3;}  
            elseif ($req->Mp2=='Urgent')  { $data+=2;}  
            elseif ($req->Mp2=='Can wait for some time')  { $data+=1;}         

            if ($req->Mp3=='Pay for medical bills')  { $data+=4;}  
            elseif ($req->Mp3=='Pay for necessary events(shadi,soyam etc)')  { $data+=3;}  
            elseif ($req->Mp3=='Pay for residence')  { $data+=2;}  
            elseif ($req->Mp3=='Others')  { $data+=1;}  

            if ($req->Mp4=='Below 10 thousand')  { $data+=4;}  
            elseif ($req->Mp4=='Below 25 thousand but Above 10 thousand')  { $data+=3;}  
            elseif ($req->Mp4=='Below 50 thousand but Above 25 thousand')  { $data+=2;}        
            elseif ($req->Mp4=='Above 50 thousand')  { $data+=1;}        
            
            if ($req->Mp5=='Owner')  { $data+=1;}  
            elseif ($req->Mp5=='Rental')  { $data+=2;}  
            elseif ($req->Mp5=='Homeless')  { $data+=3;} 
           

            if ($req->Mp6=='Car')  { $data+=4;}  
            elseif ($req->Mp6=='Bike')  { $data+=3;}  
            elseif ($req->Mp6=='Cycle')  { $data+=2;} 
            elseif ($req->Mp6=='Nothing')  { $data+=1;} 

            if ($req->Mp7=='Below 2 thousand')  { $data+=1;}  
            elseif ($req->Mp7=='Below 5 thousand but Above 2 thousand')  { $data+=2;}  
            elseif ($req->Mp7=='Below 10 thousand but Above 5 thousand')  { $data+=3;} 
            elseif ($req->Mp7=='Above 10 thousand')  { $data+=3;}

            if ($req->Mp8=='Below 200 hundred')  { $data+=4;}  
            elseif ($req->Mp8=='Below 500 hundred but Above 200 hundred')  { $data+=3;}  
            elseif ($req->Mp8=='Below 1 thousand but Above 500 hundred')  { $data+=2;} 
            elseif ($req->Mp8=='Above 1 thousand')  { $data+=1;} 

            if ($req->Mp9=='Yes')  { $data+=4;}  
            elseif ($req->Mp9=='No')  { $data+=3;}  

            if ($req->Mp10=='1')  { $data+=4;}  
            elseif ($req->Mp10=='2')  { $data+=3;}  
            elseif ($req->Mp10=='More than 2')  { $data+=2;} 
                                           
            $_SESSION['Priority3'] = $data;

             return redirect('Prove_money');
         }
        return redirect('login');
    }

    public function submitted_request()
    {
        return view('Recipient.request_submitted');
    }

}
