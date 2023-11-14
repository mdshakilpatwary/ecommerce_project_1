@extends('frontend.master')

@section('mainbody')


		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
                <h3 class="text-center text-danger ">Customer Dashboard</h3>
                <h4>Name : <span>{{Auth::user()->name}}</span></h4>
                <h4>Email : <span>{{Auth::user()->email}}</span></h4>
                <div class="customer_order">
                    <h4 class="text-center">My Order</h4>
                    <br>
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
                        <tbody>
                            @if(count($orderData) > 0)
                            @php
                            $sl = 1;
                            @endphp
                               @foreach($orderData as $data)
                                <tr role="row">
                                    <td>{{$sl++}}</td>
                                    <td>{{$data->customer->name}}</td>
                                    <td>{{$data->total}}</td>
                                    <td>{{$data->payment->paymentMethod}}</td>
                                    <td>{{\Carbon\Carbon::parse($data->create_at)->format('M d,y-  h:iA')}}</td>
                                    <td>{{$data->status}}</td>
                                    <td>
                                        <a href="{{route('order.invoice',$data->id )}}" class="btn btn-sm btn-info">Details</a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="7"><p class="bg-danger text-center"> No Order </p></td>
                                </tr>
                                @endif

                            
                         
                         
                            </tbody>
                            <tfoot>
                                
                            </tfoot>
                          </table>
                </div>
            </div>
			<!-- /container -->
		</div>
		<!-- /Section -->
@endsection