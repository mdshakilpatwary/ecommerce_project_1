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
    <div class="col-md-6 offset-md-3 bg-info rounded py-3">
        
        <form action="{{route('update.product',$p_data->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group ">
                <label for="p_code">Product code</label>
                <input type="text" name="p_code" class="form-control" id="" value="{{$p_data->p_code}}">
                @error('p_code')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="p_name">Product Name</label>
                <input type="text" name="p_name" class="form-control" id="" value="{{$p_data->p_name}}">
                @error('p_name')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
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
            <div class="form-group ">
               <select name="select_subcat" id="" class="form-control select-form">
                <option value="" disabled selected>----Select SubCategory-----</option>
                @foreach($subcategories as $subcategory)
                <option value="{{$subcategory->id}}">{{$subcategory->subcat_name}}</option>
                <option value="{{ $subcategory->id }}" {{ $p_data->subcategory->id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->subcat_name }}</option>
                @endforeach
               </select>
                @error('select_subcat')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
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
            <div class="form-group ">
                <label for="select_color">Select Color</label>
                <select  name="select_color[]" id="product-colors" multiple >
                    @foreach($colors as $color)
                     @foreach(json_decode($color->color) as $color_value)
                        <option  value="{{$color_value->value}}" {{ in_array($color_value->value, explode('|', $p_data->color_id)) ? 'selected' : '' }} >{{$color_value->value}}</option>
                     @endforeach
                    @endforeach
                    ... more options here ...
                </select>

                @error('select_color')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="select_size">Select Size</label>
                <select  name="select_size[]" id="product-sizes" multiple >
                    @foreach($sizes as $size)
                     @foreach(json_decode($size->size) as $size_value)
                        <option  value="{{$size_value->value}}" {{ in_array($size_value->value, explode('|', $p_data->size_id)) ? 'selected' : '' }} >{{$size_value->value}}</option>
                     @endforeach
                    @endforeach
                    ... more options here ...
                </select>
                @error('select_size')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="p_price">Product Price</label>
                <input type="floatval" name="p_price" id="" value="{{$p_data->p_price}}" class="form-control">

                @error('p_price')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="discount_percentage">Discount Percentage</label>
                <input type="floatval" name="discount_percentage" id="" value="{{$p_data->discount_percentage}}" class="form-control">

                @error('discount_percentage')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="p_qty">Product quantity</label>
                <input type="floatval" name="p_qty" id="" value="{{$p_data->p_qty}}" class="form-control">

                @error('p_qty')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="p_desc">Description</label>
               </select>
               <textarea name="p_desc" class="summernote form-control">{!! $p_data->p_description !!}</textarea>

                @error('p_desc')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="p_image">Product Image</label>
                <input type="file" name="p_image" class="form-control fileimage" id="" >
                @error('p_image')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
                <img src="{{empty($p_data->p_image)? asset('uploads/product/empty.png') : asset('uploads/product/'.$p_data->p_image) }}" width="200" class="rounded changeImage pt-3" alt="" class="changeImage">
             
            </div>
            <div class="form-group">
                <label for="group_p_image">Product Image</label>
                <input type="file" name="group_p_image[]" class="form-control mb-2 g_fileimage" id="" multiple>
                @error('group_p_image')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
                @foreach(explode('|',$p_data->group_p_image) as $gimage)
                            <img src="{{empty($gimage)? asset('uploads/product/product_group/empty.png') : asset('uploads/product/product_group/'.$gimage) }}" alt="" width="100" height="100" class="g_changeImage">
                @endforeach
            </div>
            <button class="btn btn-lg btn-success">Submit</button>
        </form>
    </div>
</div>
@endsection