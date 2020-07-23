<?php

namespace App\Http\Controllers;

use Session;
use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:superadmin|admin|editor','permission:coupon index|coupon create|coupon edit|coupon delete|coupon view']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::latest()->paginate(20);

        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
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
            'code' => 'required|max:255|unique:coupons,code',
            'description' => 'required|max:255',
            'type' => 'required',
            'amount' => 'required',
        ]);

        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->description = $request->description;
        $coupon->type = $request->type;
        $coupon->amount = $request->amount;
        
        if($request->allow_freeshippping == "on"){
            $coupon->allow_freeshippping = true;
        }else{
            $coupon->allow_freeshippping = false;
        }
        // check new user checked or not
        if($request->new_user == "on"){
            $coupon->new_user = true;
        }else{
            $coupon->new_user = false;
        }
        if($request->expiry_date){
            $coupon->expiry_date = $request->expiry_date;
        }
        if($request->usage_limit){
            $coupon->usage_limit = $request->usage_limit;
        }
        if($request->limit_peruser){
            $coupon->limit_peruser = $request->limit_peruser;
        }
        if($request->min_spend){
            $coupon->min_spend = $request->min_spend;
        }
        if($request->status == 1 || $request->status == '1'){
            $coupon->status = true;
        }else {
            $coupon->status = false;
        }
        $coupon->save();

        Session::flash('success', 'Coupon created successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return view('admin.coupon.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        // dd($request->all());
        // return var_dump($request->status);
        $this->validate($request, [
            'code' => "required|max:255|unique:coupons,code,$coupon->id",
            'description' => 'required|max:255',
            'type' => 'required',
            'amount' => 'required',
        ]);

        $coupon->code = $request->code;
        $coupon->description = $request->description;
        $coupon->type = $request->type;
        $coupon->amount = $request->amount;

        
        if($request->allow_freeshippping == "on"){
            $coupon->allow_freeshippping = true;
        }else{
            $coupon->allow_freeshippping = false;
        }
        // check new user checked or not
        if($request->new_user == "on"){
            $coupon->new_user = true;
        }else{
            $coupon->new_user = false;
        }
        if($request->expiry_date){
            $coupon->expiry_date = $request->expiry_date;
        }
        if($request->usage_limit){
            $coupon->usage_limit = $request->usage_limit;
        }
        if($request->limit_peruser){
            $coupon->limit_peruser = $request->limit_peruser;
        }
        if($request->min_spend){
            $coupon->min_spend = $request->min_spend;
        }
        if($request->status == 1 || $request->status == '1'){
            $coupon->status = true;
        }else {
            $coupon->status = false;
        }
        $coupon->save();

        Session::flash('success', 'Coupon updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        if($coupon){
            $coupon->delete();

            Session::flash('success', 'Coupon deleted successfully');
        }

        return redirect()->back();
    }
}
