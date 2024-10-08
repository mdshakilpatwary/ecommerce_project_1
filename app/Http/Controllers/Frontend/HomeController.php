<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\CartWishlist;
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

// frontend welcome page 
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
        $offerData =OfferDealContent::all();
        return view('frontend.welcome', compact('products','categories','subcategories','brands','colors','sizes','topProducts','offerData'));
    

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
        $review_product_data = ProductReview::where('product_id',$id)->get();

        // condition pass 
        if(count($review_product_data) > 0){
            $rating_count =0;
            foreach($review_product_data as $review_p_data ){
            $rating_count += intval($review_p_data->rating);
            }
            $decimalRating = round($rating_count / count($review_product_data ),1);
            function customRoundToHalf($review_number){
                $integerPart = floor($review_number);
                $decimalPart = $review_number - $integerPart;
    
                if ($decimalPart < 0.5) {
                    return $integerPart;
                } else {
                    return floor($review_number) + 0.5;
                }
            }	
                $rating_round =customRoundToHalf($decimalRating);

        }
        else{
            $rating_round =0;

        }


  



        return view('frontend.page.single_product', compact('product','categories','subcategories','brands','colors','sizes','related_product','review_product_data','rating_round')) ;
    }
    // category product 
    function categoryProduct($id){
        $products = Product::where('status', 1)->where('cat_id', $id)->orderBy('id', 'DESC')->paginate(6);
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
        $products = Product::where('status', 1)->where('brand_id', $id)->orderBy('id', 'DESC')->paginate(6);
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
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->paginate(6);
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

        return view('frontend.page.all_product', compact('products','categories','subcategories','brands','colors','sizes','topProducts')) ;

    }

    // subcategory 
    function subcategoryProduct($id){
        $products = Product::where('status', 1)->where('subcat_id', $id)->orderBy('id', 'DESC')->paginate(6);
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
        $product =Product::orderBy('id', 'desc')->where('p_name','LIKE',"%$queary%")->orWhere('p_description', 'LIKE', "%$queary%");
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

    // quick view modal 
    function quickviewModal($id){
        $product_quick = Product::find($id);
        $sizes = ($product_quick->size_id != null) ? explode("|", $product_quick->size_id) : explode("|", $product_quick->kg_liter);
        $color_quick = explode("|",$product_quick->color_id);
        $category = $product_quick->category->cat_name;

        $imageUrls = [];

        foreach (explode('|', $product_quick->group_p_image) as $groupImage) {
            $imageUrls[] = asset('uploads/product/product_group/' . $groupImage);
        }
        // wishlist code 
        if(Auth::user()){
            $wishlistModal=CartWishlist::where('p_id',$product_quick->id)->where('user_id', Auth::user()->id)->first();

        }
        else{
            $wishlistModal= '';
        }
        return response()->json([
            'product_quick' => $product_quick,
            'size_quick' => $sizes,
            'color_quick' => $color_quick,
            'category' => $category,
            'imageUrls' => $imageUrls,
            'wishlistModal' => $wishlistModal,
        ]);
    }

    // offer duration set 

    public function durationset(){

        $offerData =OfferDealContent::all();
        if(count($offerData) > 0){
            $offerDealData =OfferDealContent::findOrFail(1);

            // Set the offer start and end dates
            $offerStartDate = Carbon::now(); // Current date and time
            $offerEndDate = Carbon::parse($offerDealData->offer_duration_end);

            // Calculate the difference
            $diff = $offerStartDate->diff($offerEndDate);

            // Get the difference components
            $days = $diff->days;
            $hours = $diff->h;
            $minutes = $diff->i;
            $seconds = $diff->s;

            return response()->json([
                'offerenddate' => $offerEndDate,
                'offerDay' => $days,
                'offerHours' => $hours,
                'offerMinutes' => $minutes,
                'offerSeconds' => $seconds,
               
            ]);
        }
        else{
            // 
        }

    }
    
    





}
