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
        
        <form action="{{route('update.subcatagory',$subcat_data->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group ">
                <label for="cat_name">Category Name</label>
                <input type="text" name="subcat_name" class="form-control" id="" value="{{$subcat_data->subcat_name}}">
                @error('subcat_name')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="select_category">Select Category Name</label>
                <select name="select_category" id="" class="form-control select-form">
                  @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ $subcat_data->category->id == $category->id ? 'selected' : '' }}>{{ $category->cat_name }}</option>

                  @endforeach
                </select>
                @error('select_category')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group clearfix">
                <label for="subcat_name">Sub Category Image</label>
                <input type="file" name="subcat_image" class="form-control mb-3 fileimage" id="">

                <img src="{{empty($subcat_data->subcat_image)? asset('uploads/subcategory/empty.png') : asset('uploads/subcategory/'.$subcat_data->subcat_image) }}" width="200" class="rounded changeImage" alt="">
            </div>
            <button class="btn btn-lg btn-success">Submit</button>
        </form>
    </div>
</div>
@endsection