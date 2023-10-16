@extends('backend.master')

@section('maincontent')




<div class="row">
    <h2>All Sub Category Here</h2>
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
                    <div class="table-responsive">
                   
                        <table class="table table-striped dataTable no-footer" id="table-1" role="grid" aria-describedby="table-1_info">
                        <thead>
                          <tr role="row">
                            <th class="text-center sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 24.45px;" aria-label="
                              
                            : activate to sort column ascending">
                              #SL
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">Sub Category Name</th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">Category Name</th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">Image</th>
                           
                           <th class="sorting_desc" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 108.283px;" aria-label="Status: activate to sort column ascending" aria-sort="descending">Status</th><th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 73.1167px;" aria-label="Action: activate to sort column ascending">Action</th></tr>
                        </thead>
                        <tbody>
                            
                          
                            @if(count($subcat_data) > 0)
                            @php
                          $sl = 1;
                          @endphp
                            @foreach($subcat_data as $subcategory)
                            <tr role="row" class="even">
                            <td class="">
                              {{$sl++}}
                            </td>
                            <td>{{$subcategory->subcat_name}}</td>
                            <td>{{$subcategory->category->cat_name}}</td>
                            <td>
                              <img src="{{empty($subcategory->subcat_image)? asset('uploads/subcategory/empty.png') : asset('uploads/subcategory/'.$subcategory->subcat_image) }}" alt="" width="50" height="50" >
                            </td>
                           
                            
                            
                            <td class="sorting_1">
                              @if($subcategory->status == 1)
                              <a href="{{route('status.subcatagory', $subcategory->id)}}" class="badge badge-success badge-shadow">Active</a>
                              @else
                              <a href="{{route('status.subcatagory', $subcategory->id)}}" class="badge badge-danger badge-shadow">Inactive</a>

                              @endif
                            </td>
                            <td>
                                <a href="{{route('destroy.subcatagory', $subcategory->id)}}" class="btn btn-sm btn-danger text-white "><i class="fa fa-trash"></i></a>
                                <a href="{{route('edit.subcatagory', $subcategory->id)}}" class="btn btn-sm btn-info text-white"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-sm btn-success text-white"><i class="fa fa-eye"></i></a>
                            </td>
                            </tr>
                            
                            @endforeach
                            
                            @else
                            <tr>
                                <td colspan="6"><p class="bg-danger text-center"> No Data </p></td>
                            </tr>
                            @endif
                         
                        </tbody>
                      </table>
                    </div>
                  </div>
    </div>
</div>
@endsection