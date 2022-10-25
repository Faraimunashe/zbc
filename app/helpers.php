<?php

use App\Models\Account;
use App\Models\License;
use App\Models\LicensePenalty;
use App\Models\LicensePrice;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

function get_account($user_id){
    return Account::where('user_id', $user_id)->first();
}

function get_account_number($user_id){
    $account = Account::where('user_id', $user_id)->first();

    return $account->accnum;
}

function get_trans_status($num){
    $status = new stdClass();
    if($num === 2){
        $status->label = "pending";
        $status->badge = "warning";
    }elseif($num === 1){
        $status->label = "approved";
        $status->badge = "success";
    }else{
        $status->label = "rejected";
        $status->badge = "danger";
    }

    return $status;
}

function get_user($id){
    return User::find($id);
}

function is_licensed($acc_id){
    $license = License::where('acc_id', $acc_id)
        ->where('status', 1)
        ->first();
    if(is_null($license))
    {
        return false;
    }else{
        return true;
    }
}

function get_penalty()
{
    $penalty = LicensePenalty::first();
    if(is_null($penalty))
    {
        $penalty = new stdClass();
        $penalty->percentage_rate = 0;
        $penalty->period = 0;

        return $penalty;
    }

    return $penalty;
}

function count_account(){
    $count = User::join('role_user', 'role_user.user_id', '=', 'users.id')
    ->where('role_user.role_id', '!=', 1)
    ->count();

    return $count;
}

function count_transactions(){
    return Transaction::count();
}

function count_valid_licenses(){
    return License::where('status', 1)->count();
}

function get_revenue(){
    $revenue = Transaction::where('status', 1)->sum('amount');
    return $revenue;
}

function get_license_prices(){
    return LicensePrice::all();
}

function calculate_penalty($acc_id, $price_id){
    $old_license = License::where('acc_id', $acc_id)->orderBy('created_at', 'desc')->first();
    if(is_null($old_license))
    {
        return 0;
    }else{
        if($old_license->status == 0)
        {
            $toDate = Carbon::now();
            $fromDate = Carbon::parse($old_license->valid_until);
            $days = $toDate->diffInDays($fromDate);

            $penalty = get_penalty();

            $period = intdiv($days, $penalty->period);

            if($period == 0)
            {
                return 0;
            }else{
                $prices = LicensePrice::find($price_id);
                $penalty_amount = ($prices->amount * ($penalty->percentage_rate/100)) * $period;
                return $penalty_amount;
            }
        }else{
            return 0;
        }
    }
}

function paid_license($acc_id, $amount, $period, $price_id){ //returns void
    $license = License::where('acc_id', $acc_id)->where('status', 1)->first();

    $valid_until = Carbon::now()->addDays($period);

    if(is_null($license))
    {
        $lic = new License();
        $lic->acc_id = $acc_id;
        $lic->amount = $amount;
        $lic->period = $period;
        $lic->penalt_amount = calculate_penalty($acc_id, $price_id);
        $lic->valid_until = $valid_until;
        $lic->status = 1;
        $lic->reference = rand(1000000000,9999999999);
        $lic->save();
    }else{
        $license->amount = $license->amount + $amount;
        $license->period = $license->period + $period;
        $license->penalt_amount = 0;
        $license->valid_until = Carbon::parse($license->valid_until)->addDays($period);
        $license->save();
    }
}

function get_latest_license($acc_id){
    return License::where('acc_id', $acc_id)->orderBy('created_at', 'desc')->first();
}

function license_status($num){
    $status = new stdClass();
    if($num === 1){
        $status->label = "valid";
        $status->badge = "success";
    }else{
        $status->label = "expired";
        $status->badge = "danger";
    }

    return $status;
}


