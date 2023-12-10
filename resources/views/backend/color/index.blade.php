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
  <h2>Add your Color here </h2>

</div>
    <div class="col-md-6 offset-md-3 rounded py-3" style="background: #fff; box-shadow: 0 0 8px #ddd">        
        <form action="{{route('store.color')}}" method="POST" >
            @csrf
            <div class="form-group">
                <label for="color">Color</label>
                <input name="color" class="form-control" id="tagsinput" placeholder="write some tags color" value="" >

              @error('color') 
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            
            <button class="btn btn-lg btn-success">Submit</button>
        </form>
    </div>
    
</div>

@endsection