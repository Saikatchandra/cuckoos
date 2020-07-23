<?php

namespace App\Http\Controllers;

use Session;
use App\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:superadmin|admin|editor','permission:shipping index|shipping create|shipping edit|shipping delete|shipping view']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippings = Shipping::latest()->paginate(20);
        return view('admin.shipping.index', compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shipping.create');
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
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
            'state' => 'required',
            'district' => 'required',
        ]);

        $shipping = Shipping::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'user_id' => auth()->user()->id,
            'state' => $request->state,
            'district' => $request->district,
        ]);
        
        Session::flash('success', 'Shippping address created successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        return view('admin.shipping.show', compact('shipping'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping $shipping)
    {
        return view('admin.shipping.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipping $shipping)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
            'state' => 'required',
            'district' => 'required',
        ]);

        $shipping->name = $request->name;
        $shipping->phone = $request->phone;
        $shipping->address = $request->address;
        $shipping->postal_code = $request->postal_code;
        $shipping->country = $request->country;
        $shipping->save();
        
        Session::flash('success', 'Shippping address updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping)
    {
        if($shipping){
            $shipping->delete();

            Session::flash('success', 'Shippping address deleted successfully');
        }

        return redirect()->back();
    }
}
