@extends('backend.master')

@section('maincontent')




<div class="row">
    <h2>All Category Hare</h2>
    <div class="col-md-10 offset-md-1">
    <div class="card-body">
                    <div class="table-responsive">
                   
                        <table class="table table-striped dataTable no-footer" id="table-1" role="grid" aria-describedby="table-1_info">
                        <thead>
                          <tr role="row">
                            <th class="text-center sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 24.45px;" aria-label="
                              
                            : activate to sort column ascending">
                              #SL
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">Category Name</th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending">Image</th>
                           
                           <th class="sorting_desc" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 108.283px;" aria-label="Status: activate to sort column ascending" aria-sort="descending">Status</th><th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 73.1167px;" aria-label="Action: activate to sort column ascending">Action</th></tr>
                        </thead>
                        <tbody>
                            
                          
                        
                            @if(count($cat_data) > 0)
                            
                            @foreach($cat_data as $category)
                            <tr role="row" class="even">
                            <td class="">
                              {{ $category->id }}
                            </td>
                            <td>{{$category->cat_name}}</td>
                            <td><img src="{{asset('uploads/category/'.$category->cat_image)}}" alt="" width="50" height="50" ></td>
                           
                            
                            
                            <td class="sorting_1">
                              <div class="badge badge-success badge-shadow">{{($category->cat_status == '1')? 'active' : 'inactive';}}</div>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                <a href="#" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
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