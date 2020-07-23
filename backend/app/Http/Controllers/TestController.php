<?php

namespace App\Http\Controllers;

use App\Test;
use Session;
use Illuminate\Http\Request;
use App\Imports\TestImport;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('test');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'importfile' => 'required|mimes:xlsx,csv,xls',
        ]);

        Excel::import(new TestImport, $request->file('importfile'));

        Session::flash('success', 'Users imported successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function create(Test $test)
    {
        

        return $user;
    }
}
