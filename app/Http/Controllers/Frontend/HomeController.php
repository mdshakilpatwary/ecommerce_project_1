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
    function singleProduct(){
        $products = Product::where('status',1)->latest()->limit(12)->get();
        $categories =Category::where('cat_status',1)->get();
        $subcategories =SubCategory::where('status',1)->get();
        $brands =Brand::where('status',1)->get();
        $units =Unit::all();
        $sizes =Size::where('status',1)->get();
        $colors =Color::all();
        return view('frontend.single_product', compact('products','categories','subcategories','brands','colors','sizes','units')) ;
    }





}
