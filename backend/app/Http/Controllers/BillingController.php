<?php

namespace App\Http\Controllers;

use Session;
use App\Billing;
use Illuminate\Http\Request;

class BillingController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:superadmin|admin|editor','permission:billing index|billing create|billing edit|billing delete|billing view']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billings = Billing::latest()->paginate(20);
        return view('admin.billing.index', compact('billings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.billing.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'owner' => 'required',
            'expire_date' => 'required',
            'last4' => 'required',
            'type' => 'required',
        ]);

        $billing = Billing::create([
            'owner' => $request->owner,
            'expire_date' => $request->expire_date,
            'last4' => $request->last4,
            'type' => $request->type,
            'user_id' => auth()->user()->id,
        ]);

        Session::flash('success', 'Billing created successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function show(Billing $billing)
    {
        return view('admin.billing.show', compact('billing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function edit(Billing $billing)
    {
        return view('admin.billing.edit', compact('billing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Billing $billing)
    {
        $this->validate($request, [
            'owner' => 'required',
            'expire_date' => 'required',
            'last4' => 'required',
            'type' => 'required',
        ]);
        
        $billing->owner = $request->owner;
        $billing->expire_date = $request->expire_date;
        $billing->last4 = $request->last4;
        $billing->type = $request->type;
        $billing->update();
        
        Session::flash('success', 'Billing created successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billing $billing)
    {
        if($billing){
            $billing->delete();
            
            Session::flash('success', 'Billing deleted sucessfully');
        }

        return redirect()->back();
    }
}
