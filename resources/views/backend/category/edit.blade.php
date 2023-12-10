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
        
        <form action="{{route('update.catagory',$cat_data->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group ">
                <label for="cat_name">Category Name</label>
                <input type="text" name="cat_name" class="form-control" id="" value="{{$cat_data->cat_name}}">
                @error('cat_name')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group clearfix">
                <label for="cat_name">Category Name</label>
                <input type="file" name="cat_image" class="form-control mb-3 fileimage" id="">

                <img src="{{empty($category->cat_image)? asset('uploads/category/empty.png') : asset('uploads/category/'.$category->cat_image) }}" width="200" class="rounded changeImage" alt="">
            </div>
            <button class="btn btn-lg btn-success">Submit</button>
        </form>
    </div>
</div>
@endsection