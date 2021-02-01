<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUp;
use App\Http\Controllers\Donor_Con;
use App\Http\Controllers\Admin_Con;
use App\Http\Controllers\proves_Con;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::view('/',"welcome");
Route::view('Ahmedfoundation.com',"homepage");
Route::view('thank_you',"thank_you");
Route::view('appt_set',"appointment_set");
Route::view('error',"errorpage");
Route::view('error2',"error_invalid_id");
Route::view('sample',"sample");


Route::get('D_profile',[Donor_Con::class,'profile_view']);
Route::get('D_Profile_Appointment',[Donor_Con::class,'DP_App']);
Route::get('D_Profile_Donation_history',[Donor_Con::class,'DP_DonationHistroy']);

Route::get('D_Profile_Settings',[Donor_Con::class,'DP_Settings']);
Route::get('check_profile',[Donor_Con::class,'DP_Settings']);
Route::get('change_Pinfo',[Donor_Con::class,'change_Pinfo']);
Route::post('change_dinfo',[Donor_Con::class,'change_dinfo']);
Route::get('update_Pcardinfo',[Donor_Con::class,'update_Pcardinfo']);
Route::post('updated_cardinfo',[Donor_Con::class,'updated_cardinfo']);

Route::get('change_dpass',[Donor_Con::class,'change_dpass']);
Route::post('change_dpassword',[Donor_Con::class,'change_dpassword']);

Route::view('signup_phaseone',"signup_phaseone");
Route::post("signup_phaseone",[SignUp::class,'signupp']);

Route::view('donation',"donation");
Route::view('recipient',"recipient");

Route::post("login",[SignUp::class,'login']);
Route::get('login',[SignUp::class,'login_check']);

Route::get('donation',[SignUp::class,'donor']);
// Route::get('recipient',[SignUp::class,'recipient']);

Route::get('logout',[SignUp::class,'logout']);





Route::get('blood_donation',[Donor_Con::class,'blood_donate']);
Route::post('set_bapp',[Donor_Con::class,'set_bloodappointment_sys']);
Route::post('set_bapp_spec',[Donor_Con::class,'set_bloodappointment_spec']);

Route::get('organ_donation',[Donor_Con::class,'organ_donate']);
Route::post('set_oapp',[Donor_Con::class,'set_organappointment_sys']);
Route::post('set_oapp_spec',[Donor_Con::class,'set_organappointment_spec']);

Route::get('item_donation',[Donor_Con::class,'item_donate']);
Route::post('set_isapp',[Donor_Con::class,'set_itemappointment_sys']);
Route::post('set_isapp_spec',[Donor_Con::class,'set_itemappointment_spec']);

Route::get('money_donation',[Donor_Con::class,'money_donate']);
Route::post('payment_area',[Donor_Con::class,'payment_area']);
Route::post('donate_now',[Donor_Con::class,'thank_you']);
Route::get('remove_card',[Donor_Con::class,'RemoveCard']);

Route::view('invoice',"invoice");




Route::get('admin',[Admin_Con::class,'admin_view']);

Route::get('mng_donor',[Admin_Con::class,'mng_donor']);
Route::get('mng_recipient',[Admin_Con::class,'mng_recipient']);
Route::post('mnged_user',[Admin_Con::class,'deleteorblock_user']);
Route::get('mng_blockuser',[Admin_Con::class,'mng_blockuser']);
Route::post('Removeblock_user',[Admin_Con::class,'Removeblock_user']);

Route::get('mng_app_blood',[Admin_Con::class,'mng_app_blood']);
Route::post('mnged_bapp',[Admin_Con::class,'mnged_bapp']);

Route::get('mng_app_organ',[Admin_Con::class,'mng_app_organ']);
Route::post('mnged_oapp',[Admin_Con::class,'mnged_oapp']);

Route::get('mng_app_items',[Admin_Con::class,'mng_app_items']);
Route::post('mnged_iapp',[Admin_Con::class,'mnged_iapp']);

Route::get('mng_req_blood',[Admin_Con::class,'mng_req_blood']);
Route::post('mnged_breq',[Admin_Con::class,'mnged_breq']);

Route::get('mng_req_organ',[Admin_Con::class,'mng_req_organ']);
Route::post('mnged_oreq',[Admin_Con::class,'mnged_oreq']);

Route::get('mng_req_items',[Admin_Con::class,'mng_req_items']);
Route::post('mnged_ireq',[Admin_Con::class,'mnged_ireq']);

Route::get('mng_req_money',[Admin_Con::class,'mng_req_money']);
Route::post('mnged_mreq',[Admin_Con::class,'mnged_mreq']);

Route::post('viewProof',[Admin_Con::class,'viewProof']);

Route::get('view_blood_history',[Admin_Con::class,'view_blood_history']);
Route::get('view_items_history',[Admin_Con::class,'view_items_history']);
Route::get('view_money_history',[Admin_Con::class,'view_money_history']);
Route::get('view_organ_history',[Admin_Con::class,'view_organ_history']);

Route::get('view_blood_inv',[Admin_Con::class,'view_blood_inv']);
Route::get('view_items_inv',[Admin_Con::class,'view_items_inv']);
Route::get('view_money_inv',[Admin_Con::class,'view_money_inv']);
Route::get('view_organ_inv',[Admin_Con::class,'view_organ_inv']);




Route::view('Blood_priority',"Recipient.Blood_priority");
Route::post("Blood_priority",[Proves_Con::class,'BloodPriorityValue']);

Route::view('Items_priority',"Recipient.Items_priority");
Route::post("Items_priority",[Proves_Con::class,'ItemPriorityValue']);

Route::view('Money_priority',"Recipient.Money_priority");
Route::post("Money_priority",[Proves_Con::class,'MoneyPriorityValue']);

Route::view('Organ_priority',"Recipient.Organ_priority");
Route::post("Organ_priority",[Proves_Con::class,'OrganPriorityValue']);



Route::view('Prove_blood',"Recipient.Prove_blood");
Route::post("Prove_blood",[Proves_Con::class,'BloodData']);

// Route::view('recipient',"Recipient.Prove_blood");
// Route::post("recipient",[Proves_Con::class,'BloodData']);

Route::view('Prove_money',"Recipient.Prove_Money");
Route::post("Prove_money",[Proves_Con::class,'MoneyData']);

Route::view('Prove_organ',"Recipient.Prove_organ");
Route::post("Prove_organ",[Proves_Con::class,'OrganData']);

Route::view('Prove_item',"Recipient.Prove_item");
Route::post("Prove_item",[Proves_Con::class,'ItemData']);

Route::get("Submit_Request",[Proves_Con::class,'submitted_request']);

Route::get("R_Profile_Requests",[Proves_Con::class,'R_Profile_Requests']);
Route::get("R_Profile_Donation_history",[Proves_Con::class,'R_Profile_Donation_history']);
Route::get("R_Profile_Settings",[Proves_Con::class,'R_Profile_Settings']);

Route::get("Rcheck_profile",[Proves_Con::class,'R_Profile_Settings']);
Route::get("Rchange_Pinfo",[Proves_Con::class,'Rchange_Pinfo']);
Route::post("change_rinfo",[Proves_Con::class,'change_rinfo']);
Route::get("Rupdate_Pcardinfo",[Proves_Con::class,'Rupdate_Pcardinfo']);
Route::post("Rupdated_cardinfo",[Proves_Con::class,'Rupdated_cardinfo']);
Route::get("Rchange_pass",[Proves_Con::class,'Rchange_pass']);
Route::post("change_rpassword",[Proves_Con::class,'change_rpassword']);
