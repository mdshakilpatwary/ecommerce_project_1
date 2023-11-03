<?php

namespace App\Http\Controllers\Frontend;

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

class HomeController extends Controller
{
    function index(){
        $products = Product::where('status',1)->latest()->limit(12)->get();
        $categories =Category::where('cat_status',1)->get();
        $subcategories =SubCategory::where('status',1)->get();
        $brands =Brand::where('status',1)->get();
        $units =Unit::all();
        $sizes =Size::where('status',1)->get();
        $colors =Color::all();
        return view('frontend.welcome', compact('products','categories','subcategories','brands','colors','sizes','units'));
    

    }
    // single product 
    function singleProduct($id){
        $product = Product::findorFail($id);
        $categories =Category::where('cat_status',1)->get();
        $subcategories =SubCategory::where('status',1)->get();
        $brands =Brand::where('status',1)->get();
        $units =Unit::all();
        $sizes =Size::where('status',1)->get();
        $colors =Color::all();
        $cat_id = $product->cat_id;
        $related_product = Product::where('cat_id', $cat_id)->limit(4)->get();
        return view('frontend.page.single_product', compact('product','categories','subcategories','brands','colors','sizes','units','related_product')) ;
    }
    // store product 
    function categoryProduct($id){
        $products = Product::where('status', 1)->where('cat_id', $id)->get();
        $category =Category::findOrFail($id);
        $subcategories =SubCategory::where('status',1)->get();
        $brands =Brand::where('status',1)->get();
        $units =Unit::all();
        $sizes =Size::where('status',1)->get();
        $colors =Color::all();
        return view('frontend.page.category_product', compact('products','category','subcategories','brands','colors','sizes','units')) ;
    }
    function subcategoryProduct($id){
        $products = Product::where('status', 1)->where('subcat_id', $id)->get();
        $categories =Category::where('cat_status',1)->get();
        $subcategory =SubCategory::findOrFail($id);
        $brands =Brand::where('status',1)->get();
        $units =Unit::all();
        $sizes =Size::where('status',1)->get();
        $colors =Color::all();
        return view('frontend.page.subcategory_product', compact('products','categories','subcategory','brands','colors','sizes','units')) ;
    }
    





}
