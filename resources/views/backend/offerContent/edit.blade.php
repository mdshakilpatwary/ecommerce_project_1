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
        
        <form action="{{route('update.unit',$unit_data->id)}}" method="POST" >
            @csrf
            <div class="form-group ">
                <label for="unit_name">Unit Name</label>
                <input type="text" name="unit_name" class="form-control" id="" value="{{$unit_data->unit_name}}">
                @error('unit_name')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group clearfix">
                <label for="unit_name">Unit Description</label>
                <textarea class=" form-control" name="unit_desc" id="" cols="30" rows="10">{{$unit_data->unit_description}}</textarea>
            </div>
            <button class="btn btn-lg btn-success">Submit</button>
        </form>
    </div>
</div>
@endsection