<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LicensePenalty;
use App\Models\LicensePrice;
use Exception;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index()
    {
        $prices = LicensePrice::all();

        return view('admin.licenses', [
            'prices' => $prices
        ]);
    }

    public function add_price(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric'],
            'period' => ['required', 'integer'],
            'name' => ['required', 'string']
        ]);
        try{
            $price = new LicensePrice();

            $price->amount = $request->amount;
            $price->period = $request->period;
            $price->name = $request->name;
            $price->save();

            return redirect()->back()->with('success', 'Successfully updated price details');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }

    public function edit_price(Request $request)
    {
        $request->validate([
            'price_id' => ['required', 'integer'],
            'amount' => ['required', 'numeric'],
            'period' => ['required', 'integer'],
            'name' => ['required', 'string']
        ]);
        try{
            $price = LicensePrice::find($request->price_id);
            if(is_null($price))
            {
                return redirect()->back()->with('error', 'Could not find specified price id');
            }

            $price->amount = $request->amount;
            $price->period = $request->period;
            $price->name = $request->name;
            $price->save();

            return redirect()->back()->with('success', 'Successfully updated price details');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }

    public function delete_price(Request $request)
    {
        $request->validate([
            'price_id' => ['required', 'integer']
        ]);
        try{
            $price = LicensePrice::find($request->price_id);
            if(is_null($price))
            {
                return redirect()->back()->with('error', 'Could not find specified price id');
            }
            $price->delete();

            return redirect()->back()->with('success', 'Successfully deleted price details');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }

    public function update_penalty(Request $request)
    {
        $request->validate([
            'percentage_rate' => ['required', 'numeric'],
            'period' => ['required', 'integer']
        ]);

        $penalty = LicensePenalty::first();
        if(is_null($penalty))
        {
            try{
                $penalty = new LicensePenalty();
                $penalty->percentage_rate = $request->percentage_rate;
                $penalty->period = $request->period;
                $penalty->save();

                return redirect()->back()->with('success', 'Successfully added a license penalty fee');
            }catch(Exception $e){
                return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
            }
        }else{
            try{
                $penalty->percentage_rate = $request->percentage_rate;
                $penalty->period = $request->period;
                $penalty->save();

                return redirect()->back()->with('success', 'Successfully updated a license penalty fee');
            }catch(Exception $e){
                return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
            }
        }
    }
}
