<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topup;
use App\Models\Load;
use App\Models\Amount;
use App\Models\User;
use App\Models\Package;


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

    public function loadNow(Request $request)
    {
        $validatedData = $request->validate([
            'network' => 'required',
            'number' => 'required',
        ]);
        $amount = Amount::find($request->amount);

        if($request->payment_method == 'amount')
        {
            $load = load($request->number,$amount->baht,$request->network);
            if(isset($load['error'])){
                return $load;
            }
            DB::beginTransaction();
            try {
                $client = auth()->user();
                $newLoad = new Load;
                $newLoad->amount_id = $request->amount;
                $newLoad->number = $request->number;
                $newLoad->network_id = $request->network;
                $newLoad->mop = $request->payment_method;
                $newLoad->user_id = $client->id;
                $newLoad->type = 'Amount';
                $newLoad->status = $load['status'];
                $newLoad->save();

                $user = User::find($client->id);
                $user->balance = $user->balance - $amount->baht;
                $user->save();
    
                $history = new History;
                $history->user_id = $client->id;
                $history->event = "Load";
                $history->amount = $amount->baht;
                $history->number = $request->number;
                $history->mop = $request->payment_method;
                $history->status = $load['status'];
                $history->save();
                DB::commit();

            } catch (\Exception $e) {
                // Handle other exceptions
                DB::rollBack();
                return response()->json(['error' => $e->getMessage()], 500);
            }

            

            return $load;
        }

        if($request->payment_method == 'package')
        {
            $package = Package::find($request->package);
            $load = loadPackage($request->number,$package->code);
            if(isset($load['error'])){  
                return $load;
            }

            DB::beginTransaction();
            try {
                $client = auth()->user();
                $newLoad = new Load;
                $newLoad->package_id = $request->package;
                $newLoad->number = $request->number;
                $newLoad->network_id = $request->network;
                $newLoad->mop = $request->payment_method;
                $newLoad->user_id = $client->id;
                $newLoad->type = 'Amount';
                $newLoad->status = $load['status'];
                $newLoad->save();

                $user = User::find($client->id);
                $user->balance = $user->balance - $package->baht;
                $user->save();
    
                $history = new History;
                $history->user_id = $client->id;
                $history->event = "Load";
                $history->amount = $package->baht;
                $history->number = $request->number;
                $history->mop = $request->payment_method;
                $history->status = $load['status'];
                $history->save();
                DB::commit();

            } catch (\Exception $e) {
                // Handle other exceptions
                DB::rollBack();
                return response()->json(['error' => $e->getMessage()], 500);
            }

            return $load;
        }
    }
}
