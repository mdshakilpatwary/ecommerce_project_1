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
        
        <form action="{{route('update.brand',$brand_data->id)}}" method="POST" >
            @csrf
            <div class="form-group ">
                <label for="cat_name">Brand Name</label>
                <input type="text" name="brand_name" class="form-control" id="" value="{{$brand_data->brand_name}}">
                @error('brand_name')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group clearfix">
                <label for="cat_name">Brand Description</label>
                <textarea class=" form-control" name="brand_desc" id="" cols="30" rows="10">{{$brand_data->brand_description}}</textarea>
            </div>
            <button class="btn btn-lg btn-success">Submit</button>
        </form>
    </div>
</div>
@endsection