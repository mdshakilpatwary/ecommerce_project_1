<?php

?>

<div id="aside" class="col-md-3">
    <!-- Category Widget -->
    <div class="aside">
        <h3 class="aside-title">Categories</h3>
        <div class="checkbox-filter">
            @foreach($categories=App\Models\Category::where('cat_status',1)->get() as $category)
            @php
            $cat_count =App\Models\Product::catProductCount($category->id);	
            @endphp
            <div class="input-checkbox">
                <input type="checkbox" id="category-{{$category->id}}" {{ request()->is('show/category/product/' . $category->id) ? 'checked' : '' }}>
                <label for="category-{{$category->id}}">
                    <span></span>
                    <ul>
                        <li><a href="{{route('show.category.product',$category->id)}}">{{$category->cat_name}}</a> <small>({{$cat_count}})</small></li>
                    </ul>
                    
                </label>
            </div>
            @endforeach
            
        </div>
    </div>

    <!-- aside Widget -->
    <div class="aside">
        <h3 class="aside-title">Price</h3>
        <div class="price-filter">
            <div id="price-slider" ></div>            
            <div class="div" style="display: flex; justify-content: space-around; align-items: center; width: 100%">
                
                <div class="form-group" > <input class="form-control" style="width: 80px; background:none;"  id="price-min"  disabled class="price_range_filter" type="text"></div>                
                <div class="form-group"><button  class="price_range_filter ">Click</button></div>
                <div class="form-group"><input class="form-control" style="width: 80px; background: none;" id="price-max" disabled class="price_range_filter" type="text"> </div>
            </div>
        </div>
    </div>
    <!-- /aside Widget -->
    
    <!-- /aside Widget -->

    <!-- Sub Category Widget -->
    <div class="aside">
        <h3 class="aside-title">Sub Categories</h3>
        <div class="checkbox-filter">
            @foreach($subCategories=App\Models\SubCategory::where('status',1)->get() as $subcategory)
            @php
            $sub_cat_count =App\Models\Product::subcatProductCount($subcategory->id);	
            @endphp
            <div class="input-checkbox">
                <input type="checkbox" id="category-{{$subcategory->id}}" {{ request()->is('show/subcategory/product/' . $subcategory->id) ? 'checked' : '' }}>
                <label for="category-{{$subcategory->id}}">
                    <span></span>
                    <ul>
                        <li><a href="{{route('show.subcategory.product',$subcategory->id)}}">{{$subcategory->subcat_name}}</a> <small>({{$sub_cat_count}})</small></li>
                    </ul>
                    
                </label>
            </div>
            @endforeach
            
        </div>
    </div>
    <!-- /aside Widget -->

    <!-- aside Widget -->
    <div class="aside">
        <h3 class="aside-title">Brand</h3>
        <div class="checkbox-filter">
            @foreach($brands =App\Models\Brand::where('status',1)->get() as $brand)
            @php
            $brand_count =App\Models\Product::brandProductCount($brand->id);	
            @endphp
            <div class="input-checkbox">
                <input type="checkbox" id="brand-{{$brand->id}}" {{ request()->is('show/brand/product/' . $brand->id) ? 'checked' : '' }} >
                <label for="brand-{{$brand->id}}">
                    <span></span>
                    <ul>
                        <li><a href="{{route('show.brand.product',$brand->id)}}">{{$brand->brand_name}}</a> <small>({{$brand_count}})</small></li>

                    </ul>
                </label>
            </div>
            @endforeach
        </div>
    </div>
    <!-- /aside Widget -->

    <!-- aside Widget -->
    <div class="aside">
        <h3 class="aside-title">Top selling</h3>
        @foreach($topProducts as $product)
            @if ($loop->iteration <= 3)
            <div class="product-widget">
                <div class="product-img">
                    <img src="{{asset('uploads/product/'.$product->p_image)}}" alt="">
                </div>
                <div class="product-body">
                    <p class="product-category">{{$product->category->cat_name}}</p>
                    <h3 class="product-name"><a href="{{route('single.product',$product->id)}}">{{$product->p_name}}</a></h3>
                    <h4 class="product-price">&#2547;{{$product->p_price -($product->p_price*($product->discount_percentage/100))}} <del class="product-old-price">&#2547;{{$product->p_price}}</del></h4>
                </div>
            </div>
            @endif
            @endforeach
    </div>
    <!-- /aside Widget -->
</div>