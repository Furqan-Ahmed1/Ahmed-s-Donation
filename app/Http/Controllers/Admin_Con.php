<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Models\donor;
use App\Models\recipient;
use App\Models\admininfo;
use App\Models\blockuser;
use App\Models\moneyinventory;
use App\Models\iteminventory;
use App\Models\bloodinventory;
use App\Models\organinventory;
use App\Models\Prove_for_blood_req;
use App\Models\Prove_for_organ_req;
use App\Models\Prove_for_money_req;
use App\Models\Prove_for_items_req;
use App\Models\bloodhistory;
use App\Models\organhistory;
use App\Models\moneyhistory;
use App\Models\itemhistory;

use App\Models\medicalreport;

class Admin_Con extends Controller
{
    //
    public function admin_view()
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
        	return view('Admin_area.admin');
        }
        return redirect('login');
    }

    public function view_blood_history()
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
            $blood_his = DB::table('bloodhistory')->where([['quantity','<>',0],['recipient_id','<>',NULL]])->get();
            $panel = 'blood';
            return view('Admin_area.View_History')->with('blood_his',$blood_his)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function view_organ_history()
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
            $organ_his = DB::table('organhistory')->where([['organ_name','<>',NULL],['recipient_id','<>',NULL]])->get();
            $panel = 'organ';
            return view('Admin_area.View_History')->with('organ_his',$organ_his)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function view_items_history()
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
            $item_his = DB::table('itemhistory')->where([['item_name','<>',NULL],['recipient_id','<>',NULL]])->get();
            $panel = 'items';
            return view('Admin_area.View_History')->with('item_his',$item_his)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function view_money_history()
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
            $money_his = DB::table('moneyhistory')->where([['amount','<>',0],['recipient_id','<>',NULL]])->get();
            $panel = 'money';
            return view('Admin_area.View_History')->with('money_his',$money_his)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function view_blood_inv()
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
            $blood_inv = DB::table('bloodinventory')->join('medicalreport','bloodinventory.report_id','=','medicalreport.report_id')->where([['quantity','<>',0],['compatibility','<>',NULL]])->get();
            $panel = 'blood';
            return view('Admin_area.View_Inventory')->with('blood_inv',$blood_inv)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function view_organ_inv()
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
            $organ_inv = DB::table('organinventory')->join('medicalreport','organinventory.report_id','=','medicalreport.report_id')->where([['organ_name','<>',NULL],['compatibility','<>',NULL]])->get();
            $panel = 'organ';
            return view('Admin_area.View_Inventory')->with('organ_inv',$organ_inv)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function view_items_inv()
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
            $item_inv = DB::table('iteminventory')->where('item_name','<>',NULL)->get();
            $panel = 'items';
            return view('Admin_area.View_Inventory')->with('item_inv',$item_inv)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function view_money_inv()
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
            $money_inv = DB::table('moneyinventory')->where('amount','<>',0)->get();
            $panel = 'money';
            return view('Admin_area.View_Inventory')->with('money_inv',$money_inv)->with('panel',$panel);
        }
        return redirect('login');
    }

    //managing who id should exist or not
    public function mng_donor()
    {
    	if(session()->has('data') && session()->get('user_type') == 'admin')
        {
        	$All_donors = DB::table('donor')->get();
        	$panel = 'donor';
            return view('Admin_area.manage_user')->with('All_donors',$All_donors)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function mng_recipient()
    {
    	if(session()->has('data') && session()->get('user_type') == 'admin')
        {
        	$All_recipient = DB::table('recipient')->get();
        	$panel = 'recipient';
            return view('Admin_area.manage_user')->with('All_recipient',$All_recipient)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function deleteorblock_user(request $req)
    {
    	if(session()->has('data') && session()->get('user_type') == 'admin')
        {
        	if($req->user_kind == 'donor')
        	{
                if($req->handle =='remove')
                {
        		  DB::table('donor')->where('donor_id',$req->donor_id)->delete();
                }
                elseif($req->handle == 'block')
                {
                	$All_donors = DB::table('donor')->where('donor_id',$req->donor_id)->first();
                	$blocked = DB::table('blockuser')->get();

                	$x = 0;
                	foreach ($blocked as $b) 
                	{
                		if($b->email == $All_donors->email || $b->cnic == $All_donors->cnic)
                		{
                			$x = 1;
                		}
                	}
                	if($x == 0)
                	{
		                $blocked = new blockuser;
		                $donor_table =DB::table('donor')->where('donor_id',$req->donor_id)->first();
		                $blocked->email = $donor_table->email;
		                $blocked->cnic = $donor_table->cnic;
		                $blocked->save();                	}
                }
    
        		$All_donors = DB::table('donor')->get();
	            $panel = 'donor';
           		return view('Admin_area.manage_user')->with('All_donors',$All_donors)->with('panel',$panel);
        	}
        	elseif ($req->user_kind == 'recipient') 
        	{
                if($req->handle =='remove')
                {
                  DB::table('recipient')->where('recipient_id',$req->recipient_id)->delete();
                }
                elseif($req->handle == 'block')
                {
                	$All_recipient = DB::table('recipient')->where('recipient_id',$req->recipient_id)->first();
                	$blocked = DB::table('blockuser')->get();

                	$x = 0;
                	foreach ($blocked as $b) 
                	{
                		if($b->email == $All_recipient->email || $b->cnic == $All_recipient->cnic)
                		{
                			$x = 1;
                		}
                	}
                	if($x == 0)
                	{
	                    $blocked = new blockuser;
	                    $recipient_table = DB::table('recipient')->where('recipient_id',$req->recipient_id)->first();
	                    $blocked->email = $recipient_table->email;
	                    $blocked->cnic = $recipient_table->cnic;
	                    $blocked->save();
                	}
                }
				

				$All_recipient = DB::table('recipient')->get();
           		$panel = 'recipient';
          		return view('Admin_area.manage_user')->with('All_recipient',$All_recipient)->with('panel',$panel);
        	}
        }
        return redirect('login');
    }

    public function mng_blockuser()
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
            $blockeduser= DB::table('blockuser')->get();
            return view('Admin_area.blockuser')->with('blockeduser',$blockeduser);
        }
        return redirect('login');
    }

    public function Removeblock_user(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
            DB::table('blockuser')->where('blockeduser_id',$req->blockeduser_id)->delete();

            $blockeduser= DB::table('blockuser')->get();
            return view('Admin_area.blockuser')->with('blockeduser',$blockeduser);
        }
        return redirect('login');
    }



    public function mng_app_blood()
    {
    	if(session()->has('data') && session()->get('user_type') == 'admin')
        {
        	$blood_table = DB::table('medicalreport')->join('bloodhistory','medicalreport.report_id','=','bloodhistory.donor_report_id')->where([['report_type','blood'],['compatibility',NULL]])->get();
        	$panel = 'blood';
            return view('Admin_area.manage_appointments')->with('blood_table',$blood_table)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function mnged_bapp(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
                $req->validate([
                    'blood_group'=>'required',
                    'compatibility'=>'required',
                    'quantity'=>'required|min:0',
                 ]);

                if($req->compatibility > 2 && $req->compatibility < 6)
                {
                	$blood_table = DB::table('medicalreport')->join('bloodhistory','medicalreport.report_id','=','bloodhistory.donor_report_id')->where('report_id',$req->report_id)->first();
                	if($blood_table->recipient_id != NULL)	//donation specific recipient
                	{
                		$bprove_table = DB::table('prove_for_blood')->where([['recipient_id',$blood_table->recipient_id],['Approval',1]])->first();
                        if($req->quantity < 1)
                        {
                            return "Irrelevent Quantity";
                        }
                		elseif($req->quantity > $bprove_table->Quantity_ltr)
                		{
                			return "Cannot donate more than required quantity to specific person";
                		}
                		elseif($req->quantity == $bprove_table->Quantity_ltr)
                		{
                            $reci_prove = DB::table('prove_for_blood')->where('recipient_id',$req->recipient_id)->first();
                            if($req->blood_group == 'O-' || $reci_prove->Blood_Group == 'AB+' || $req->blood_group == $reci_prove->Blood_Group)
                            {
                    			DB::table('bloodhistory')->where([['donor_id',$req->donor_id],['recipient_id',$req->recipient_id],['quantity',0],['donor_report_id',$req->report_id]])->update(['quantity'=>$req->quantity]);    //update history

                                DB::table('prove_for_blood')->where('recipient_id',$req->recipient_id)->delete();
                            }
                            else
                            {
                                return "Irrelevent Blood Group";
                            }
                		}
                		else
                		{
                            $reci_prove = DB::table('prove_for_blood')->where('recipient_id',$req->recipient_id)->first();
                            if($req->blood_group == 'O-' || $reci_prove->Blood_Group == 'AB+' || $req->blood_group == $reci_prove->Blood_Group)
                            {
                    			DB::table('bloodhistory')->where([['donor_id',$req->donor_id],['recipient_id',$req->recipient_id],['quantity',0],['donor_report_id',$req->report_id]])->update(['quantity'=>$req->quantity]);

                    			$new_quantity = $bprove_table->Quantity_ltr - $req->quantity;

                    			DB::table('prove_for_blood')->where([['recipient_id',$blood_table->recipient_id],['Approval',1]])->update(['Quantity_ltr'=>$new_quantity]);
                            }
                            else
                            {
                                return "Irrelevent Blood Group";
                            }

                		}
                	}
                    else
                    {

                        if($req->quantity < 1)
                        {
                            return "Irrelevent Quantity";
                        }
                                
                        $total = $req->quantity;
                        while($total != 0)
                        {
                            // relevent blood group most needy recipient
                            if( $req->blood_group != 'O-' )
                            {
                                $high_rating_reci = DB::table('prove_for_blood')->where([['Blood_Group','AB+'],['Approval',1]])->orWhere([['Blood_Group',$req->blood_group],['Approval',1]])->orderBy('Conclusion_rating','desc')->first();
                            }
                            else
                            {
                                $high_rating_reci = DB::table('prove_for_blood')->where('Approval',1)->orderBy('Conclusion_rating','desc')->first();
                            }

                            if($high_rating_reci == NULL)
                            {
                    			$b_table = new bloodinventory;
        	                    $b_table->donor_id = $req->donor_id;
        	                    $b_table->report_id = $req->report_id;
        	                    $b_table->quantity = $total;
        	                    $b_table->save();

                                $total = 0;
                            }
                            else
                            {
                                if($total > $high_rating_reci->Quantity_ltr)// for donation more than requirrment
                                {
                                    //update history
                                    $updation = DB::table('bloodhistory')->where([['donor_id',$req->donor_id],['quantity',0],['donor_report_id',$req->report_id]]);

                                    $rec_id = $high_rating_reci->recipient_id;
                                    $updation->update(['recipient_id'=>$rec_id]);
                                    $updation->update(['quantity'=>$high_rating_reci->Quantity_ltr]);

                                    DB::table('prove_for_blood')->where('recipient_id',$high_rating_reci->recipient_id)->delete();

                                    
                                    $total = $total - $high_rating_reci->Quantity_ltr;  //remaining quantity

                                    if( $req->blood_group != 'O-' )
                                    {
                                        $high_rating_reci = DB::table('prove_for_blood')->where([['Blood_Group','AB+'],['Approval',1]])->orWhere([['Blood_Group',$req->blood_group],['Approval',1]])->orderBy('Conclusion_rating','desc')->first();
                                    }
                                    else
                                    {
                                        $high_rating_reci = DB::table('prove_for_blood')->where('Approval',1)->orderBy('Conclusion_rating','desc')->first();
                                    }
                                    if($high_rating_reci != NULL)
                                    {
                                        $new_entry = new bloodhistory;
                                        $new_entry->donor_id = $req->donor_id;
                                        $new_entry->donor_report_id = $req->report_id;
                                        $new_entry->quantity = 0;
                                        $new_entry->save();                            
                                    }

                                }
                                elseif($total == $high_rating_reci->Quantity_ltr)// for equal amount of donation
                                {
                                    //update history
                                    $updation = DB::table('bloodhistory')->where([['donor_id',$req->donor_id],['quantity',0],['donor_report_id',$req->report_id]]);
                                    $rec_id = $high_rating_reci->recipient_id;
                                    $updation->update(['recipient_id'=>$rec_id]);
                                    $updation->update(['quantity'=>$high_rating_reci->Quantity_ltr]);

                                    DB::table('prove_for_blood')->where('recipient_id',$high_rating_reci->recipient_id)->delete();

                                    $total = 0;     //every thing to donated
                                }
                                else // for less amount of donation
                                {
                                    //update history
                                    $updation = DB::table('bloodhistory')->where([['donor_id',$req->donor_id],['quantity',0],['donor_report_id',$req->report_id]]);

                                    $rec_id = $high_rating_reci->recipient_id;
                                    $updation->update(['recipient_id'=>$rec_id]);
                                    $updation->update(['quantity'=>$total]);

                                    $new_quantity = $high_rating_reci->Quantity_ltr - $total;

                                    DB::table('prove_for_blood')->where([['recipient_id',$high_rating_reci->recipient_id],['Approval',1]])->update(['Quantity_ltr'=>$new_quantity]);

                                    $total = 0; //every thing is donated

                                }
                            }
                        }

                    }
                }
                else
                {
                    DB::table('bloodhistory')->where([['donor_id',$req->donor_id],['recipient_id',$req->recipient_id],['quantity',0]])->delete();
                }

                $md_table = DB::table('medicalreport')->where('report_id',$req->report_id);
                $md_table->update(['blood_group'=>$req->blood_group]);
                $md_table->update(['compatibility'=>$req->compatibility]);


            $blood_table = DB::table('medicalreport')->join('bloodhistory','medicalreport.report_id','=','bloodhistory.donor_report_id')->where([['report_type','blood'],['compatibility',NULL]])->get();
            $panel = 'blood';
            return view('Admin_area.manage_appointments')->with('blood_table',$blood_table)->with('panel',$panel);
        }
        return redirect('login');
    }


    public function mng_app_organ()
    {
    	if(session()->has('data') && session()->get('user_type') == 'admin')
        {
            $organ_table = DB::table('medicalreport')->join('organhistory','medicalreport.report_id','=','organhistory.donor_report_id')->where([['report_type','organ'],['compatibility',NULL]])->get();
        	$panel = 'organ';
            return view('Admin_area.manage_appointments')->with('organ_table',$organ_table)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function mnged_oapp(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
                $req->validate([
                    'blood_group'=>'required',
                    'organ_name'=>'required',
                    'compatibility'=>'required',
                 ]);
                if($req->compatibility > 2 && $req->compatibility < 6)
                {
                    $organ_table = DB::table('medicalreport')->join('organhistory','medicalreport.report_id','=','organhistory.donor_report_id')->where('report_id',$req->report_id)->first();
                    if($organ_table->recipient_id != NULL)  //donation specific recipient
                    {
                        $oprove_table = DB::table('prove_for_organ')->where([['recipient_id',$organ_table->recipient_id],['Approval',1]])->first();
                        //uppercase for validation
                        $wroted_upr = strtoupper($req->organ_name); 
                        $table_upr = strtoupper($oprove_table->Organ_Name);
                        if($wroted_upr != $table_upr)
                        {
                            return "Cannot donate different organ other than requirement to a specific person";
                        }
                        else
                        {
                            $reci_prove = DB::table('prove_for_organ')->where('recipient_id',$req->recipient_id)->first();
                            if($req->blood_group == 'O-' || $reci_prove->Blood_Group == 'AB+' || $req->blood_group == $reci_prove->Blood_Group)
                            {
                                DB::table('organhistory')->where([['donor_id',$req->donor_id],['recipient_id',$req->recipient_id],['organ_name',NULL],['donor_report_id',$req->report_id]])->update(['organ_name'=>$wroted_upr]);    //update history

                                DB::table('prove_for_organ')->where('recipient_id',$req->recipient_id)->delete();
                            }
                            else
                            {
                                return "Irrelevent Blood Group";
                            }

                        }
                    }
                    else
                    {
                        $wroted_upr = strtoupper($req->organ_name); 
                        // relevent blood group most needy recipient
                        if( $req->blood_group != 'O-' )
                        {
                            $high_rating_reci = DB::table('prove_for_organ')->where([['Blood_Group','AB+'],['Organ_Name',$wroted_upr],['Approval',1]])->orWhere([['Blood_Group',$req->blood_group],['Organ_Name',$wroted_upr],['Approval',1]])->orderBy('Conclusion_rating','desc')->first();
                        }
                        else
                        {
                            $high_rating_reci = DB::table('prove_for_organ')->where([['Organ_Name',$wroted_upr],['Approval',1]])->orderBy('Conclusion_rating','desc')->first();
                        }

                        $table_upr = '--';
                        if($high_rating_reci != NULL)
                        {
                            $table_upr = strtoupper($high_rating_reci->Organ_Name);
                        }


                        if($high_rating_reci == NULL || $wroted_upr != $table_upr) //if no relevent recipient exist 
                        {
                            $wroted_upr = strtoupper($req->organ_name);
                            
                            $b_table = new organinventory;
                            $b_table->donor_id = $req->donor_id;
                            $b_table->report_id = $req->report_id;
                            $b_table->organ_name = $wroted_upr;
                            $b_table->save();

                            $total = 0;
                        }
                        else
                        {
                            $rec_id = $high_rating_reci->recipient_id;

                            DB::table('organhistory')->where([['donor_id',$req->donor_id],['recipient_id',NULL],['organ_name',NULL],['donor_report_id',$req->report_id]])->update(['recipient_id'=>$rec_id]);
                            DB::table('organhistory')->where([['donor_id',$req->donor_id],['recipient_id',$rec_id],['organ_name',NULL],['donor_report_id',$req->report_id]])->update(['organ_name'=>$wroted_upr]);    //update history
                        // return $table_upr;

                            DB::table('prove_for_organ')->where('recipient_id',$high_rating_reci->recipient_id)->delete();
                      
                        }
                    }
                }
                else
                {
                    DB::table('organhistory')->where([['donor_id',$req->donor_id],['recipient_id',$req->recipient_id],['quantity',0]])->delete();
                }

            $md_table = DB::table('medicalreport')->where('report_id',$req->report_id);
            $md_table->update(['blood_group'=>$req->blood_group]);
            $md_table->update(['compatibility'=>$req->compatibility]);

            $organ_table = DB::table('medicalreport')->join('organhistory','medicalreport.report_id','=','organhistory.donor_report_id')->where([['report_type','organ'],['compatibility',NULL]])->get();
            $panel = 'organ';
            return view('Admin_area.manage_appointments')->with('organ_table',$organ_table)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function mng_app_items()
    {
    	if(session()->has('data') && session()->get('user_type') == 'admin')
        {
        	$items_table = DB::table('itemhistory')->where('item_name',NULL)->get();
        	$panel = 'items';
            return view('Admin_area.manage_appointments')->with('items_table',$items_table)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function mnged_iapp(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
                $req->validate([
                    'item_name'=>'required',
                    'quantity'=>'required|min:0',
                    'condition'=>'required',
                 ]);


                
                if($req->condition > 2) // for good condition
                {
                    $items_table = DB::table('itemhistory')->where([['donor_id',$req->donor_id],['item_name',NULL]])->first();
                    if($items_table->recipient_id != NULL)  //for specific person donation
                    {
                        $reci_prove = DB::table('prove_for_items')->where([['recipient_id',$req->recipient_id],['Approval',1]])->first();
                        if($req->item_name != $reci_prove->Item_Name)
                        {
                            return "Donation of irrelevent Item";
                        }
                        if($req->quantity < 1)
                        {
                            return "Irrelevent Quantity";
                        }
                        elseif($req->quantity > $reci_prove->Quantity)
                        {
                            return "Cannot Donate more than requirement";
                        }
                        elseif($req->quantity == $reci_prove->Quantity)
                        {
                            $Ihistory_table = DB::table('itemhistory')->where([['donor_id',$req->donor_id],['recipient_id',$req->recipient_id],['quantity',0]]);
                            $Ihistory_table->update(['item_name'=>$req->item_name]);
                            $Ihistory_table->update(['quantity'=>$req->quantity]);

                            DB::table('prove_for_items')->where([['recipient_id',$req->recipient_id],['Approval',1]])->delete(); // recipient request has been fullfilled
                        }
                        else
                        {
                            $Ihistory_table = DB::table('itemhistory')->where([['donor_id',$req->donor_id],['recipient_id',$req->recipient_id],['quantity',0]]);
                            $Ihistory_table->update(['item_name'=>$req->item_name]);
                            $Ihistory_table->update(['quantity'=>$req->quantity]);

                            $new_quantity = $reci_prove->Quantity - $req->quantity;
                            DB::table('prove_for_items')->where([['recipient_id',$req->recipient_id],['Approval',1]])->update(['Quantity'=>$new_quantity]);
                        }
                    }
                    else            //for system way donation
                    {

                        if($req->quantity < 1)
                        {
                            return "Irrelevent Quantity";
                        }
                        $iname = strtoupper($req->item_name);
                        $total = $req->quantity;
                        while($total != 0)
                        {
                            $high_rating_reci = DB::table('prove_for_items')->where([['Item_Name',$iname],['Approval',1]])->orderBy('Conclusion_rating','desc')->first();
                            if($high_rating_reci != NULL)
                            {
                                $check_name = strtoupper($high_rating_reci->Item_Name);
                            }
                            if($high_rating_reci==NULL || $iname != $check_name)
                            {
                                $inv_item = new iteminventory;
                                $inv_item->donor_id = $req->donor_id;
                                $inv_item->item_name = $iname;
                                $inv_item->quantity = $total;
                                $inv_item->condition = $req->condition;
                                $inv_item->save();

                                DB::table('itemhistory')->where([['donor_id',$req->donor_id],['item_name',NULL]])->delete();
                                $total = 0;
                            }
                            else
                            {
                                if($total > $high_rating_reci->Quantity)
                                {
                                    DB::table('itemhistory')->where([['donor_id',$req->donor_id],['item_name',NULL],['quantity',0]])->update(['recipient_id'=>$high_rating_reci->recipient_id]);

                                    DB::table('itemhistory')->where([['donor_id',$req->donor_id],['recipient_id',$high_rating_reci->recipient_id],['item_name',NULL],['quantity',0]])->update(['item_name'=>$iname]);

                                    DB::table('itemhistory')->where([['donor_id',$req->donor_id],['recipient_id',$high_rating_reci->recipient_id],['item_name',$iname],['quantity',0]])->update(['quantity'=>$high_rating_reci->Quantity]);

                                    $total = $total - $high_rating_reci->Quantity;

                                    DB::table('prove_for_items')->where([['recipient_id',$high_rating_reci->recipient_id],['Item_Name',$iname],['Approval',1]])->delete(); // recipient request has been fullfilled
                                    $high_rating_reci = DB::table('prove_for_items')->where([['Item_Name',$iname],['Approval',1]])->orderBy('Conclusion_rating','desc')->first();

                                    if($high_rating_reci != NULL)
                                    {
                                        $itemhistory_table = new itemhistory;
                                        $itemhistory_table->donor_id = $req->donor_id;
                                        $itemhistory_table->quantity = 0;
                                        $itemhistory_table->save();
                                    }

                                }
                                elseif($total == $high_rating_reci->Quantity)
                                {
                                    DB::table('itemhistory')->where([['donor_id',$req->donor_id],['item_name',NULL],['quantity',0]])->update(['recipient_id'=>$high_rating_reci->recipient_id]);

                                    DB::table('itemhistory')->where([['donor_id',$req->donor_id],['recipient_id',$high_rating_reci->recipient_id],['item_name',NULL],['quantity',0]])->update(['item_name'=>$iname]);

                                    DB::table('itemhistory')->where([['donor_id',$req->donor_id],['recipient_id',$high_rating_reci->recipient_id],['item_name',$iname],['quantity',0]])->update(['quantity'=>$total]);

                                    DB::table('prove_for_items')->where([['recipient_id',$high_rating_reci->recipient_id],['Item_Name',$iname],['Approval',1]])->delete(); // recipient request has been fullfilled

                                    $total = 0;
                                }
                                else
                                {
                                    DB::table('itemhistory')->where([['donor_id',$req->donor_id],['item_name',NULL],['quantity',0]])->update(['recipient_id'=>$high_rating_reci->recipient_id]);

                                    DB::table('itemhistory')->where([['donor_id',$req->donor_id],['recipient_id',$high_rating_reci->recipient_id],['item_name',NULL],['quantity',0]])->update(['item_name'=>$iname]);

                                    DB::table('itemhistory')->where([['donor_id',$req->donor_id],['recipient_id',$high_rating_reci->recipient_id],['item_name',$iname],['quantity',0]])->update(['quantity'=>$total]);

                                    $new_quantity = $high_rating_reci->Quantity - $total;
                                    DB::table('prove_for_items')->where([['recipient_id',$high_rating_reci->recipient_id],['Item_Name',$iname],['Approval',1]])->update(['Quantity'=>$new_quantity]);

                                    $total = 0;
                                }
                            }
                        }
                    }
                }
                else
                {
                    DB::table('itemhistory')->where([['donor_id',$req->donor_id],['item_name',NULL],['quantity',0]])->delete();
                }

            $items_table = DB::table('itemhistory')->where('item_name',NULL)->get();
            $panel = 'items';
            return view('Admin_area.manage_appointments')->with('items_table',$items_table)->with('panel',$panel);
        }
        return redirect('login');
    }
    

    public function mng_req_blood()
    {
    	if(session()->has('data') && session()->get('user_type') == 'admin')
        {
        	$pblood_table = DB::table('prove_for_blood')->where('Approval',0)->get();	//proves of blood table
        	$panel = 'blood';
            return view('Admin_area.manage_request')->with('pblood_table',$pblood_table)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function mnged_breq(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
            if($req->approval == 'approve')
            {
            	DB::table('prove_for_blood')->where('recipient_id',$req->recipient_id)->update(['Approval'=>1]);

                $current_req = DB::table('prove_for_blood')->where([['recipient_id',$req->recipient_id],['Approval',1]])->first();

                $total = $current_req->Quantity_ltr;
                while($total != 0)
                {
                    if($current_req->Blood_Group != 'AB+')
                    {
                        $blood_inv = DB::table('bloodinventory')->join('medicalreport','bloodinventory.report_id','=','medicalreport.report_id')->where('blood_group','O-')->orWhere('blood_group',$current_req->Blood_Group)->first();
                    }
                    else
                    {
                        $blood_inv = DB::table('bloodinventory')->join('medicalreport','bloodinventory.report_id','=','medicalreport.report_id')->first();
                    }
                    if($blood_inv == NULL)
                    {
                        $total = 0;
                    }
                    else
                    {
                        if($blood_inv->quantity > $total)
                        {
                            $new_quantity = $blood_inv->quantity - $total;

                            DB::table('bloodinventory')->where([['blood_id',$blood_inv->blood_id],['report_id',$blood_inv->report_id]])->update(['quantity'=>$new_quantity]);

                            DB::table('bloodhistory')->where([['donor_id',$blood_inv->donor_id],['donor_report_id',$blood_inv->report_id]])->update(['recipient_id'=>$req->recipient_id]);

                            DB::table('bloodhistory')->where([['donor_id',$blood_inv->donor_id],['donor_report_id',$blood_inv->report_id]])->update(['quantity'=>$total]);

                            DB::table('prove_for_blood')->where([['recipient_id',$req->recipient_id],['Approval',1]])->delete();

                            $total = 0;
                        }
                        elseif($blood_inv->quantity == $total)
                        {
                            DB::table('bloodinventory')->where([['blood_id',$blood_inv->blood_id],['report_id',$blood_inv->report_id]])->delete();

                            DB::table('bloodhistory')->where([['donor_id',$blood_inv->donor_id],['donor_report_id',$blood_inv->report_id]])->update(['recipient_id'=>$req->recipient_id]);

                            DB::table('bloodhistory')->where([['donor_id',$blood_inv->donor_id],['donor_report_id',$blood_inv->report_id]])->update(['quantity'=>$total]);

                            DB::table('prove_for_blood')->where([['recipient_id',$req->recipient_id],['Approval',1]])->delete();

                            $total = 0;
                        }
                        else
                        {
                            $total = $total - $blood_inv->quantity;

                            DB::table('prove_for_blood')->where([['recipient_id',$req->recipient_id],['Approval',1]])->update(['Quantity_ltr'=>$total]);

                            DB::table('bloodinventory')->where([['blood_id',$blood_inv->blood_id],['report_id',$blood_inv->report_id]])->delete();

                            DB::table('bloodhistory')->where([['donor_id',$blood_inv->donor_id],['donor_report_id',$blood_inv->report_id]])->update(['recipient_id'=>$req->recipient_id]);

                            DB::table('bloodhistory')->where([['donor_id',$blood_inv->donor_id],['donor_report_id',$blood_inv->report_id]])->update(['quantity'=>$blood_inv->quantity]);

                        }
                    }

                }
            }
            elseif($req->approval == 'reject')
            {
            	DB::table('prove_for_blood')->where('recipient_id',$req->recipient_id)->delete();
            }

            $pblood_table = DB::table('prove_for_blood')->where('Approval',0)->get();	//proves of blood table
            $panel = 'blood';
            return view('Admin_area.manage_request')->with('pblood_table',$pblood_table)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function mng_req_organ()
    {
    	if(session()->has('data') && session()->get('user_type') == 'admin')
        {
        	$porgan_table = DB::table('prove_for_organ')->where('Approval',0)->get();	//proves of organ table
        	$panel = 'organ';
            return view('Admin_area.manage_request')->with('porgan_table',$porgan_table)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function mnged_oreq(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
            if($req->approval == 'approve')
            {
            	DB::table('prove_for_organ')->where('recipient_id',$req->recipient_id)->update(['Approval'=>1]);

                $current_req = DB::table('prove_for_organ')->where([['recipient_id',$req->recipient_id],['Approval',1]])->first();

                $c_upr = strtoupper($current_req->Organ_Name);

                if($current_req->Blood_Group != 'AB+')
                {
                    $organ_inv = DB::table('organinventory')->join('medicalreport','organinventory.report_id','=','medicalreport.report_id')->where([['blood_group','O-'],['organ_name',$c_upr]])->orWhere('blood_group',$current_req->Blood_Group)->first();
                }
                else
                {
                    $organ_inv = DB::table('organinventory')->join('medicalreport','organinventory.report_id','=','medicalreport.report_id')->where('organ_name',$c_upr)->first();
                }
                if($organ_inv != NULL)
                {
                        DB::table('organinventory')->where([['organ_id',$organ_inv->organ_id],['report_id',$organ_inv->report_id]])->delete();

                        DB::table('organhistory')->where([['donor_id',$organ_inv->donor_id],['donor_report_id',$organ_inv->report_id]])->update(['recipient_id'=>$req->recipient_id]);

                        DB::table('organhistory')->where([['donor_id',$organ_inv->donor_id],['donor_report_id',$organ_inv->report_id]])->update(['organ_name'=>$c_upr]);

                        DB::table('prove_for_organ')->where([['recipient_id',$req->recipient_id],['Approval',1]])->delete();                    
                }

                
            }
            elseif($req->approval == 'reject')
            {
            	DB::table('prove_for_organ')->where('recipient_id',$req->recipient_id)->delete();
            }

            $porgan_table = DB::table('prove_for_organ')->where('Approval',0)->get();	//proves of organ table
            $panel = 'organ';
            return view('Admin_area.manage_request')->with('porgan_table',$porgan_table)->with('panel',$panel);
        }
        return redirect('login');
    }


    public function mng_req_items()
    {
    	if(session()->has('data') && session()->get('user_type') == 'admin')
        {
        	$pitems_table = DB::table('prove_for_items')->where('Approval',0)->get();	//proves of items table
        	$panel = 'items';
            return view('Admin_area.manage_request')->with('pitems_table',$pitems_table)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function mnged_ireq(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
            if($req->approval == 'approve')
            {
            	DB::table('prove_for_items')->where('recipient_id',$req->recipient_id)->update(['Approval'=>1]);

                $current_req = DB::table('prove_for_items')->where([['recipient_id',$req->recipient_id],['Approval',1]])->first();

                $total = $current_req->Quantity;
                while($total != 0)
                {
                    
                    $item_inv = DB::table('iteminventory')->where('item_name',$current_req->Item_Name)->first();
                    
                    if($item_inv == NULL)
                    {
                        $total = 0;
                    }
                    else
                    {
                        if($item_inv->quantity > $total)
                        {
                            $new_quantity = $item_inv->quantity - $total;

                            DB::table('iteminventory')->where('item_id',$item_inv->item_id)->update(['quantity'=>$new_quantity]);

                            $new_item_history = new itemhistory;
                            $new_item_history->donor_id = $item_inv->donor_id;
                            $new_item_history->recipient_id = $req->recipient_id;
                            $new_item_history->item_name = $current_req->Item_Name;
                            $new_item_history->quantity = $total;
                            $new_item_history->save();

                            DB::table('prove_for_items')->where([['recipient_id',$req->recipient_id],['Item_Name',$current_req->Item_Name],['Approval',1]])->delete();

                            $total = 0;
                        }
                        elseif($item_inv->quantity == $total)
                        {
                            DB::table('iteminventory')->where('item_id',$item_inv->item_id)->delete();

                            $new_item_history = new itemhistory;
                            $new_item_history->donor_id = $item_inv->donor_id;
                            $new_item_history->recipient_id = $req->recipient_id;
                            $new_item_history->item_name = $current_req->Item_Name;
                            $new_item_history->quantity = $total;
                            $new_item_history->save();

                            DB::table('prove_for_items')->where([['recipient_id',$req->recipient_id],['Item_Name',$current_req->Item_Name],['Approval',1]])->delete();

                            $total = 0;
                        }
                        else
                        {
                            $total = $total - $item_inv->quantity;

                            DB::table('prove_for_items')->where([['recipient_id',$req->recipient_id],['Item_Name',$current_req->Item_Name],['Approval',1]])->update(['Quantity'=>$total]);

                            DB::table('iteminventory')->where('item_id',$item_inv->item_id)->delete();

                            $new_item_history = new itemhistory;
                            $new_item_history->donor_id = $item_inv->donor_id;
                            $new_item_history->recipient_id = $req->recipient_id;
                            $new_item_history->item_name = $current_req->Item_Name;
                            $new_item_history->quantity = $item_inv->quantity;
                            $new_item_history->save();
                        }
                    }

                }
            }
            elseif($req->approval == 'reject')
            {
            	DB::table('prove_for_items')->where('recipient_id',$req->recipient_id)->delete();
            }

            $pitems_table = DB::table('prove_for_items')->where('Approval',0)->get();	//proves of items table
            $panel = 'items';
            return view('Admin_area.manage_request')->with('pitems_table',$pitems_table)->with('panel',$panel);
        }
        return redirect('login');
    }


    public function mng_req_money()
    {
    	if(session()->has('data') && session()->get('user_type') == 'admin')
        {
        	$pmoney_table = DB::table('prove_for_money')->where('Approval',0)->get();	//proves of money table
        	$panel = 'money';
            return view('Admin_area.manage_request')->with('pmoney_table',$pmoney_table)->with('panel',$panel);
        }
        return redirect('login');
    }

    public function mnged_mreq(request $req)
    {
        if(session()->has('data') && session()->get('user_type') == 'admin')
        {
            if($req->approval == 'approve')
            {
            	DB::table('prove_for_money')->where('recipient_id',$req->recipient_id)->update(['Approval'=>1]);

                $current_req = DB::table('prove_for_money')->where([['recipient_id',$req->recipient_id],['Approval',1]])->first();

                $total = $current_req->Amount;
                while($total != 0)
                {
                    
                    $money_inv = DB::table('moneyinventory')->first();
                    
                    if($money_inv == NULL)
                    {
                        $total = 0;
                    }
                    else
                    {
                        if($money_inv->amount > $total)
                        {
                            $new_amount = $money_inv->amount - $total;

                            DB::table('moneyinventory')->where('money_id',$money_inv->money_id)->update(['amount'=>$new_amount]);

                            $new_item_history = new moneyhistory;
                            $new_item_history->donor_id = $money_inv->donor_id;
                            $new_item_history->recipient_id = $req->recipient_id;
                            $new_item_history->amount = $total;
                            $new_item_history->save();

                            DB::table('prove_for_money')->where([['recipient_id',$req->recipient_id],['Approval',1]])->delete();

                            $total = 0;
                        }
                        elseif($money_inv->amount == $total)
                        {
                            DB::table('moneyinventory')->where('money_id',$money_inv->money_id)->delete();

                            $new_item_history = new moneyhistory;
                            $new_item_history->donor_id = $money_inv->donor_id;
                            $new_item_history->recipient_id = $req->recipient_id;
                            $new_item_history->amount = $total;
                            $new_item_history->save();

                            DB::table('prove_for_money')->where([['recipient_id',$req->recipient_id],['Amount',$current_req->Amount],['Approval',1]])->delete();

                            $total = 0;
                        }
                        else
                        {
                            $total = $total - $money_inv->amount;

                            DB::table('prove_for_money')->where([['recipient_id',$req->recipient_id],['Approval',1]])->update(['Amount'=>$total]);

                            DB::table('moneyinventory')->where('money_id',$money_inv->money_id)->delete();

                            $new_item_history = new moneyhistory;
                            $new_item_history->donor_id = $money_inv->donor_id;
                            $new_item_history->recipient_id = $req->recipient_id;
                            $new_item_history->amount = $money_inv->amount;
                            $new_item_history->save();
                        }
                    }

                }


            }
            elseif($req->approval == 'reject')
            {
            	DB::table('prove_for_money')->where('recipient_id',$req->recipient_id)->delete();
            }

            $pmoney_table = DB::table('prove_for_money')->where('Approval',0)->get();	//proves of money table
            $panel = 'money';
            return view('Admin_area.manage_request')->with('pmoney_table',$pmoney_table)->with('panel',$panel);
        }
        return redirect('login');
    }


    public function viewProof(request $req)
    {
            $pic = $req;
            return view('Admin_area.viewProof')->with('pic',$pic);
    }

}
