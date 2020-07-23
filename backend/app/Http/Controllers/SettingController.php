<?php

namespace App\Http\Controllers;

use Session;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:superadmin|admin|editor','permission:setting index']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $setting = Setting::first();
        return view('admin.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $setting = Setting::first();
        
        if($request->site_name){
            $setting->site_name = $request->site_name;
        }
        if($request->email){
            $setting->email = $request->email;
        }
        if($request->phone){
            $setting->phone = $request->phone;
        }
        if($request->address){
            $setting->address = $request->address;
        }
        if($request->copyright){
            $setting->copyright = $request->copyright;
        }
        if($request->facebook){
            $setting->facebook = $request->facebook;
        }
        if($request->youtube){
            $setting->youtube = $request->youtube;
        }
        if($request->instagram){
            $setting->instagram = $request->instagram;
        }
        if($request->twitter){
            $setting->twitter = $request->twitter;
        }
        if($request->short_description){
            $setting->short_description = $request->short_description;
        }

        if($request->hasFile('logo')){
            if($setting->site_logo && file_exists(public_path($setting->site_logo))){
                unlink(public_path($setting->site_logo));
            }

            $image = $request->logo;
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            Storage::putFileAs('public/setting', $image, $imageName);
            $setting->site_logo = 'storage/setting/' . $imageName;
        }
        if($request->hasFile('favicon')){
            if($setting->site_favicon && file_exists(public_path($setting->site_favicon))){
                unlink(public_path($setting->site_favicon));
            }

            $image = $request->favicon;
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            Storage::putFileAs('public/setting', $image, $imageName);
            $setting->site_favicon = 'storage/setting/' . $imageName;
        }

        $setting->save();
        Session::flash('success', 'Setting updated successfully');
        return redirect()->back();
    }
}
