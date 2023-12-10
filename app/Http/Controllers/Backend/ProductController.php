<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Size;
use App\Models\KgLitter;
use App\Models\Color;
use Illuminate\Contracts\Validation\Rule;
use Auth;
use File;
use Image;

class ProductController extends Controller
{
    public $p_user;

    // for dashboard permission auth
         public function __construct() {
            $this->middleware(function($request, $next){
                $this->p_user =Auth::user();
                return $next($request);
    
            }) ;
        }
    // product add page part controller
    function index(){
        if (is_null($this->p_user) || !$this->p_user->can('product.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any product !');
        }
        $categories =Category::all();
        $subcategories =SubCategory::where('status',1)->get();
        $brands =Brand::where('status',1)->get();
        $sizes =Size::where('status',1)->get();
        $kg_data =KgLitter::where('status',1)->get();
        $colors =Color::where('status',1)->get();
        return view('backend.product.index', compact('categories','subcategories','brands','colors','sizes','kg_data'));
    }

// store Product controller part 
function store(Request $request){
    if (is_null($this->p_user) || !$this->p_user->can('product.create')) {
        abort(403, 'Sorry !! You are Unauthorized to create any product !');
    }

    $request->validate([
        'p_code' => 'required',
        'p_name' => 'required',
        'select_cat' => 'required',
        'select_subcat' => 'required',
        'select_brand' => 'required',
        'select_color' => 'required',
        
        'p_desc' => 'required',
        'p_image' => 'required',
        'p_price' => 'required',
        'discount_percentage' => [
            'integer',
            'max:100',
            'min:0',
        ],
        'p_qty' => 'required',
        'group_p_image' => 'required',
        'select_size' => 'required_without:select_size_kg',
        'select_size_kg' => 'required_without:select_size',
        
    ],
    [
        'p_code.required' => 'Product Code is required',
        'p_name.required' => 'Product name is required',
        'select_cat.required' => 'Product category is required',
        'select_subcat.required' => 'Product sub category is required',
        'select_brand.required' => 'Product brand is required',
        'select_color.required' => 'Product color is required',
        // 'select_size.required' => 'Product size is required',
        'p_desc.required' => 'Product Description is required',
        'p_image.required' => 'Product Description is required',
        'p_price.required' => 'Product price is required',
        'p_qty.required' => 'Product Quantity is required',
        'group_p_image.required' => 'Product group image is required',
       
    ]);

    $product = New Product;

    $product->p_code = $request->p_code;
    $product->p_name = $request->p_name;
    $product->p_slug =Str::slug($request->p_name);
    $product->cat_id = $request->select_cat;
    $product->subcat_id = $request->select_subcat;
    $product->brand_id = $request->select_brand;
    $product->p_description = $request->p_desc;
    $product->p_price = $request->p_price;
    $product->discount_percentage = $request->discount_percentage;
    $product->p_qty = $request->p_qty;

// color and size 
$colors = array();
$select_color = $request->select_color;
foreach($select_color as $color){
    $colors[] = $color;
}
$product->color_id =implode("|",$colors);

// size without kg
        if($request->filled('select_size')){

        $sizes = array();
        $select_size = $request->select_size;
        foreach($select_size as $size){
            $sizes[] = $size;
        }
        $product->size_id =implode("|",$sizes);
        $product->kg_liter = null;
        }
// size with kg
        elseif ($request->filled('select_size_kg')){

        $size_kg = array();
        $select_size_kg = $request->select_size_kg;
        foreach($select_size_kg as $kg){
            $size_kg[] = $kg;
        }
        $product->kg_liter =implode("|",$size_kg);
        $product->size_id = null;
        }


// single image store 
    if($request->file('p_image')){
        $image = $request->file('p_image');
        $customname='P_'.rand().'.'. $image->getClientOriginalExtension();
        $product->p_image = $customname;

         $image->move('uploads/product', $customname);

        
    }

//   multiple image store   
    if($request->file('group_p_image')){
        $images=array();
        $files = $request->file('group_p_image');
        
            foreach($files as $file){
                $customnamefile='gp_'.rand().'.'. $file->getClientOriginalExtension();
                $images[]= $customnamefile;
               
                $file->move('uploads/product/product_group', $customnamefile);
        
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
    if (is_null($this->p_user) || !$this->p_user->can('product.view')) {
        abort(403, 'Sorry !! You are Unauthorized to view any product !');
    }
    $p_data =Product::orderBy('id', 'DESC')->get();
    return view('backend.product.manage',compact('p_data'));
}

  // delete Product controller 

  function destroy($id){
    if (is_null($this->p_user) || !$this->p_user->can('product.delete')) {
        abort(403, 'Sorry !! You are Unauthorized to delete any product !');
    }
    $product_destroy =Product::find($id);
    if(File::exists(public_path('uploads/product/' .$product_destroy->p_image))){
        File::delete(public_path('uploads/product/' .$product_destroy->p_image));
    }
//  group image delete part
    foreach(explode("|",$product_destroy->group_p_image) as $g_image){

    if(File::exists(public_path('uploads/product/product_group/' . $g_image))){
        File::delete(public_path('uploads/product/product_group/' . $g_image));
    }
    }
    
    $msg = $product_destroy->delete();
    if($msg){
        return redirect()->back()->with('success', 'Product deleted successfully');

    }
    else{
        return redirect()->back()->with('error', 'opps! Product not delete');

    }   
}


// edit category controller part 
    function edit($id){
        if (is_null($this->p_user) || !$this->p_user->can('product.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any product !');
        }
        $p_data =Product::find($id);
        $categories =Category::all();
        $subcategories =SubCategory::where('status',1)->get();
        $brands =Brand::all();
        $sizes =Size::where('status',1)->get();
        $kg_size =KgLitter::where('status',1)->get();
        $colors =Color::where('status',1)->get();
        return view('backend.product.edit', compact('p_data','categories','subcategories','brands','colors','sizes','kg_size'));
   
    }

    function update(Request $request, $id){
        if (is_null($this->p_user) || !$this->p_user->can('product.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to create any product !');
        }
        $request->validate([
            'discount_percentage' => [
                'integer',
                'max:100',
                'min:0',
            ],
        ]);
        $product = Product::find($id);
        $product->p_code = $request->p_code;
        $product->p_name = $request->p_name;
        $product->p_slug =Str::slug($request->p_name);
        $product->cat_id = $request->select_cat;
        $product->subcat_id = $request->select_subcat;
        $product->brand_id = $request->select_brand;
        $product->p_description = $request->p_desc;
        $product->p_price = $request->p_price;
        $product->discount_percentage = $request->discount_percentage;
        $product->p_qty = $request->p_qty;



// size without kg
if($request->filled('select_size')){

    $sizes = array();
    $select_size = $request->select_size;
    foreach($select_size as $size){
        $sizes[] = $size;
    }
    $product->size_id =implode("|",$sizes);
    $product->kg_liter = null;
    }
// size with kg
    if($request->filled('select_size_kg')){

    $size_kg = array();
    $select_size_kg = $request->select_size_kg;
    foreach($select_size_kg as $kg){
        $size_kg[] = $kg;
    }
    $product->kg_liter =implode("|",$size_kg);
    $product->size_id = null;
    }

    // size with kg
       if($request->select_size_kg){
        $size_kg = array();
        $select_size_kg = $request->select_size_kg;
        foreach($select_size_kg as $kg){
            $size_kg[] = $kg;
        }
        $product->kg_liter =implode("|",$size_kg);
       }

    // single image update 
        if($request->file('p_image')){
            if(File::exists(public_path('uploads/product/' .$product->p_image))){
                File::delete(public_path('uploads/product/' .$product->p_image));
            }
            $image = $request->file('p_image');
            $customname='P_'.rand().'.'. $image->getClientOriginalExtension();
            $product->p_image = $customname;

            $image->move('uploads/product', $customname);

            
        }

    //   multiple image update   
        if($request->file('group_p_image')){
            foreach(explode("|",$product->group_p_image) as $g_image){

                if(File::exists(public_path('uploads/product/product_group/' . $g_image))){
                    File::delete(public_path('uploads/product/product_group/' . $g_image));
                }
            }

            $images=array();
            $files = $request->file('group_p_image');
            
                foreach($files as $file){
                    $customnamefile='gp_'.rand().'.'. $file->getClientOriginalExtension();
                    $images[]= $customnamefile;
                
                    $file->move('uploads/product/product_group', $customnamefile);
            
                }
            
            $product->group_p_image =implode("|",$images);       
        }

        $update = $product->update();
        if($update){
            return redirect('/show/product')->with('success', 'Successfully Your Product Updated');

        }
        else{
            return redirect()->back()->with('error', 'Opps! Your Product is Not Update');

        }


        }


// product status part 

function changestatus($id){
    if (is_null($this->p_user) || !$this->p_user->can('product.edit')) {
        abort(403, 'Sorry !! You are Unauthorized to edit any product !');
    }
    $status =Product::find($id);
    if($status->status == 1){
       $status->update(['status' => 0]);
       return redirect()->back()->with('success', 'Product Inactive successfully Done');
    }
    else{
        $status->update(['status' => 1]);
        return redirect()->back()->with('success', 'Product Active successfully done');
    }
}

}
