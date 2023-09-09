<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    function index(){
        $categories =Category::all();
        $subcategories =SubCategory::all();
        $brands =Brand::all();
        $units =Unit::all();
        $sizes =Size::all();
        $colors =Color::all();
        return view('backend.product.index', compact('categories','subcategories','brands','colors','sizes','units'));
    }
}
