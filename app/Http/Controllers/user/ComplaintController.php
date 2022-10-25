<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::where('user_id', Auth::id())->latest()->paginate(10);
        return view('user.complaints', [
            'complaints' => $complaints
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'message' => ['required', 'string']
        ]);

        try{
            $complaint = new Complaint();
            $complaint->user_id = Auth::id();
            $complaint->message = $request->message;

            $complaint->save();
            return redirect()->back()->with('success', 'Successfully posted complain.');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
