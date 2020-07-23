<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Slider;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    /**
     * affiliate dashboard method
     */
    public function affiliate(){
        return view('admin.dashboard.affiliate');
    }

    public function welcome(){
        // return view('welcome');
        $setting = Setting::get();
        $slider = Slider::first();
        // @dd($slider);
        return view('user.user_layout',compact('setting','slider'));
    }
}
