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
    <div class="col-md-6 offset-md-3 bg-info rounded py-3">
        
        <form action="{{route('store.product')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group ">
                <label for="p_code">Product code</label>
                <input type="text" name="p_code" class="form-control" id="" value="{{old('p_code')}}">
                @error('p_code')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="p_name">Product Name</label>
                <input type="text" name="p_name" class="form-control" id="">
                @error('p_name')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="select_cat">Select Category</label>
               <select name="select_cat" id="" class="form-control select-form">
                <option value="" disabled selected>----Select Category-----</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->cat_name}}</option>
                @endforeach
               </select>
                @error('select_cat')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="select_subcat">Select SubCategory</label>
               <select name="select_subcat" id="" class="form-control select-form">
                <option value="" disabled selected>----Select SubCategory-----</option>
                @foreach($subcategories as $subcategory)
                <option value="{{$subcategory->id}}">{{$subcategory->subcat_name}}</option>
                @endforeach
               </select>
                @error('select_subcat')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="select_brand">Select Brand</label>
               <select name="select_brand" id="" class="form-control select-form">
                <option value="" disabled selected>----Select Brand-----</option>
                @foreach($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                @endforeach
               </select>
                @error('select_brand')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            <div class="form-group ">
                <label for="select_unit">Select Unit</label>
               <select name="select_unit" id="" class="form-control select-form">
                <option value="" disabled selected>----Select Unit-----</option>
                @foreach($units as $unit)
                <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                @endforeach
               </select>
                @error('select_unit')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="select_color">Select Color</label>
               <select name="select_color" id="" class="form-control select-form">
                <option value="" disabled selected>----Select Color-----</option>
                @foreach($colors as $color)
                @foreach(json_decode($color->color) as $color_value)
                <option value="{{$color_value->value}}">{{$color_value->value}}</option>
                 @endforeach
                @endforeach
               </select>
                @error('select_color')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="select_size">Select Size</label>
               <select name="select_size" id="" class="form-control select-form">
                <option value="" disabled selected>----Select Size-----</option>
                @foreach($sizes as $size)
                @foreach(json_decode($size->size) as $size_value)
                <option value="{{$size->id}}">{{$size_value->value}}</option>
                 @endforeach
                @endforeach
               </select>
                @error('select_size')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="p_price">Product Price</label>
                <input type="floatval" name="p_price" id="" class="form-control">

                @error('p_price')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="p_desc">Description</label>
               </select>
               <textarea name="p_desc" class="summernote form-control"></textarea>

                @error('p_desc')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="p_image">Product Image</label>
                <input type="file" name="p_image" class="form-control" id="" >
                @error('p_image')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
             
            </div>
            <div class="form-group">
                <label for="group_p_image">Product Image</label>
                <input type="file" name="group_p_image[]" class="form-control" id="" multiple>
                @error('group_p_image')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>

            <button class="btn btn-lg btn-success">Add Product</button>
        </form>
    </div>
</div>


@endsection