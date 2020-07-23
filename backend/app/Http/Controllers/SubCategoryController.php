<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Session;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = SubCategory::latest()->paginate(20);

        return view('admin.subcategory.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::orderBy('name', 'asc')->get();
        return view('admin.subcategory.create', compact('categories'));
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
            'name' => "required|max:255|unique:sub_categories,name",
            'category_id' => 'required',
        ]);

        $category = SubCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        Session::flash('success', 'Sub Category created successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = SubCategory::find($id);
        $categories = ProductCategory::orderBy('name', 'asc')->get();
        return view('admin.subcategory.show', compact(['category', 'categories']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = SubCategory::find($id);
        $categories = ProductCategory::orderBy('name', 'asc')->get();
        return view('admin.subcategory.edit', compact(['category', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = SubCategory::find($id);
        $this->validate($request, [
            'name' => "required|max:255|unique:sub_categories,name, $category->id",
            'category_id' => 'required',
        ]);

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->category_id = $request->category_id;
        $category->save();

        Session::flash('success', 'Sub Category updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = SubCategory::find($id);
        $category->delete();

        Session::flash('success', 'Sub Category deleted successfully');
        return redirect()->back();
    }

    public function get_subcategories($id){
        $categories = SubCategory::orderBy('name', 'asc')->where('category_id', $id)->get();

        return response()->json($categories, 200);
    }
}
