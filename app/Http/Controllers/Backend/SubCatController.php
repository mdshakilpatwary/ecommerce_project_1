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
    public function show()
    {
        $subcat_data =SubCategory::orderBy('id', 'DESC')->get();
        return view('backend.subcategory.manage',compact('subcat_data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories =Category::all();
        $subcat_data =SubCategory::find($id);
        return view('backend.subcategory.edit',compact('subcat_data','categories' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $subcategory =SubCategory::find($id);

        $subcategory->subcat_name = $request->subcat_name;
        $subcategory->cat_id = $request->select_category;
        if($request->file('subcat_image')){

            if(File::exists(public_path('uploads/subcategory/' .$subcategory->subcat_image))){
                File::delete(public_path('uploads/subcategory/' .$subcategory->subcat_image));
            }
            $image = $request->file('subcat_image');
            $customname='subcat_'.rand().'.'. $image->getClientOriginalExtension();
            $image->move('uploads/subcategory', $customname);
            $subcategory->subcat_image = $customname;
        }

        $insert = $subcategory->update();
        if($insert){
            return redirect('/show/subcatagory')->with('success', 'Successfully data Updated');

        }
        else{
            return redirect()->back()->with('error', 'Opps! data not Update');

        }
    }
  

    // Status change  part

    function changestatus($id){
        $status =SubCategory::find($id);
        if($status->status == 1){
            $status-> status = '0';
           $status->update();
           return redirect()->back()->with('success', 'SubCategory Active successfully Done');
        }
        else{
            $status-> status = '1';
            $status->update();
            return redirect()->back()->with('success', 'SubCategory Inactive successfully done');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        
        $subcat_destroy =SubCategory::find($id);
        if(File::exists(public_path('uploads/category/' .$subcat_destroy->subcat_image))){
            File::delete(public_path('uploads/category/' .$subcat_destroy->subcat_image));
        }
        $msg = $subcat_destroy->delete();
        if($msg){
            return redirect()->back()->with('success', 'Data delete successfully');

        }
        else{
            return redirect()->back()->with('error', 'opps! Data not delete');

        }   
    }
}
