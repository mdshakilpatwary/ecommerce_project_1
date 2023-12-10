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
  <h2>Update Additional Settings </h2>
</div>
    <div class="col-md-6 offset-md-3 rounded py-3" style="background: #fff; box-shadow: 0 0 8px #ddd">
        
        <form action="{{route('include.another.update', $data->id)}}" method="POST" >
            @csrf
            <div class="form-group ">
                <label for="shipping_charge_insite">Shipping charge insite Dhaka</label>
                <input type="text" name="shipping_charge_insite" class="form-control" id="" value="{{$data->shipping_charge_insite}}" placeholder="Enter your shipping charge">
                @error('shipping_charge_insite')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="shipping_charge_outsite">Shipping charge outsite Dhaka</label>
                <input type="text" name="shipping_charge_outsite" class="form-control" id="" value="{{$data->shipping_charge_outsite}}" placeholder="Enter your shipping charge">
                @error('shipping_charge_outsite')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group ">
                <label for="tax_vat">Tax/Vat</label>
                <input type="text" name="tax_vat" class="form-control" id="" value="{{$data->tax_vat}}" placeholder="Enter your tax/vat">
                @error('tax_vat')
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>
            
            <button class="btn btn-lg btn-success">Update</button>
        </form>
    </div>
    
</div>

@endsection