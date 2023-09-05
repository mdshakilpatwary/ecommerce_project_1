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
    <h2>Add your Size here </h2>
    <div class="col-md-6 offset-md-3 bg-info rounded py-3">        
        <form action="{{route('store.size')}}" method="POST" >
            @csrf
            <div class="form-group ">
                <label for="size">Size</label>
                <input name="size" class="form-control" id="tagsinput" placeholder="write some tags" value="" >

              @error('size') 
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            
            <button class="btn btn-lg btn-success">Submit</button>
        </form>
    </div>
    
</div>

@endsection