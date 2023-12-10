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
<div class="col-md-12">    
  <h2>Add your Size here </h2>
</div>
    <div class="col-md-6 offset-md-3 mb-5 rounded py-3" style="background: #fff; box-shadow: 0 0 8px #ddd">        
        <form action="{{route('store.size')}}" method="POST" >
            @csrf
            <div class="form-group ">
                <label for="size">Size</label>
                <input name="size" class="form-control" id="tagsinput" placeholder="Enter your size" value="" >

              @error('size') 
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            
            <button class="btn btn-lg btn-success">Submit</button>
        </form>
    </div>

    <div class="col-md-6 offset-md-3 rounded py-3" style="background: #fff; box-shadow: 0 0 8px #ddd">        
       <h4>Add Liter/Kg wise size</h4>
        <form action="{{route('store.size.kg')}}" method="POST" >
            @csrf
            <div class="form-group ">
                <label for="kg_litter">Size kg/litter</label>
                <input name="kg_litter" class="form-control" id="tagsinput_kg" placeholder="Enter your kg/liter" value="" >

              @error('kg_litter') 
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            
            <button class="btn btn-lg btn-success">Submit</button>
        </form>
    </div>
    
</div>

@endsection