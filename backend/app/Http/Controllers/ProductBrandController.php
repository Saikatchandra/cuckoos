<?php

namespace App\Http\Controllers;

use Session;
use App\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductBrandController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:superadmin|admin|editor','permission:brand index|brand create|brand edit|brand delete|brand view']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = ProductBrand::latest()->paginate(20);

        return view('admin.product-brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product-brand.create');
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
            'name' => 'required|unique:product_brands,name',
        ]);

        $brand = ProductBrand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        Session::flash('success', 'Product Brand created successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function show(ProductBrand $productBrand)
    {
        $brand = $productBrand;
        return view('admin.product-brand.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductBrand $productBrand)
    {
        $brand = $productBrand;
        return view('admin.product-brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductBrand $productBrand)
    {
        $brand = $productBrand;

        $this->validate($request, [
            'name' => "required|unique:product_brands,name,$brand->id",
        ]);

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->save();

        Session::flash('success', 'Product Brand updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductBrand $productBrand)
    {
        $brand = $productBrand;
        if($brand){
            $brand->delete();
        }

        Session::flash('success', 'Product Brand deleted successfully');
        return redirect()->back();
    }
}
