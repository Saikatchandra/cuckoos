<?php

namespace App\Http\Controllers;

use Session;
use App\Affiliate;
use App\Transaction;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:superadmin|admin|editor','permission:comission index|transaction index|transaction edit|transaction request']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comission = Affiliate::first();

        return view('admin.affiliate.index', compact('comission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Affiliate  $affiliate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'level1' => 'required',
            'level2' => 'required',
            'level3' => 'required',
            'level4' => 'required',
            'level5' => 'required',
            'level6' => 'required',
            'level7' => 'required',
            'level8' => 'required',
            'level9' => 'required',
            'level10' => 'required',
            'cart_percentage' => 'required',
        ]);

        $comission = Affiliate::first();

        $comission->level1 = $request->level1;
        $comission->level2 = $request->level2;
        $comission->level3 = $request->level3;
        $comission->level4 = $request->level4;
        $comission->level5 = $request->level5;
        $comission->level6 = $request->level6;
        $comission->level7 = $request->level7;
        $comission->level8 = $request->level8;
        $comission->level9 = $request->level9;
        $comission->level10 = $request->level10;
        $comission->cart_percentage = $request->cart_percentage;
        $comission->min_withdraw = $request->min_withdraw;
        $comission->rupee_to_points = $request->rupee_to_points;
        $comission->new_user_points = $request->new_user_points;
        $comission->referrer_user_points = $request->referrer_user_points;
        $comission->save();

        Session::flash('success', 'Affiliate comission updated');
        return redirect()->back();
    }

    public function transactions(){
        $transactions = Transaction::latest()->paginate(30);
        return view('admin.transaction.index', compact('transactions'));
    }

    public function edit_transaction(Transaction $transaction){
        if($transaction){
            return view('admin.transaction.edit', compact('transaction'));
        }else {
            return redirect()->route('transaction.index');
        }
    }

    public function transaction_update(Request $request, Transaction $transaction){
        $transaction->status = $request->status;
        $transaction->save();

        Session::flash('success', 'Transaction updated successfully');
        return redirect()->back();
    }

    public function transaction_request(){
        $transactions = Transaction::latest()->where('withdraw_request', true)->paginate(30);

        return view('admin.transaction.index', compact('transactions'));
    }
}
