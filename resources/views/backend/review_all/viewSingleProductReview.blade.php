@extends('backend.master')

@section('maincontent')




<div class="row">
    <h2>Single product review </h2>
    <div class="col-md-10 offset-md-1">
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
<div class="mb-2"><a class="btn btn-sm btn-dark" href="{{route('review.show.all')}}">View All Product Review</a></div>

                    <div class="table-responsive">
                   
                        <table class="table table-striped dataTable no-footer" id="table-1" role="grid" aria-describedby="table-1_info">
                        <thead>
                          <tr role="row">
                            <th class="text-center sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 24.45px;" aria-label="
                              
                            : activate to sort column ascending">
                              #SL
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">Product Code</th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">Product Name</th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">User name</th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">Email</th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">Review</th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">Rating</th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">Action</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                            
                          
                            @if(count($reviewAll) > 0)
                            @php
                          $sl = 1;
                          @endphp
                            @foreach($reviewAll as $review_item)
                            <tr role="row" class="even">
                            <td class="">
                              {{$sl++}}
                            </td>
                            <td>{{$review_item->product->p_code}}</td>
                            <td>{{$review_item->product->p_name}}</td>
                            <td>{{$review_item->user->name}}</td>
                            <td>{{$review_item->email}}</td>
                            <td>{{$review_item->review}}</td>
                            <td>{{$review_item->rating}} Star</td>
                            
                           
                            
                            
                            {{-- <td class="sorting_1">
                              @if($unit->status == 1)
                              <a href="{{route('status.unit', $unit->id)}}" class="badge badge-success badge-shadow">Active</a>
                              @else
                              <a href="{{route('status.unit', $unit->id)}}" class="badge badge-danger badge-shadow">Inactive</a>

                              @endif
                            </td> --}}
                            <td>
                                <a href="{{route('review.destroy', $review_item->id)}}" class="btn btn-sm btn-danger text-white "><i class="fa fa-trash"></i></a>
                            </td>
                            </tr>
                            
                            @endforeach
                            
                            @else
                            <tr>
                                <td colspan="5"><p class="bg-danger text-center"> No Data </p></td>
                            </tr>
                            @endif
                         
                        </tbody>
                      </table>
                    </div>
                  </div>
    </div>
</div>
@endsection