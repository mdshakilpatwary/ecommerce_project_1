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
    <h2>Edit your Kg/Liter here </h2>
    <div class="col-md-6 offset-md-3  rounded py-3" style="background: #fff; box-shadow: 0 0 10px #ddd">
        
        <form action="{{route('update.size.kg',$kg_data->id)}}" method="POST" >
            @csrf
            <div class="form-group ">
                <label for="unit_name">Size</label>
                <input name="kg_litter" class="form-control" id="tagsinput" placeholder="write some tags" value="{{$kg_data->kg_litter}}">
                @error('kg_litter')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <button class="btn btn-lg btn-success">Update</button>
        </form>
    </div>
</div>
@endsection