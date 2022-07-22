<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Rules\UserHasEnoughBalanceToTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Utils;

class TransactionController extends Controller
{
    public function transfer(Request $request)
    {
        return $request->validate([
            'user_id' => ['required', 'numeric', 'exists:users,id', function ($attribute, $value, $fail) {
                if ($value === \Auth::id()) {
                    $fail('The ' . $attribute . ' is invalid. you cant transfer to yourself');
                }
            },],
            'amount' => ['required', 'numeric', new UserHasEnoughBalanceToTransfer(\Auth::id())],
            'pin' => ['required', 'string', function ($attribute, $value, $fail) {
                if(!Hash::check($value ,auth()->user()->pin)) {
                    $fail("Wrong Password");
                }
            }]
        ]);

        DB::beginTransaction();

        try {
            Transaction::create([
                'from' => \Auth::id(),
                'to' => $request->user_id,
                'amount' => $request->amount
            ]);

            \Auth::user()->update(['balance' => \Auth::user()->balance - $request->amount]);

            $recipient = User::findOrFail($request->user_id);
            $recipient->update(['balance' => $recipient->balance + $request->amount]);

            DB::commit();

            return response()->json('successfully transferred');

        } catch (\Exception $error) {
            DB::rollBack();

            return response()->json('something went wrong', 500);
        }
    }

    public function index(){
        $transactions = User::with('sentTransactions.toUser', 'receivedTransactions.fromUser')->find(\Auth::id());
//        return $transactions;
        $sentTransactions = $transactions->sentTransactions;
//        return $sentTransactions;
        $receivedTransactions = $transactions->receivedTransactions;
//        return $receivedTransactions;

        return collect([...$sentTransactions, ...$receivedTransactions])->sortBy('created_at')->map(function ($transaction) {
            $toUserName = optional($transaction->toUser)->name;
            $fromUserName = optional($transaction->fromUser)->name;
            unset($transaction->toUser);
            unset($transaction->fromUser);

            $transaction->to_user  = $toUserName;
            $transaction->from_user = $fromUserName;
            return $transaction;
        })->values();

    }
}
