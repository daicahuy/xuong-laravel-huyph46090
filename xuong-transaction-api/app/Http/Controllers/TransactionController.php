<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transaction.index');
    }


    public function step1()
    {
        if (session()->has('transaction')) {
            session()->put([
                'transaction.status' => Transaction::STATUS_PENDING,
                'transaction.step' => 1
            ]);
        }

        return view('transaction.step1');
    }

    public function handleStep1(Request $request)
    {

        $data = $request->validate([
            'amount' => 'required',
            'receiver_account' => 'required|numeric|integer|max_digits:9',
        ]);


        if (session()->has('transaction')) {

            session()->put([
                'transaction.amount' => $data['amount'],
                'transaction.receiver_account' => $data['receiver_account'],
            ]);

            return redirect()->route('transaction.step2');
        }


        session()->put('transaction', [
            'transaction_id' => uniqid(),
            'status' => Transaction::STATUS_PENDING,
            'step' => 2
        ] + $data);

        return redirect()->route('transaction.step2');
    }




    public function step2()
    {
        session()->put([
            'transaction.status' => Transaction::STATUS_PENDING,
            'transaction.step' => 2
        ]);

        return view('transaction.step2');
    }


    public function handleStep2(Request $request)
    {


        $request->validate([
            'amount' => [Rule::in(session('transaction.amount'))],
            'receiver_account' => [Rule::in(session('transaction.receiver_account'))],
        ]);

        session()->put([
            'transaction.status' => Transaction::STATUS_CONFIRMED,
            'transaction.step' => 3
        ]);

        return view('transaction.step3');
    }


    


    public function step3()
    {
        return view('transaction.step3');
    }

    public function handleStep3(Request $request)
    {
        if (!($request->otp == 111111)) {
            return back()->with('message', [
                'type' => 'danger',
                'content' => 'OTP is invalid'
            ]);
        }

        try {

            session()->put([
                'transaction.status' => Transaction::STATUS_SUCCESS
            ]);

            $data = session('transaction');

            Transaction::query()->create($data);

            session()->forget('transaction');
        } catch (\Throwable $e) {

            session()->put([
                'transaction.status' => Transaction::STATUS_CONFIRMED
            ]);

            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $e->getMessage()]
            );

            return back()->with('message', [
                'type' => 'danger',
                'content' => 'System Error'
            ]);
        };

        return redirect()->route('transaction.success');
    }

    public function success()
    {
        return view('transaction.success');
    }

    public function listUnfinished()
    {
        return view('transaction.list-unfinished');
    }

    public function cancel()
    {
        $transactionID = session('transaction.transaction_id');

        session()->forget('transaction');

        if (session()->has('middleware_chec_transaction_exit_ran')) {
            session()->forget('middleware_chec_transaction_exit_ran');
        }

        return back()->with('message', [
            'type' => 'success',
            'content' => 'Cancel transaction ' . $transactionID . ' success !'
        ]);
    }

    public function continue()
    {

        $step = session('transaction.step');

        return redirect()->route('transaction.step' . $step);
    }
}
