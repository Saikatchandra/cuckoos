<?php

namespace App\Http\Controllers;

use Session;
use App\Campaign;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CampaignController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:superadmin|admin|editor','permission:campaign index|campaign create|campaign edit|campaign delete|campaign view|campaign product']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::latest()->paginate(20);

        return view('admin.campaign.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.campaign.create');
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
            'discount' => 'required|integer',
        ]);

        $campaign = Campaign::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'discount' => $request->discount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        // image
        if($request->hasFile('banner')){
            $image = $request->banner;
            $fileName = time().'_'. uniqid() .'.'. $image->getClientOriginalExtension();
            
            Storage::putFileAs('public/campaign', $image, $fileName);
            
            $campaign->banner = 'storage/campaign/' . $fileName;
        } 
        $campaign->save();

        Session::flash('success', 'Campaign created successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        return view('admin.campaign.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        $this->validate($request, [
            'name' => 'required',
            'discount' => 'required|integer',
        ]);

        $campaign->name = $request->name;
        $campaign->slug = Str::slug($request->name);
        $campaign->discount = $request->discount;
        $campaign->end_date = $request->end_date;
        $campaign->description = $request->description;
        $campaign->status = $request->status;

        if($request->start_date){
            $campaign->start_date = $request->start_date;
        }
        
        if($request->end_date){
            $campaign->end_date = $request->end_date;
        }

        // image
        if($request->hasFile('banner')){
            $image = $request->banner;
            $fileName = time().'_'. uniqid() .'.'. $image->getClientOriginalExtension();
            Storage::putFileAs('public/campaign', $image, $fileName);
            
            $campaign->banner = 'storage/campaign/' . $fileName;
        }
        $campaign->save();

        Session::flash('success', 'Campaign updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        if($campaign){
            if($campaign->banner && file_exists(public_path($campaign->banner))){
                unlink(public_path($campaign->banner));
            }

            $campaign->delete();
            Session::flash('success', 'Campaign deleted successfully');
        }

        return redirect()->back();
    }

    public function products(Request $request, $id){
        $campaign = Campaign::find($id);

        if($campaign){
            $campaignProducts = $campaign->products;
            $excludeId =  [];
            $excludeProducts = [];

            foreach($campaignProducts as $product){
                array_push($excludeId, $product->id);
                array_push($excludeProducts, $product);
            }
            
            $products = Product::all()->except($excludeId);

            return view('admin.campaign.product', compact(['campaign', 'campaignProducts', 'excludeProducts', 'products']));
        }
    }

    public function updateproducts(Request $request, $id){
        $campaign = Campaign::find($id);

        if($campaign){
            $campaign->products()->sync($request->products);

            Session::flash('success', 'Campaign products updated successfully');
        }

        return redirect()->back();
    }
}
