<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Color;
use App\Models\SiteInfo;
use App\Models\Order;
use App\Models\OrderDatails;
use File;
use Image;
use DB;
use Auth;
use Session;

class HomeController extends Controller
{

    function userDashborad(){
        $id = Auth::user()->id;
        $orderData = Order::where('customer_id',$id)->orderBy('id', 'DESC')->get();

        return view('frontend.dashboard', compact('orderData'));


    }
    // invoice 

    function orderinvoice($id){
         
        $order = Order::where('id',$id)->first();
        $orderId= OrderDatails::where('order_id',$id)->get();
        return view('frontend.page.customerinvoice', compact('order','orderId'));
    }


    function index(){
        $products = Product::where('status',1)->latest()->limit(12)->get();
        $categories =Category::where('cat_status',1)->get();
        $subcategories =SubCategory::where('status',1)->get();
        $brands =Brand::where('status',1)->get();
        $sizes =Size::where('status',1)->get();
        $colors =Color::all();




        // top selling product part 
        $top_sales = DB::table('products')
                    ->leftJoin('order_datails','products.id','=','order_datails.product_id')
                    ->selectRaw('products.id, SUM(order_datails.product_sale_qty) as total')
                    ->groupBy('products.id')
                    ->orderBy('total','desc')
                    ->take(8)
                    ->get();
                $topProducts = [];
                foreach ($top_sales as $s){
                    $p = Product::findOrFail($s->id);
                    $p->totalQty = $s->total;
                    $topProducts[] = $p;
                }
                
                

        return view('frontend.welcome', compact('products','categories','subcategories','brands','colors','sizes','topProducts'));
    

    }
    // single product with related product
    function singleProduct($id){
        $product = Product::findorFail($id);
        $categories =Category::where('cat_status',1)->get();
        $subcategories =SubCategory::where('status',1)->get();
        $brands =Brand::where('status',1)->get();
        $sizes =Size::where('status',1)->get();
        $colors =Color::all();
        $cat_id = $product->cat_id;
        $related_product = Product::where('cat_id', $cat_id)->limit(4)->get();



        return view('frontend.page.single_product', compact('product','categories','subcategories','brands','colors','sizes','related_product')) ;
    }
    // category product 
    function categoryProduct($id){
        $products = Product::where('status', 1)->where('cat_id', $id)->paginate(6);
        $category =Category::findOrFail($id);
        $subcategories =SubCategory::where('status',1)->get();
        $brands =Brand::where('status',1)->get();
        $sizes =Size::where('status',1)->get();
        $colors =Color::all();

            // top selling product part 
            $top_sales = DB::table('products')
            ->leftJoin('order_datails','products.id','=','order_datails.product_id')
            ->selectRaw('products.id, SUM(order_datails.product_sale_qty) as total')
            ->groupBy('products.id')
            ->orderBy('total','desc')
            ->take(8)
            ->get();
        $topProducts = [];
        foreach ($top_sales as $s){
            $p = Product::findOrFail($s->id);
            $p->totalQty = $s->total;
            $topProducts[] = $p;
        }

        return view('frontend.page.category_product', compact('products','category','subcategories','brands','colors','sizes','topProducts')) ;

    }
    // category product 
    function brandProduct($id){
        $products = Product::where('status', 1)->where('brand_id', $id)->paginate(6);
        $categories =Category::where('cat_status',1)->get();
        $subcategories =SubCategory::where('status',1)->get();
        $brands =Brand::where('status',1)->get();
        $sizes =Size::where('status',1)->get();
        $brandproduct =Brand::findOrFail($id);

        $colors =Color::all();

            // top selling product part 
            $top_sales = DB::table('products')
            ->leftJoin('order_datails','products.id','=','order_datails.product_id')
            ->selectRaw('products.id, SUM(order_datails.product_sale_qty) as total')
            ->groupBy('products.id')
            ->orderBy('total','desc')
            ->take(8)
            ->get();
        $topProducts = [];
        foreach ($top_sales as $s){
            $p = Product::findOrFail($s->id);
            $p->totalQty = $s->total;
            $topProducts[] = $p;
        }

        return view('frontend.page.brandwise_product', compact('products','categories','subcategories','brands','colors','sizes','topProducts','brandproduct')) ;

    }
    // all product 
    function allProduct(){
        $products = Product::where('status', 1)->paginate(6);
        $categories =Category::where('status',1);
        $subcategories =SubCategory::where('status',1)->get();
        $brands =Brand::where('status',1)->get();
        $sizes =Size::where('status',1)->get();
        $colors =Color::all();

            // top selling product part 
            $top_sales = DB::table('products')
            ->leftJoin('order_datails','products.id','=','order_datails.product_id')
            ->selectRaw('products.id, SUM(order_datails.product_sale_qty) as total')
            ->groupBy('products.id')
            ->orderBy('total','desc')
            ->take(8)
            ->get();
        $topProducts = [];
        foreach ($top_sales as $s){
            $p = Product::findOrFail($s->id);
            $p->totalQty = $s->total;
            $topProducts[] = $p;
        }

        return view('frontend.page.all_product', compact('products','categories','subcategories','brands','colors','sizes','topProducts')) ;

    }

    // subcategory 
    function subcategoryProduct($id){
        $products = Product::where('status', 1)->where('subcat_id', $id)->paginate(6);
        $categories =Category::where('cat_status',1)->get();
        $subcategory =SubCategory::findOrFail($id);
        $brands =Brand::where('status',1)->get();
        $sizes =Size::where('status',1)->get();
        $colors =Color::all();


                // top selling product part 
                $top_sales = DB::table('products')
                ->leftJoin('order_datails','products.id','=','order_datails.product_id')
                ->selectRaw('products.id, SUM(order_datails.product_sale_qty) as total')
                ->groupBy('products.id')
                ->orderBy('total','desc')
                ->take(8)
                ->get();
            $topProducts = [];
            foreach ($top_sales as $s){
                $p = Product::findOrFail($s->id);
                $p->totalQty = $s->total;
                $topProducts[] = $p;
            }
        return view('frontend.page.subcategory_product', compact('products','categories','subcategory','brands','colors','sizes','topProducts')) ;
    }

// producr search controller 
    function productSearch(Request $request){
        $queary = $request->quearyProduct;
        $product =Product::orderBy('id', 'desc')->where('p_name','LIKE',"%$queary%");
        if($request->category != "All") $product->where('cat_id',$request->category);
        $products = $product->paginate(6);
        $categories =Category::where('cat_status',1)->get();
        $subcategories =SubCategory::where('status',1)->get();
        $brands =Brand::where('status',1)->get();
        

                // top selling product part 
                $top_sales = DB::table('products')
                ->leftJoin('order_datails','products.id','=','order_datails.product_id')
                ->selectRaw('products.id, SUM(order_datails.product_sale_qty) as total')
                ->groupBy('products.id')
                ->orderBy('total','desc')
                ->take(8)
                ->get();
            $topProducts = [];
            foreach ($top_sales as $s){
                $p = Product::findOrFail($s->id);
                $p->totalQty = $s->total;
                $topProducts[] = $p;
            }
        return view('frontend.page.searching', compact('products','categories','subcategories','brands','topProducts')) ;



    } 
    
    





}
