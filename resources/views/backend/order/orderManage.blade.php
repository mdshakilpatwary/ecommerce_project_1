@extends('backend.master')

@section('maincontent')




<div class="row">
    <h2>All Customer Order Product Here</h2>
    <div class="col-md-12 ">
    <div class="card-body">
@if(session('success'))

<div class="container alertsuccess">
<div class="alert alert-success alert-dismissible show fade '">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('success')}}
                      </div>
 </div>
</div>
@elseif(session('error'))
<div class="container alerterror'">
<div class="alert alert-success alert-dismissible show fade ">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('error')}}
                      </div>
 </div>
</div>

@endif
                    <div class="table-responsive p-3" style="background: #fff; box-shadow: 0 0 8px #ddd">
                   
                        <table class="table table-striped dataTable no-footer" id="table-1" role="grid" aria-describedby="table-1_info">
                        <thead>
                          <tr role="row">
                            <th class="text-center sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 24.45px;" aria-label="
                              
                            : activate to sort column ascending">
                              #SL
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">Customer Name</th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">Order Total</th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">Payment Method</th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">Date and Time</th>
                           
                           <th class="sorting_desc" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 108.283px;" aria-label="Status: activate to sort column ascending" aria-sort="descending">Status</th><th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 73.1167px;" aria-label="Action: activate to sort column ascending">Action</th></tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            @php
                            $sl = 1;
                            @endphp
                               @foreach($orderData as $data)
                                <tr role="row">
                                    <td>{{$sl++}}</td>
                                    <td>{{$data->customer->name}}</td>
                                    <td>&#2547;{{$data->total}}</td>
                                    <td>{{$data->payment->paymentMethod}}</td>
                                    <td>{{$data->created_at->format('M d,y-  h:iA')}}</td>
                                    <td>
                                      @if(Auth::user()->can('order.edit'))
                                      <button data-toggle="modal" data-target="#orderStatusmodel_{{$data->id}}"  class="btn btn-sm btn-dark " style="text-transform: capitalize">{{$data->status}}</button>
                                      @else
                                      <span class="badge badge-light">{{$data->status}}</span>
                                      @endif
                                    </td>
                                    <td>
                                      @if(Auth::user()->can('order.view') || Auth::user()->can('order.delete'))
                                          @if(Auth::user()->can('order.view'))
                                          <a href="{{route('order.product.details',$data->id)}}" class="btn btn-sm btn-info">Details</a>
                                          @endif
                                          @if(Auth::user()->can('order.delete'))
                                          <a href="{{route('order.product.details.delete',$data->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                          @endif
                                      @endif
                                    </td>
                                </tr>

                    <!-- order status Modal -->
<div class="modal fade" id="orderStatusmodel_{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Status update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('order.status.update', $data->id)}}" method="POST">
        @csrf

      <div class="modal-body ">
          <select name="status" id="" class="form-control">
            <option disabled >Select Here</option>
            <option value="Processing">Processing</option>
            <option value="Shipping">Shipping</option>
            <option value="Deliverd">Deliverd</option>
          </select>
          
        
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
        <button class="btn btn-info">Update status</button>
      </div>
    </form>
    </div>
  </div>
</div>

  @endforeach

                            
                         
                         
                        </tbody>
                        <tfoot>
                            
                        </tfoot>
                      </table>
                    </div>
                  </div>
    </div>
</div>

@endsection