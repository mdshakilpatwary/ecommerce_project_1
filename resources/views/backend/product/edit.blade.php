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
    <h2>Add your category here </h2>
    <div class="col-md-6 offset-md-3 rounded py-3" style="background: #fff; box-shadow: 0 0 8px #ddd">
        
        <form action="{{route('update.product',$p_data->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="row">  
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="p_code">Product code</label>
                <input type="text" name="p_code" class="form-control" id="" value="{{$p_data->p_code}}">
                @error('p_code')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="p_name">Product Name</label>
                <input type="text" name="p_name" class="form-control" id="" value="{{$p_data->p_name}}">
                @error('p_name')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="select_cat">Select Category</label>
               <select name="select_cat" id="" class="form-control select-form">
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $p_data->category->id == $category->id ? 'selected' : '' }}>{{ $category->cat_name }}</option>
                @endforeach
               </select>
                @error('select_cat')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="select_subcat">Select Sub Category</label>
               <select name="select_subcat" id="" class="form-control select-form">
                <option value="" disabled selected>----Select SubCategory-----</option>
                @foreach($subcategories as $subcategory)
                <option value="{{ $subcategory->id }}" {{ $p_data->subcategory->id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->subcat_name }}</option>
                @endforeach
               </select>
                @error('select_subcat')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="select_brand">Select Brand</label>
               <select name="select_brand" id="" class="form-control select-form">
                @foreach($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                <option value="{{ $brand->id }}" {{ $p_data->brand->id == $brand->id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>

                @endforeach
               </select>
                @error('select_brand')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="select_color">Select Color</label>
                <select  name="select_color[]" id="product-colors" multiple >
                      {{-- dublicate value no entry code  --}}
                      @php
                      $allColors = $colors->flatMap(function ($color) {
                          return json_decode($color->color, true);
                      });      
                      $uniqueColors = $allColors->unique('value')->pluck('value');  
                      @endphp
                      
                       @foreach($uniqueColors as $color_value)
                        <option  value="{{$color_value}}" {{ in_array($color_value, explode('|', $p_data->color_id)) ? 'selected' : '' }} >{{$color_value}}</option>
                     @endforeach
                    ... more options here ...
                </select>

                @error('select_color')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <!-- size  -->
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
                            <option  value="{{$size_value}}" {{ in_array($size_value, explode('|', $p_data->size_id)) ? 'selected' : '' }} >{{$size_value}}</option>
                        @endforeach
                        ... more options here ...
                    </select>
                </div>
                <div id="size_d_2">
                    <select  name="select_size_kg[]" id="product-sizes-2" multiple >
                    {{-- dublicate value no entry code  --}}
                    @php
                    $allsizeKg = $kg_size->flatMap(function ($kg) {
                        return json_decode($kg->kg_litter, true);
                    });      
                    $uniqueSizekg = $allsizeKg->unique('value')->pluck('value');  
                    @endphp
                        @foreach($uniqueSizekg as $kg_value)
                            <option  value="{{$kg_value}}" {{ in_array($kg_value, explode('|', $p_data->kg_liter)) ? 'selected' : '' }} >{{$kg_value}}</option>
                         @endforeach
                        ... more options here ...
                    </select>
                </div>
                @php
                if($p_data->size_id !=null){
                $size_data_value = explode('|', $p_data->size_id);
                }
                else{
                $size_data_value = explode('|', $p_data->kg_liter);
                }
                    
                @endphp
                <div class="form-control" id="product-sizes-disable">
                @foreach ($size_data_value as $item_size)
                <span class="badge badge-light">{{$item_size}}</span>
                @endforeach
                </div>
                @error('select_size')
                <p class="text-danger ">{{$message}}</p>
                @enderror
                
                <!-- size  -->
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="p_price">Product Price</label>
                <input type="floatval" name="p_price" id="" value="{{$p_data->p_price}}" class="form-control">

                @error('p_price')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="discount_percentage">Discount Percentage</label>
                <input type="floatval" name="discount_percentage" id="" value="{{$p_data->discount_percentage}}" class="form-control">

                @error('discount_percentage')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6 col-xl-6 col-12">
                <label for="p_qty">Product quantity</label>
                <input type="floatval" name="p_qty" id="" value="{{$p_data->p_qty}}" class="form-control">

                @error('p_qty')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-12 col-xl-12 col-12">
                <label for="p_desc">Description</label>
               </select>
               <textarea name="p_desc" class="summernote form-control">{!! $p_data->p_description !!}</textarea>

                @error('p_desc')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group col-md-12 col-xl-12 col-12">
                <label for="p_image">Product Image</label>
                <input type="file" name="p_image" class="form-control fileimage" id="" >
                @error('p_image')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
                <img src="{{empty($p_data->p_image)? asset('uploads/product/empty.png') : asset('uploads/product/'.$p_data->p_image) }}" width="200" class="rounded changeImage pt-3" alt="" class="changeImage">
             
            </div>
            <div class="form-group col-md-12 col-xl-12 col-12">
                <label for="group_p_image">Product Image</label>
                <input type="file" name="group_p_image[]" class="form-control mb-2 g_fileimage" id="" multiple>
                @error('group_p_image')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
                @foreach(explode('|',$p_data->group_p_image) as $gimage)
                            <img src="{{empty($gimage)? asset('uploads/product/product_group/empty.png') : asset('uploads/product/product_group/'.$gimage) }}" alt="" width="100" height="100" class="g_changeImage">
                @endforeach
            </div>
            <button class="btn btn-lg btn-success">Update</button>
        </div>
        </form>
    </div>
</div>
@endsection