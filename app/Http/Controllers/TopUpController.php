<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topup;
use App\Models\History;

use Illuminate\Support\Facades\Auth;
use DB;
class TopUpController extends Controller
{
    public function topup(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required',
            'payment_method' => 'required',
        ]);
        DB::beginTransaction();
        try {
        $client = auth()->user();
        $topup = new Topup;
        $topup->amount = $request->amount;
        $topup->mop = $request->payment_method;
        $topup->user_id = $client->id;
        $topup->status = 'Pending';

        $history = new History;
        $history->user_id = $client->id;
        $history->event = "Topup Request";
        $history->amount = $request->amount;
        $history->number = "0";
        $history->mop = $request->payment_method;
        $history->status = "Requested";
        $history->save();




        if ($request->hasFile('transaction_receipt')) {
            $imagePath = $request->file('transaction_receipt')->store('receipts', 'public');
            $topup->receipt = $imagePath;
        }
        $topup->save();
        DB::commit();

        return response()->json(['message' => 'success', 'data' => $topup], 200);

        } catch (\Exception $e) {
            // Handle other exceptions
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }


        
    }
}
