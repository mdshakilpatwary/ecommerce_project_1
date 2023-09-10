<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Size;
use App\Models\Color;
use File;
use Image;

class ProductController extends Controller
{
    // product add page part controller
    function index(){
        $categories =Category::all();
        $subcategories =SubCategory::all();
        $brands =Brand::all();
        $units =Unit::all();
        $sizes =Size::all();
        $colors =Color::all();
        return view('backend.product.index', compact('categories','subcategories','brands','colors','sizes','units'));
    }

// store Product controller part 
function store(Request $request){

    $request->validate([
        'p_code' => 'required',
        'p_name' => 'required',
        'select_cat' => 'required',
        'select_subcat' => 'required',
        'select_brand' => 'required',
        'select_unit' => 'required',
        'select_color' => 'required',
        'select_size' => 'required',
        'p_desc' => 'required',
        'p_image' => 'required',
        'p_price' => 'required',
        'group_p_image' => 'required',
        
    ],
    [
        'p_code.required' => 'Product Code is required',
        'p_name.required' => 'Product name is required',
        'select_cat.required' => 'Product category is required',
        'select_subcat.required' => 'Product sub category is required',
        'select_brand.required' => 'Product brand is required',
        'select_unit.required' => 'Product unit is required',
        'select_color.required' => 'Product color is required',
        'select_size.required' => 'Product size is required',
        'p_desc.required' => 'Product Description is required',
        'p_image.required' => 'Product Description is required',
        'p_price.required' => 'Product price is required',
        'group_p_image.required' => 'Product group image is required',
       
    ]);

    $product = New Product;

    $product->p_code = $request->p_code;
    $product->p_name = $request->p_name;
    $product->p_slug =Str::slug($request->p_name);
    $product->cat_id = $request->select_cat;
    $product->subcat_id = $request->select_subcat;
    $product->brand_id = $request->select_brand;
    $product->color_id = $request->select_color;
    $product->size_id = $request->select_size;
    $product->unit_id = $request->select_unit;
    $product->p_description = $request->p_desc;
    $product->p_price = $request->p_price;
// single image store 
    if($request->file('p_image')){
        $image = $request->file('p_image');
        $customname='P_'.rand().'.'. $image->getClientOriginalExtension();
        $product->p_image = $customname;
        if($product->save()){
            $image->move('uploads/product', $customname);

        }
    }

//   multiple image store   
    if($request->file('group_p_image')){
        $images=array();
        $files = $request->file('group_p_image');
        if($product->save()){
            foreach($files as $file){
                $customnamefile='gp_'.rand().'.'. $file->getClientOriginalExtension();
                $images[]= $customnamefile;
               
                $file->move('uploads/product/product_group', $customnamefile);
        
               
    
            }
        }
        

        
        $product->group_p_image =implode("|",$images);
        
       
           
    }

    $insert = $product->save();
    if($insert){
        return redirect()->back()->with('success', 'Successfully Your Product Uploaded');

    }
    else{
        return redirect()->back()->with('error', 'Opps! Your Product is Not Upload');

    }

}

// show product controller part 
function show(){
    $p_data =Product::orderBy('id', 'DESC')->get();
    return view('backend.product.manage',compact('p_data'));
}





}
