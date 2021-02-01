<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Models\donor;
use App\Models\recipient;
use App\Models\moneyinventory;
use App\Models\bloodinventory;
use App\Models\organinventory;
use App\Models\medicalreport;
use App\Models\iteminventory;
use App\Models\Prove_for_blood_req;
use App\Models\Prove_for_organ_req;
use App\Models\Prove_for_money_req;
use App\Models\Prove_for_items_req;
use App\Models\bloodhistory;
use App\Models\organhistory;
use App\Models\moneyhistory;
use App\Models\itemhistory;

class Donor_Con extends Controller
{
    //Donor Profile Controls
    public function profile_view()
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            return view('Donor_Profile.profile');
        }
        return redirect('login');
    }

    public function DP_App()     // use join on blood aand organ with there respective
    {                            // inventory to fetch all columns
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $id_check = DB::table('donor')->where('email',session()->get('email'))->first();
            $blood_table = DB::table('medicalreport')->join('bloodhistory','medicalreport.report_id','=','bloodhistory.donor_report_id')->where([['medicalreport.donor_id',$id_check->donor_id],['report_type','blood'],['compatibility',NULL]])->orWhere([['medicalreport.donor_id',$id_check->donor_id],['report_type','blood'],['recipient_id',NULL]])->get();

            $organ_table = DB::table('medicalreport')->join('organhistory','medicalreport.report_id','=','organhistory.donor_report_id')->where([['medicalreport.donor_id',$id_check->donor_id],['report_type','organ'],['compatibility',NULL]])->orWhere([['medicalreport.donor_id',$id_check->donor_id],['report_type','organ'],['recipient_id',NULL]])->get();

            $item_table = DB::table('itemhistory')->where([['donor_id',$id_check->donor_id],['recipient_id',NULL]])->get();

            return view('Donor_Profile.Profile_Appointment')->with('blood_table',$blood_table)->with('organ_table',$organ_table)->with('item_table',$item_table);
        }
        return redirect('login');
    }

    public function DP_DonationHistroy()
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $own_id = DB::table('donor')->where('email',session()->get('email'))->first();
            $blood = DB::table('bloodhistory')->join('recipient','bloodhistory.recipient_id','=','recipient.recipient_id')->where([['donor_id',$own_id->donor_id],['quantity','<>',0]])->get(); //recipient bloodhistory tables are joined

            $organ = DB::table('organhistory')->join('recipient','organhistory.recipient_id','=','recipient.recipient_id')->where([['donor_id',$own_id->donor_id],['organ_name','<>',NULL]])->get(); //recipient organhistory tables are joined

            $item = DB::table('itemhistory')->join('recipient','itemhistory.recipient_id','=','recipient.recipient_id')->where([['donor_id',$own_id->donor_id],['item_name','<>',NULL]])->get(); //recipient itemhistory  tables are joined

            $money = DB::table('moneyhistory')->join('recipient','moneyhistory.recipient_id','=','recipient.recipient_id')->where([['donor_id',$own_id->donor_id],['amount','<>',NULL]])->get(); //recipient moneyhistory  tables are joined

            return view('Donor_Profile.Profile_Donation_history')->with('blood',$blood)->with('organ',$organ)->with('item',$item)->with('money',$money);
        }
        return redirect('login');
    }

    public function DP_Settings()
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $donor_info = DB::table('donor')->where('email',session()->get('email'))->first();

              return view('Donor_Profile.Profile_Settings')->with('donor_info',$donor_info);
        }
        return redirect('login');
    }

    public function change_Pinfo()
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $donor_info = DB::table('donor')->where('email',session()->get('email'))->first();

              return view('Donor_Profile.change_profile')->with('donor_info',$donor_info);
        }
        return redirect('login');
    }

    public function change_dinfo(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $change_temp = DB::table('donor')->where('email',session()->get('email'));
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
            $donor_info = DB::table('donor')->where('email',session()->get('email'))->first();
            return view('Donor_Profile.Profile_Settings')->with('donor_info',$donor_info);
        }
        return redirect('login');
    }

    public function change_dpass()
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            return view('Donor_Profile.change_password');
        }
        return redirect('login');
    }

    public function change_dpassword(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $req->validate([
                'old_password'=>'required',
                'newpassword'=>'required|min:6',
                'checknewpassword'=>'required|min:6',
            ]);
            $oldpass = DB::table('donor')->where('email',session()->get('email'))->first();
            if($req->old_password != $oldpass->password)
            {
                return "wrong old password";
            }

            if ($req->newpassword !=$req->checknewpassword)
            {
                return "password does not match";
            }

            DB::table('donor')->where('email',session()->get('email'))->update(['password'=> $req->newpassword]);
            
            $donor_info = DB::table('donor')->where('email',session()->get('email'))->first();
            return view('Donor_Profile.Profile_Settings')->with('donor_info',$donor_info);
        }
        return redirect('login');
    }

    public function update_Pcardinfo()
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            return view('Donor_Profile.update_cardinfo');
        }
        return redirect('login');
    }

    public function updated_cardinfo(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $req->validate([
                'card_no'=>'required',
                'cvv'=>'required',
             ]);

            $table_info = DB::table('donor')->where('email',session()->get('email'));

            $table_info->update(['card_no'=>$req->card_no]);
            $table_info->update(['cvv'=>$req->cvv]);

            $donor_info = DB::table('donor')->where('email',session()->get('email'))->first();
            return view('Donor_Profile.Profile_Settings')->with('donor_info',$donor_info);
        }
        return redirect('login');
    }


    //Blood Donation Controls
    public function blood_donate()
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $reci_table = DB::table('prove_for_blood')->where('Approval',1)->get();
            return view('Donor_donations.blood_donation')->with('reci_table',$reci_table);
        }
        return redirect('login');
    }

    public function set_bloodappointment_sys(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $donation_way = $req->donating;
            $donation_type = 'blood';
            if($donation_way == 'sys_way')
            {

                $d_data1 =session()->get('email');
                $d_data2 = DB::table('donor')->where('email',$d_data1)->first();

                $check = DB::table('medicalreport')->where([['donor_id',$d_data2->donor_id],['report_type','blood'],['compatibility',NULL]])->get(); //only one donation at a time till approval
                if($check != '[]')
                {
                    return redirect('error');
                }

                $mrtable = new medicalreport;
                $mrtable->donor_id = $d_data2->donor_id;
                $mrtable->report_type = 'blood';
                $mrtable->save();

                $bloodhistory_table = new bloodhistory;
                $bloodhistory_table->donor_id = $d_data2->donor_id;
                $bloodhistory_table->quantity = 0;

                $rep_id = DB::table('medicalreport')->where([['donor_id',$d_data2->donor_id],['report_type','blood'],['compatibility',NULL]])->first();

                $bloodhistory_table->donor_report_id = $rep_id->report_id;
                $bloodhistory_table->save();
            }
            return view('appointments.appointment')->with('donation_way',$donation_way)->with('donation_type',$donation_type);
        }
        return redirect('login');
    }

    public function set_bloodappointment_spec(request $req) //to be edited
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $d_data1 =session()->get('email');
            $d_data2 = DB::table('donor')->where('email',$d_data1)->first();
            // check if recipient have asked for doantion or not
            $check_reci = DB::table('prove_for_blood')->where([['recipient_id',$req->reciever],['Approval',1]])->get();
            if($check_reci == '[]')
            {
                return redirect("error2");
            }
            $check = DB::table('medicalreport')->where([['donor_id',$d_data2->donor_id],['report_type','blood'],['compatibility',NULL]])->get(); //only one donation at a time till approval
            if($check != '[]')
            {
                return redirect('error');
            }

            $donation_way = '-';

            $mrtable = new medicalreport;
            $d_data1 =session()->get('email');
            $d_data2 = DB::table('donor')->where('email',$d_data1)->first();
            $mrtable->donor_id = $d_data2->donor_id;
            $mrtable->report_type = 'blood';
            $mrtable->save();

            $bloodhistory_table = new bloodhistory;

            $bloodhistory_table->donor_id = $d_data2->donor_id;
            $bloodhistory_table->recipient_id = $req->reciever;
            $bloodhistory_table->quantity = 0;

            $rep_id = DB::table('medicalreport')->where([['donor_id',$d_data2->donor_id],['report_type','blood'],['compatibility',NULL]])->first();

            $bloodhistory_table->donor_report_id = $rep_id->report_id;
            $bloodhistory_table->save();

            return view('appointments.appointment')->with('donation_way',$donation_way);
        }
        return redirect('login');
    }


    //Organ Donation Controls
    public function organ_donate()
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $reci_table = DB::table('prove_for_organ')->where('Approval',1)->get();
            $donation_type = "organ";
            return view('Donor_donations.organ_donation')->with('reci_table',$reci_table)->with('donation_type',$donation_type);
        }
        return redirect('login');
    }

    public function set_organappointment_sys(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $donation_way = $req->donating;
            $donation_type = 'organ';
            if($donation_way == 'sys_way')
            {
                $d_data1 =session()->get('email');
                $d_data2 = DB::table('donor')->where('email',$d_data1)->first();

                $check = DB::table('medicalreport')->where([['donor_id',$d_data2->donor_id],['report_type','organ'],['compatibility',NULL]])->get(); //only one donation at a time till approval
                if($check != '[]')
                {
                    return redirect('error');
                }

                $mrtable = new medicalreport;
                $mrtable->donor_id = $d_data2->donor_id;
                $mrtable->report_type = 'organ';
                $mrtable->save();

                $organhistory_table = new organhistory;

                $organhistory_table->donor_id = $d_data2->donor_id;

                $rep_id = DB::table('medicalreport')->where([['donor_id',$d_data2->donor_id],['report_type','organ'],['compatibility',NULL]])->first();

                $organhistory_table->donor_report_id = $rep_id->report_id;
                $organhistory_table->save();
            }
            return view('appointments.appointment')->with('donation_way',$donation_way)->with('donation_type',$donation_type);
        }
        return redirect('login');
    }

    public function set_organappointment_spec(request $req) //to be edited
    {
        
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $d_data1 =session()->get('email');
            $d_data2 = DB::table('donor')->where('email',$d_data1)->first();

            // check if recipient have asked for donation or not
            $check_reci = DB::table('prove_for_organ')->where([['recipient_id',$req->reciever],['Approval',1]])->get();

            if($check_reci == '[]')
            {
                return redirect("error2");
            }
            $check = DB::table('medicalreport')->where([['donor_id',$d_data2->donor_id],['report_type','organ'],['compatibility',NULL]])->get(); //only one donation at a time till approval
            if($check != '[]')
            {
                return redirect('error');
            }

            $donation_way = '-';

            $mrtable = new medicalreport;
            $d_data1 =session()->get('email');
            $d_data2 = DB::table('donor')->where('email',$d_data1)->first();
            $mrtable->donor_id = $d_data2->donor_id;
            $mrtable->report_type = 'organ';
            $mrtable->save();

            $organhistory_table = new organhistory;

            $organhistory_table->donor_id = $d_data2->donor_id;
            $organhistory_table->recipient_id = $req->reciever;

            $rep_id = DB::table('medicalreport')->where([['donor_id',$d_data2->donor_id],['report_type','organ'],['compatibility',NULL]])->first();

            $organhistory_table->donor_report_id = $rep_id->report_id;
            $organhistory_table->save();

            return view('appointments.appointment')->with('donation_way',$donation_way);
        }
        return redirect('login');
    }


    //item and supplies Controls
    public function item_donate()
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $reci_table = DB::table('prove_for_items')->where('Approval',1)->get();
            return view('Donor_donations.item_donation')->with('reci_table',$reci_table);
        }
        return redirect('login');
    }

    public function set_itemappointment_sys(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $donation_way = $req->donating;
            $donation_type = 'items';
            if($donation_way == 'sys_way')
            {
                $d_data1 =session()->get('email');
                $d_data2 = DB::table('donor')->where('email',$d_data1)->first();
                $check = DB::table('itemhistory')->where([['donor_id',$d_data2->donor_id],['item_name',NULL],['quantity',0]])->first(); //only one donation at a time till approval
                if($check != NULL)
                {
                    return redirect('error');
                }
                $itemhistory_table = new itemhistory;
                $d_data1 =session()->get('email');
                $d_data2 = DB::table('donor')->where('email',$d_data1)->first();
                $itemhistory_table->donor_id = $d_data2->donor_id;
                $itemhistory_table->quantity = 0;
                $itemhistory_table->save();
            }
            return view('appointments.appointment')->with('donation_way',$donation_way)->with('donation_type',$donation_type);
        }
        return redirect('login');
    }

    public function set_itemappointment_spec(request $req) //to be edited
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $d_data1 =session()->get('email');
            $d_data2 = DB::table('donor')->where('email',$d_data1)->first();
            // check if recipient have asked for donation or not
            $check_reci = DB::table('prove_for_items')->where([['recipient_id',$req->reciever],['Approval',1]])->first();

            if($check_reci == NULL)
            {
                return redirect("error2");
            }

            $check = DB::table('itemhistory')->where([['donor_id',$d_data2->donor_id],['item_name',NULL],['quantity',0]])->first(); //only one donation at a time till approval
            if($check != NULL)
            {
                return redirect('error');
            }

            $donation_way = '-';
            $d_data1 =session()->get('email');
            $d_data2 = DB::table('donor')->where('email',$d_data1)->first();

            $itemhistory_table = new itemhistory;

            $itemhistory_table->donor_id = $d_data2->donor_id;
            $itemhistory_table->recipient_id = $req->reciever;
            $itemhistory_table->quantity = 0;
            $itemhistory_table->save();

            return view('appointments.appointment')->with('donation_way',$donation_way);
        }
        return redirect('login');
    }


    //money Donation Controls
    public function money_donate()
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $reci_table = DB::table('prove_for_money')->where('Approval',1)->get();
            return view('Donor_donations.money_donation')->with('reci_table',$reci_table);
        }
        return redirect('login');
    }


    public function payment_area(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $donation_way = $req->donating;
            $card_noo = donor::where('email',session()->get('email'))->first();
            // return $card_noo;
            return view('payment_method')->with('donation_way',$donation_way)->with('card_noo',$card_noo);
        }
        return redirect('login');
    }

    public function RemoveCard(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $d_data = DB::table('donor')->where('email',session()->get('email'));
             $d_data->update(['card_no'=>NULL]);
             $d_data->update(['cvv'=>NULL]);

            $card_noo = donor::select('card_no')->where('email',session()->get('email'))->first();
            return view('payment_method')->with('donation_way',$req->donation_way)->with('card_noo',$card_noo);
        }
        return redirect('login');
    }


    //thank you after Donation
    public function thank_you(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'donor')
        {
            $req->validate([
                'amount'=>'required|integer'
            ]);
            $d_data1 =session()->get('email');
            $d_data2 = DB::table('donor')->where('email',$d_data1)->first();
            if($d_data2->card_no == NULL)
            {
                $req->validate([
                'card_no'=>'required|integer',
                'cvv'=>'required|integer'
            ]);
                 $d_data = DB::table('donor')->where('email',$d_data1);
                 $d_data->update(['card_no'=>$req->card_no]);
                 $d_data->update(['cvv'=>$req->cvv]);
            }

            if($req->donation_way == 'spec_way')
            {
                $pmoney_table = DB::table('prove_for_money')->where([['recipient_id',$req->reciever],['Approval',1]])->first();

                if($pmoney_table == NULL)
                {
                    return redirect("error2");
                }

                if($req->amount > $pmoney_table->Amount)
                {
                    return "Cannot Donate more than requirement";
                }
                elseif($req->amount == $pmoney_table->Amount)
                {
                    $moneyhistory_table = new moneyhistory;

                    $moneyhistory_table->donor_id = $d_data2->donor_id;
                    $moneyhistory_table->recipient_id = $req->reciever;
                    $moneyhistory_table->amount = $req->amount;
                    $moneyhistory_table->save();

                    DB::table('prove_for_money')->where([['recipient_id',$req->reciever],['Approval',1]])->delete();
                }
                else
                {
                    $moneyhistory_table = new moneyhistory;

                    $moneyhistory_table->donor_id = $d_data2->donor_id;
                    $moneyhistory_table->recipient_id = $req->reciever;
                    $moneyhistory_table->amount = $req->amount;
                    $moneyhistory_table->save();

                    $newamount = $pmoney_table->Amount - $req->amount;
                    DB::table('prove_for_money')->where([['recipient_id',$req->reciever],['Approval',1]])->update(['Amount'=>$newamount]);
                }

                
            }

            if($req->donation_way == 'sys_way')
            {
                $total = $req->amount;
                while($total != 0)
                {
                    $high_rating_reci = DB::table('prove_for_money')->where('Approval',1)->orderBy('Conclusion_rating','desc')->first();

                    if($high_rating_reci == NULL)
                    {
                        $tablename = new moneyinventory;
                        $tablename->donor_id = $d_data2->donor_id;
                        $tablename->amount = $total;
                        $tablename->save();

                        $total = 0;
                    }
                    else
                    {
                        if($total > $high_rating_reci->Amount)
                        {
                            $moneyhistory_table = new moneyhistory;

                            $moneyhistory_table->donor_id = $d_data2->donor_id;
                            $moneyhistory_table->recipient_id = $high_rating_reci->recipient_id;
                            $moneyhistory_table->amount = $high_rating_reci->Amount;
                            $moneyhistory_table->save();

                            DB::table('prove_for_money')->where([['recipient_id',$high_rating_reci->recipient_id],['Approval',1]])->delete();

                            $total = $total - $high_rating_reci->Amount;
                        }
                        elseif($total == $high_rating_reci->Amount)
                        {
                            $moneyhistory_table = new moneyhistory;

                            $moneyhistory_table->donor_id = $d_data2->donor_id;
                            $moneyhistory_table->recipient_id = $high_rating_reci->recipient_id;
                            $moneyhistory_table->amount = $total;
                            $moneyhistory_table->save();

                            DB::table('prove_for_money')->where([['recipient_id',$high_rating_reci->recipient_id],['Approval',1]])->delete();

                            $total = 0;
                        }
                        else
                        {
                            $moneyhistory_table = new moneyhistory;

                            $moneyhistory_table->donor_id = $d_data2->donor_id;
                            $moneyhistory_table->recipient_id = $high_rating_reci->recipient_id;
                            $moneyhistory_table->amount = $total;
                            $moneyhistory_table->save();

                            $newamount = $high_rating_reci->Amount - $total;
                            DB::table('prove_for_money')->where([['recipient_id',$high_rating_reci->recipient_id],['Approval',1]])->update(['Amount'=>$newamount]);

                            $total = 0;
                        }
                    }
                }
            }
            return view('thank_you');
            
        }
        return redirect('login');
    }
}