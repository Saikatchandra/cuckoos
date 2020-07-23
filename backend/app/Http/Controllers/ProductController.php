<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use Session;
use App\Product;
use App\ProductAttribute;
use App\ProductBrand;
use App\ProductCategory;
use App\ProductGallery;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:superadmin|admin|editor','permission:product index|product create|product edit|product delete|product view|product import|product gallery|product attribute|attribute delete|gallery edit|gallery delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category', 'brand')->where('stock', '!=', 0)->latest()->paginate(20);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        $brands = ProductBrand::all();

        if($categories->count() < 1){
            Session::flash('error', 'Please create product category first');
            return redirect()->route('product-category.create');
        }else if($brands->count() < 1){
            Session::flash('error', 'Please create product brand first');
            return redirect()->route('product-brand.create');
        }else {
            return view('admin.product.create', compact(['categories', 'brands']));
        }
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
            'title' => "required|unique:products,title",
            'category' => 'required',
            'brand' => 'required',
            'image' => 'required|image|max:2048',
            'description' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'comission' => 'required',
            'origin' => 'required',
        ]);

        $product = Product::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category_id' => $request->category,
            'subcategory_id' => $request->subcategory,
            'brand_id' => $request->brand,
            'image' => 'image',
            'description' => $request->description,
            'information' => $request->information,
            'stock' => $request->stock * 100,
            'price' => $request->price,
            'sale_price' => $request->sale_price * 100,
            'sku' => Str::slug($request->sku, '-'),
            'comission' => $request->comission * 100,
            'origin' => $request->origin,
        ]);

        if($request->recommended == 'on'){
            $product->update(['recommended' => true]);
        }

        // image
        if($request->hasFile('image')){
            $image = $request->image;
            $fileName = time().'_'. uniqid() .'.'. $image->getClientOriginalExtension();
            Storage::putFileAs('public/product', $image, $fileName);
            
            $product->image = 'storage/product/' . $fileName;
            $product->save();
        }

        Session::flash('success', 'Product uploaded successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $categories = ProductCategory::all();

        return view('admin.product.show', compact(['categories', 'product']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        $brands = ProductBrand::all();

        if($categories->count() < 1){
            Session::flash('error', 'Please create product category first');
            return redirect()->route('product-category.create');
        }else if($brands->count() < 1){
            Session::flash('error', 'Please create product brand first');
            return redirect()->route('product-brand.create');
        }else {
            // dd($product->category_id);
            $subcategories = SubCategory::where('category_id', $product->category_id)->get();
            // dd($subcategories);
            return view('admin.product.edit', compact(['categories', 'product', 'brands', 'subcategories']));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'title' => "required|unique:products,title,$product->id",
            'category' => 'required',
            'brand' => 'required',
            'image' => 'sometimes|nullable|image|max:2048',
            'description' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'origin' => 'required',
        ]);

        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->brand_id = $request->brand;
        $product->description = $request->description;
        $product->information = $request->information;
        $product->stock = $request->stock;
        $product->price = $request->price * 100;
        $product->sale_price = $request->sale_price * 100;
        $product->sku = Str::slug($request->sku, '-');
        $product->comission = $request->comission * 100;
        $product->origin = $request->origin;
        
        if($request->recommended == 'on'){
            $product->update(['recommended' => true]);
        }

        // image
        if($request->hasFile('image')){
            $image = $request->image;
            $fileName = time().'_'. uniqid() .'.'. $image->getClientOriginalExtension();
            Storage::putFileAs('public/product', $image, $fileName);
            
            $product->image = 'storage/product/' . $fileName;
        }
        $product->save();

        Session::flash('success', 'Product updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product){
            if(file_exists(public_path($product->image))){
                unlink(public_path($product->image));
            }

            $product->delete();
            Session::flash('success', 'Product deleted successfully');
        }else {
            Session::flash('error', 'Product not found.');
            return redirect()->route('dashboard');
        }

        return redirect()->back();
    }

    public function import(){
        $categories = ProductCategory::all();
        $brands = ProductBrand::all();

        if($categories->count() < 1){
            Session::flash('error', 'Please create product category first');
            return redirect()->route('product-category.create');
        }else if($brands->count() < 1){
            Session::flash('error', 'Please create product brand first');
            return redirect()->route('product-brand.create');
        }else {
            return view('admin.product.import');
        }
    }

    public function store_import(Request $request){
        $this->validate($request, [
            'importfile' => 'required|mimes:xlsx,csv,xls',
        ]);

        Excel::import(new ProductImport, $request->file('importfile'));

        Session::flash('success', 'Product imported successfully');
        return redirect()->back();
    }

    public function gallery($id){
        $product = Product::find($id);
        if($product){
            return view('admin.product.gallery', compact('product'));
        }else {
            Session::flash('error', 'Product not found.');
            return redirect()->route('dashboard');
        }
    }

    public function gallery_store(Request $request, $id){
        $this->validate($request, [
            'image.*' => 'image|max:2048',
        ]);

        $product = Product::find($id);

        if($product){
            foreach($request->image as $image){
                if($image){
                    $gallery = ProductGallery::create([
                        'image' => 'image',
                        'product_id' => $product->id,
                    ]);

                    $fileName = time().'_'. uniqid() .'.'. $image->getClientOriginalExtension();
                    Storage::putFileAs('public/product-gallery', $image, $fileName);
                    
                    $gallery->image = 'storage/product-gallery/' . $fileName;
                    $gallery->save();
                }
            }

            Session::flash('success', 'Product gallery images uploaded successfully');
            return redirect()->back();
        }else {
            Session::flash('error', 'Product not found.');
            return redirect()->route('dashboard');
        }
    }

    public function destroy_gallery($id){
        $gallery = ProductGallery::find($id);

        if($gallery){
            if(file_exists(public_path($gallery->image))){
                unlink(public_path($gallery->image));
            }

            $gallery->delete();
            Session::flash('success', 'Gallery image deleted successfully');
        }else {
            Session::flash('error', 'Gallery Image not found.');
            return redirect()->back();
        }
        
        return redirect()->back();
    }

    public function edit_gallery($id){
        $gallery = ProductGallery::find($id);

        if($gallery){
            return view('admin.product.gallery-edit', compact('gallery'));
        }else {
            Session::flash('error', 'Gallery Image not found.');
            return redirect()->back();
        }
    }

    public function update_gallery(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'image|max:2048',
        ]);

        $gallery = ProductGallery::find($id);

        if($gallery){
            if($request->hasFile('image')){
                $image = $request->image;
                $fileName = time().'_'. uniqid() .'.'. $image->getClientOriginalExtension();
                Storage::putFileAs('public/product-gallery', $image, $fileName);
                
                $gallery->image = 'storage/product-gallery/' . $fileName;
                $gallery->save();
            }
            
            Session::flash('success', 'Gallery image updated successfully');
            return redirect()->route('product.gallery', ['id' => $gallery->product_id]);
        }else {
            Session::flash('error', 'Gallery Image not found.');
            return redirect()->back();
        }
    }

    public function attribute($id){
        $product = Product::find($id);
        if($product){
            return view('admin.product.attribute', compact('product'));
        }else {
            Session::flash('error', 'Product not found.');
            return redirect()->route('product.index');
        }
    }

    public function attribute_store(Request $request, $id){
        $product = Product::find($id);

        $this->validate($request, [
            'sku.*' => 'required|max:254',
            'type.*' => 'required|max:254',
            'name.*' => 'required|max:254',
            'value.*' => 'required|max:254',
            'stock.*' => 'required|max:254',
        ]);

        if($product){
            foreach($request->sku as $key => $value){
                $attribute = ProductAttribute::create([
                    'sku' => $request->sku[$key],
                    'type' => $request->type[$key],
                    'name' => $request->name[$key],
                    'value' => $request->value[$key],
                    'stock' => $request->stock[$key],
                    'price' => $request->price[$key],
                    'product_id' => $product->id,
                ]);
                
                $attribute->save();
            }

            Session::flash('success', 'Product attribute added successfully');
            return redirect()->back();
        }else {
            Session::flash('error', 'Product not found.');
            return redirect()->route('product.index');
        }
    }

    public function destroy_attribute($id){
        $attribute = ProductAttribute::find($id);

        if($attribute){
            $attribute->delete();
            Session::flash('success', 'Attribute deleted successfully');
        }else {
            Session::flash('error', 'Attribute not found.');
            return redirect()->back();
        }
        
        return redirect()->back();
    }

    public function out_of_stock(){
        $products = Product::with('category', 'brand')->where('stock', '=', 0)->paginate(20);

        return view('admin.product.stock', compact('products'));
    }
}
