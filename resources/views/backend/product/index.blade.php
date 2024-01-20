@extends('backend.master')

@section('maincontent')
<div class="row mt-2">
@if(session('success'))

<div class="container alertsuccess">
<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('success')}}
                      </div>
 </div>
</div>
@elseif(session('error'))
<div class="container alerterror">
<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('error')}}
                      </div>
 </div>
</div>

@endif
    <h2>Add your Product here </h2>
    <div class="col-md-8 col-12 offset-md-2 rounded p-3" style="background: #fff; box-shadow: 0 0 8px #ddd">
        
        <form action="{{route('store.product')}}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="row  px-2">
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="p_code">Product code</label>
                <input type="text" name="p_code" class="form-control" id="" value="{{old('p_code')}}">
                @error('p_code')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="p_name">Product Name</label>
                <input type="text" name="p_name" class="form-control" id="" value="{{old('p_name')}}">
                @error('p_name')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="select_cat">Select Category</label>
               <select name="select_cat" id="" class="form-control select-form">
                <option value="" disabled selected>----Select Category-----</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}" {{old('select_cat') == $category->id ? 'selected': ''}}>{{$category->cat_name}}</option>
                @endforeach
               </select>
                @error('select_cat')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="select_subcat">Select SubCategory</label>
               <select name="select_subcat" id="" class="form-control select-form">
                <option value="" disabled selected>----Select SubCategory-----</option>
                @foreach($subcategories as $subcategory)
                <option value="{{$subcategory->id}}" {{old('select_subcat') == $subcategory->id ? 'selected': ''}}>{{$subcategory->subcat_name}}</option>
                @endforeach
               </select>
                @error('select_subcat')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="select_brand">Select Brand</label>
               <select name="select_brand" id="" class="form-control select-form">
                <option value="" disabled selected>----Select Brand-----</option>
                @foreach($brands as $brand)
                <option value="{{$brand->id}}" {{old('select_brand') == $brand->id ? 'selected': ''}}>{{$brand->brand_name}}</option>
                @endforeach
               </select>
                @error('select_brand')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
           
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="select_color">Select Color</label>
                <select  name="select_color[]" id="product-colors" multiple>
                    {{-- dublicate value no entry code  --}}
                    @php
                    $allColors = $colors->flatMap(function ($color) {
                        return json_decode($color->color, true);
                    });      
                    $uniqueColors = $allColors->unique('value')->pluck('value');  
                    @endphp
                    
                     @foreach($uniqueColors as $color_value)

                        <option value="{{$color_value}}">{{$color_value}}</option>
                     @endforeach
                    ... more options here ...
                </select>
                @error('select_color')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <div class="d-flex justify-content-between"> <label for="select_size">Select Size/kg</label>  <span class="badge badge-light mb-2"><input id="size_d_1_btn" type="checkbox"><label class="mb-0" for="size_d_1_btn">Add size</label></span> <span class="badge badge-light mb-2"><input id="size_d_2_btn" type="checkbox"><label class="mb-0" for="size_d_2_btn">Add kg</label></span> </div>
                <div id="size_d_1">
                    <select  name="select_size[]" id="product-sizes-1" multiple >
                        {{-- dublicate value no entry code  --}}
                    @php
                    $allsizes = $sizes->flatMap(function ($size) {
                        return json_decode($size->size, true);
                    });      
                    $uniqueSizes = $allsizes->unique('value')->pluck('value');  
                    @endphp
                           @foreach( $uniqueSizes as $size_value)
                              <option   value="{{$size_value}}">{{$size_value}}</option>
                           @endforeach
                        
                       ... more options here ...
                    </select>
                    
                </div>
                <div id="size_d_2">
                    <select  name="select_size_kg[]" id="product-sizes-2" multiple >
                    {{-- dublicate value no entry code  --}}
                    @php
                    $allsizeKg = $kg_data->flatMap(function ($kg) {
                        return json_decode($kg->kg_litter, true);
                    });      
                    $uniqueSizekg = $allsizeKg->unique('value')->pluck('value');  
                    @endphp
                        
                           @foreach($uniqueSizekg as $kg_value)
                              <option   value="{{$kg_value}}">{{$kg_value}}</option>
                           @endforeach
                        
                       ... more options here ...
                    </select>
                </div>
                <select  id="product-sizes-disable" class="form-control select-form" >
                    <option value="">Select Size/kg</option>                
                </select>
                @error('select_sizes')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
                @error('select_size_kg')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="p_price">Product Price</label>
                <input type="floatval" name="p_price" id="" value="{{old('p_price')}}" class="form-control">

                @error('p_price')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="discount_percentage">Discount Percentage</label>
                <input type="floatval" name="discount_percentage" value="{{old('discount_percentage')}}" id="" class="form-control">

                @error('discount_percentage')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="p_qty">Product quantity</label>
                <input type="floatval" name="p_qty" id="" value="{{old('p_qty')}}" class="form-control">

                @error('p_qty')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-12 col-xl-12 col-12">
                <label for="short_description">Short Description</label>
                <textarea class="form-control" name="short_description" id="short_description" cols="5" rows="5" placeholder="Enter Your Product Short Description"></textarea>
                @error('short_description')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="p_desc">Log Description</label>
               <textarea name="p_desc" class="summernote form-control">{{old('p_desc')}}</textarea>

                @error('p_desc')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-12 col-xl-12 col-12">
                <label for="p_details">Product Details(Optional)</label>
                <textarea class="form-control" name="p_details" id="p_details" cols="5" rows="5" placeholder="Enter Product Details"></textarea>
            </div>

            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="p_image">Product Image</label>
                <input type="file" name="p_image" class="form-control" id="" >
                @error('p_image')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
             
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="group_p_image">Product Group Image</label>
                <input type="file" name="group_p_image[]" class="form-control" id="" multiple>
                @error('group_p_image')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>

            <button class="btn btn-lg btn-success">Add Product</button>
        </div>
        </form>
    </div>
</div>







@endsection
