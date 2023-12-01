@extends('backend.master')

@section('maincontent')




<div class="row">
    <h2>All Color Here</h2>
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
                    <div class="table-responsive p-3" style="background: #fff; box-shadow: 0 0 8px #ddd">
                   
                        <table class="table table-striped dataTable no-footer" id="table-1" role="grid" aria-describedby="table-1_info">
                        <thead>
                          <tr role="row">
                            <th class="text-center sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 24.45px;" aria-label="
                              
                            : activate to sort column ascending">
                              #SL
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">Size</th>
                          
                           <th class="sorting_desc" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 108.283px;" aria-label="Status: activate to sort column ascending" aria-sort="descending">Status</th><th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 73.1167px;" aria-label="Action: activate to sort column ascending">Action</th></tr>
                        </thead>
                        <tbody>
                            
                          
                            @if(count($color_data) > 0)
                            @php
                          $sl = 1;
                          @endphp
                          @foreach($color_data as $color)
                            <tr role="row" class="even">
                            <td class="">
                              {{$sl++}}
                            </td>
                            <td>

                            @foreach(json_decode($color->color) as $colors)
                            <span class=" btn btn-sm btn-info">{{$colors->value}}</span>
                            @endforeach


                            <ul>
                                  

                            </td>
                           
                            
                            
                            <td class="sorting_1">

                              @if(Auth::user()->can('product.edit'))
                                @if($color->status == 1)
                                <a href="{{route('status.color', $color->id)}}" class="badge badge-success badge-shadow">Active</a>
                                @else
                                <a href="{{route('status.color', $color->id)}}" class="badge badge-danger badge-shadow">Inactive</a>
                                @endif
                              @else
                                @if($color->status == 1)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-warning ">Inactive</span>
                                @endif

                              @endif
                            </td>
                            <td>
                              @if(Auth::user()->can('product.edit') || Auth::user()->can('product.delete'))
                                @if(Auth::user()->can('product.delete'))
                                <a href="{{route('destroy.color', $color->id)}}" class="btn btn-sm btn-danger text-white "><i class="fa fa-trash"></i></a>
                                @endif
                                @if(Auth::user()->can('product.edit'))
                                <a href="{{route('edit.color', $color->id)}}" class="btn btn-sm btn-info text-white"><i class="fa fa-edit"></i></a>
                                @endif
                              @else
                              <span class="badge badge-light">No Action</span>
                              @endif
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