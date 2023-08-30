@extends('backend.master')

@section('maincontent')
<div class="row mt-2">
@if(session('success'))

<div class="container py-5">
<div class="alert alert-warning alert-dismissible fade show alertsuccess" role="alert">
  <strong>Success</strong> {{ session('success')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@elseif(session('error'))
<div class="container py-5">
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Success</strong> {{ session('error')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif
    <h2>Add your category here </h2>
    <div class="col-md-6 offset-md-3 bg-info rounded py-3">
        
        <form action="{{route('store.catagory')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group ">
                <label for="cat_name">Category Name</label>
                <input type="text" name="cat_name" class="form-control" id="">
            </div>
            <div class="form-group">
                <label for="cat_name">Category Name</label>
                <input type="file" name="cat_image" class="form-control" id="">
            </div>
            <button class="btn btn-lg btn-success">Submit</button>
        </form>
    </div>
</div>
@endsection