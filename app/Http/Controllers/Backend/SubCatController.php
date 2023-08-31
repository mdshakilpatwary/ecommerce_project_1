<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use File;
use Image;


class SubCatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories =Category::all();
        return view('backend.subcategory.index', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subcat_name' => 'required',
            'select_category' => 'required',
            
        ],
        [
            'subcat_name.required' => 'Sub Category Name is required',
            'select_category.required' => 'Select your category',
           
        ]);
    
        $subcategory = New SubCategory;

        $subcategory->subcat_name = $request->subcat_name;
        $subcategory->cat_id = $request->select_category;
        if($request->file('subcat_image')){
            $image = $request->file('subcat_image');
            $customname='subcat_'.rand().'.'. $image->getClientOriginalExtension();
            $subcategory->subcat_image = $customname;
            if($subcategory->save()){
                $image->move('uploads/subcategory', $customname);
            }
        }

        $insert = $subcategory->save();
        if($insert){
            return redirect()->back()->with('success', 'Successfully data Submitted');

        }
        else{
            return redirect()->back()->with('error', 'Opps! data not Submitted');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
