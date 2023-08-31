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
    <h2>Add your sub category here </h2>
    <div class="col-md-6 offset-md-3 bg-info rounded py-3">
        
        <form action="{{route('store.subcatagory')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group ">
                <label for="select_category">Select Category Name</label>
                <select name="select_category" id="" class="form-control select-form">
                  <option value="" class="disable selected">---Select Category</option>
                  @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->cat_name}}</option>

                  @endforeach
                </select>
                @error('select_category')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="subcat_name">Sub Category Name</label>
                <input type="text" name="subcat_name" class="form-control" id="">
                @error('subcat_name')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="subcat_name">SUb Category Name</label>
                <input type="file" name="subcat_image" class="form-control" id="">
            </div>
            <button class="btn btn-lg btn-success">Submit</button>
        </form>
    </div>
</div>
@endsection