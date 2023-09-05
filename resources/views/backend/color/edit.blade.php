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
    <h2>Edit your color here </h2>
    <div class="col-md-6 offset-md-3 bg-info rounded py-3">
        
        <form action="{{route('update.color',$color_data->id)}}" method="POST" >
            @csrf
            <div class="form-group ">
                <label for="color">Color</label>
                <input name="color" class="form-control" id="tagsinput" placeholder="write some tags" value="{{$color_data->color}}">
                @error('size')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <button class="btn btn-lg btn-success">Submit</button>
        </form>
    </div>
</div>
@endsection