<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Color;
use App\Models\SiteInfo;
use App\Models\ProductReview;
use App\Models\OfferDealContent;
use App\Models\Order;
use App\Models\OrderDatails;
use Carbon\Carbon;
use DB;
use Auth;
use Session;


class ProductFilterController extends Controller
{
    public function productPriceFilter(Request $request){


        $products = Product::whereBetween('p_price',[$request->left_value, $request->right_value])->where('status', 1)->paginate(6);
        

        return view('frontend.page.search_filter_product', compact('products'))->render();
        
    }

    public function productPriceSortByHigh(Request $request){
        if($request->sortbyhigh == 'highest_price'){
            $products = Product::orderBy('p_price','desc')->where('status', 1)->paginate(6);
            return view('frontend.page.search_filter_product',compact('products'))->render();
        }
        
    }
    public function productPriceSortByLow(Request $request){

        if($request->sortbylow == 'lowest_price'){
            $products = Product::orderBy('p_price','asc')->where('status', 1)->paginate(6);
            return view('frontend.page.search_filter_product',compact('products'))->render();
        }



    }
}
