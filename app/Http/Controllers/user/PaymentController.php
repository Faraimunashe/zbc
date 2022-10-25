<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\LicensePrice;
use App\Models\Paynowlog;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        return view('user.payment');
    }

    public function payment(Request $request)
    {
        $request->validate([
            'price_id' => ['required', 'integer'],
            'phone' => ['required', 'digits:10', 'starts_with:07'],
            'email' => ['email', 'required']
        ]);

        $wallet = "ecocash";

        //price
        $lprice = LicensePrice::find($request->price_id);

        //get all data ready
        $email = $request->email;
        $phone = $request->phone;
        $amount = $lprice->amount;

        //account
        $account = Account::where('user_id', Auth::id())->first();

        /*determine type of wallet*/
        if (strpos($phone, '071') === 0) {
            $wallet = "onemoney";
        }

        $paynow = new \Paynow\Payments\Paynow(
            "11336",
            "1f4b3900-70ee-4e4c-9df9-4a44490833b6",
            route('user-add-payment'),
            route('user-add-payment'),
        );

        // Create Payments
        $invoice_name = "zbc_radio_and tv_license" . time();
        $payment = $paynow->createPayment($invoice_name, $email);

        $payment->add("ZBC License", $amount);

        $response = $paynow->sendMobile($payment, $phone, $wallet);


        // Check transaction success
        if ($response->success()) {

            $timeout = 9;
            $count = 0;

            while (true) {
                sleep(3);
                // Get the status of the transaction
                // Get transaction poll URL
                $pollUrl = $response->pollUrl();
                $status = $paynow->pollTransaction($pollUrl);


                //Check if paid
                if ($status->paid()) {
                    // Yay! Transaction was paid for
                    // You can update transaction status here
                    // Then route to a payment successful
                    $info = $status->data();

                    $paynowdb = new Paynowlog();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();

                    //transaction update
                    $trans = new Transaction();
                    $trans->user_id = Auth::id();
                    $trans->reference = $info['paynowreference'];
                    $trans->action = "license";
                    $trans->method = "paynow";
                    $trans->amount = $info['amount'];
                    $trans->status = 1;
                    $trans->save();
                    try{
                    paid_license($account->id, $amount, $lprice->period, $request->price_id);
                    }catch(Exception $e){
                        return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
                    }

                    return redirect()->back()->with('success', 'Succesfully paid license fee');
                }


                $count++;
                if ($count > $timeout) {
                    $info = $status->data();

                    $paynowdb = new Paynowlog();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();

                    $trans_status = 2;
                    if($info['status'] != 'sent')
                    {
                        $trans_status = 0;
                    }
                    //transaction update
                    $trans = new Transaction();
                    $trans->user_id = Auth::id();
                    $trans->reference = $info['paynowreference'];
                    $trans->action = "license";
                    $trans->method = "paynow";
                    $trans->amount = $info['amount'];
                    $trans->status = $trans_status;
                    $trans->save();

                    return redirect()->back()->with('error', 'Taking too long wait a moment and refresh');
                } //endif
            } //endwhile
        } //endif


        //total fail
        return redirect()->back()->with('error', 'Cannot perform transaction at the moment');


    }
}
