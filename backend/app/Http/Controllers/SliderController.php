<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['role:superadmin|admin|editor','permission:slider index|slider create|slider edit|slider delete|slider view|slider product']);
    // }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $slider = Slider::first();
        return view('admin.slider.index', compact('slider'));
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
        $slider = Slider::first();
        
        // @dd($request->slider_image);
        if($request->title){
            $slider->title = $request->title;
        }

        if($request->hasFile('slider_image')){
            if($slider->slider_image && file_exists(public_path($slider->slider_image))){
                unlink(public_path($slider->slider_image));
            }

            $image = $request->slider_image;
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            Storage::putFileAs('public/slider', $image, $imageName);
            $slider->slider_image = 'storage/slider/' . $imageName;
        }
     

        $slider->save();
        Session::flash('success', 'Slider updated successfully');
        return redirect()->back();
    }
}
