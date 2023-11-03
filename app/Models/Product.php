<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'cat_id',
        'subcat_id',
        'brand_id',
        'unit_id',
        'size_id',
        'color_id',
        'p_code',
        'p_name',
        'p_description',
        'p_image',
        'p_price',
        'group_p_image',
        'p_slug',
        'status',
        
    ];

    function category(){
        return $this->belongsTo(Category::class, 'cat_id', 'id');
     }
    function subcategory(){
        return $this->belongsTo(SubCategory::class, 'subcat_id', 'id');
     }
    function brand(){
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
     }
    function unit(){
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
     }
    function color(){
        return $this->belongsTo(Color::class, 'color_id', 'id');
     }
    function size(){
        return $this->belongsTo(Size::class, 'size_id', 'id');
     }

     public static function catProductCount($cat_id){
        $cat_p_count = Product::where('cat_id', $cat_id)->where('status',1)->count();
        return $cat_p_count;
     }
     public static function subcatProductCount($subcat_id){
        $subcat_p_count = Product::where('subcat_id', $subcat_id)->where('status',1)->count();
        return $subcat_p_count;
     }
     public static function brandProductCount($brand_id){
        $brand_p_count = Product::where('brand_id', $brand_id)->where('status',1)->count();
        return $brand_p_count;
     }
}
