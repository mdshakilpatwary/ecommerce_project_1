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
</div>

<div class="row">
  <div class="col-md-12">   
    <h2>Add Product Offer Deal Content </h2>
  </div>
  <div class="col-md-8 offset-md-2 rounded py-3" style="background: #fff; box-shadow: 0 0 8px #ddd">
      
@if(App\Models\OfferDealContent::all() != null)
<form action="{{route('offer.content.store')}}" method="POST" >
  @csrf
  <div class="row " >
      <div class="form-group col-md-6 col-xl-6 col-12">
        <label for="offer_heading">Offer Heading </label>
        <input type="text" name="offer_heading" class="form-control" id="offer_heading">
        @error('offer_heading')
            <p class="text-danger ">{{$message}}</p>
        @enderror
      </div>
      <div class="form-group col-md-6 col-xl-6 col-12">
          <label for="offer_content">Offer Content </label>
          <input type="text" name="offer_content" class="form-control" id="offer_content">
          @error('offer_content')
              <p class="text-danger ">{{$message}}</p>
          @enderror
      </div>
      
      <div class="form-group col-md-6 col-xl-6 col-12">
          <label for="offer_start_date">Offer Start Date </label>
          <input type="date" name="offer_start_date" class="form-control" id="offer_start_date">
          @error('offer_start_date')
              <p class="text-danger ">{{$message}}</p>
          @enderror
      </div>
      <div class="form-group col-md-6 col-xl-6 col-12">
          <label for="offer_end_date">Offer End Date </label>
          <input type="date" name="offer_end_date" class="form-control" id="offer_end_date">
          @error('offer_end_date')
              <p class="text-danger ">{{$message}}</p>
          @enderror
      </div>
      <div class="form-group col-md-6 col-xl-6 col-12">
          <label for="offerimage1">Offer Content Image 01  </label>
          <input type="file" name="offerimage1" class="form-control" id="offerimage1">
          @error('offerimage1')
              <p class="text-danger ">{{$message}}</p>
          @enderror
      </div>
      <div class="form-group col-md-6 col-xl-6 col-12">
          <label for="offerimage2">Offer Content Image 02  </label>
          <input type="file" name="offerimage2" class="form-control" id="offerimage2">
          @error('offerimage2')
              <p class="text-danger ">{{$message}}</p>
          @enderror
      </div>
      
      
      <div class="col-md-12 col-xl-12 col-12">
        <button class="btn btn-lg btn-success">Submit</button>
      </div>  </div>
</form>
@else
<form action="{{route('offer.content.store')}}" method="POST" >
  @csrf
  <div class="row">
      <div class="form-group col-md-6 col-xl-6 col-12">
        <label for="offer_heading">Offer Heading </label>
        <input type="text" name="offer_heading" class="form-control" id="offer_heading">
        @error('offer_heading')
            <p class="text-danger ">{{$message}}</p>
        @enderror
      </div>
      <div class="form-group col-md-6 col-xl-6 col-12">
          <label for="offer_content">Offer Content </label>
          <input type="text" name="offer_content" class="form-control" id="offer_content">
          @error('offer_content')
              <p class="text-danger ">{{$message}}</p>
          @enderror
      </div>
      
      <div class="form-group col-md-6 col-xl-6 col-12">
          <label for="offer_start_date">Offer Start Date </label>
          <input type="date" name="offer_start_date" class="form-control" id="offer_start_date">
          @error('offer_start_date')
              <p class="text-danger ">{{$message}}</p>
          @enderror
      </div>
      <div class="form-group col-md-6 col-xl-6 col-12">
          <label for="offer_end_date">Offer End Date </label>
          <input type="date" name="offer_end_date" class="form-control" id="offer_end_date">
          @error('offer_end_date')
              <p class="text-danger ">{{$message}}</p>
          @enderror
      </div>
      <div class="form-group col-md-6 col-xl-6 col-12">
          <label for="offerimage1">Offer Content Image 01  </label>
          <input type="file" name="offerimage1" class="form-control" id="offerimage1">
          @error('offerimage1')
              <p class="text-danger ">{{$message}}</p>
          @enderror
      </div>
      <div class="form-group col-md-6 col-xl-6 col-12">
          <label for="offerimage2">Offer Content Image 02  </label>
          <input type="file" name="offerimage2" class="form-control" id="offerimage2">
          @error('offerimage2')
              <p class="text-danger ">{{$message}}</p>
          @enderror
      </div>
      
      <div class="col-md-12 col-xl-12 col-12">
        <button class="btn btn-lg btn-success">Update</button>
      </div>
  </div>
</form>
@endif
  </div>
</div>

@endsection