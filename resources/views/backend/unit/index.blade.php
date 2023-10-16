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
<div class="col-md-12">    <h2>Add your Unit here </h2>
</div>
    <div class="col-md-6 offset-md-3 bg-info rounded py-3">
        
        <form action="{{route('store.unit')}}" method="POST" >
            @csrf
            <div class="form-group ">
                <label for="brand_name">Unit Name</label>
                <input type="text" name="unit_name" class="form-control" id="">
                @error('unit_name')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="unit_desc">Unit description</label>
                <textarea class=" form-control" name="unit_desc" id="" cols="30" rows="10"></textarea>
            </div>
            
            <button class="btn btn-lg btn-success">Submit</button>
        </form>
    </div>
    
</div>

@endsection