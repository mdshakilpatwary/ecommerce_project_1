@extends('backend.master')

@section('maincontent')




<div class="row">
    <h2 class="">All Role wise user</h2>
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
                    <p class="float-left mb-4">
                      @if(Auth::user()->can('admin.create'))
                        <a class="btn btn-primary text-white" href="{{ route('user.create') }}">Create New User</a>
                      @endif
                    </p>
                    <div class="clearfix"></div>
                    <div class="table-responsive p-3" style="background: #fff; box-shadow: 0 0 8px #ddd">
                   
                        <table class="table table-striped dataTable no-footer" id="table-1" role="grid" aria-describedby="table-1_info">
                        <thead>
                          <tr role="row">
                            <th class="text-center sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 24.45px;" aria-label="
                              
                            : activate to sort column ascending">
                              #SL
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 149.1px;" aria-label="Task Name: activate to sort column ascending"> Name</th>
                          
                           <th class="sorting_desc" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 108.283px;" aria-label="Status: activate to sort column ascending" aria-sort="descending">Email</th>
                           <th class="sorting_desc" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 108.283px;" aria-label="Status: activate to sort column ascending" aria-sort="descending">Role</th>
                           <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1" colspan="1" style="width: 73.1167px;" aria-label="Action: activate to sort column ascending">Action</th></tr>
                        </thead>
                        <tbody>
                            
                          
                            @if(count($users) > 0)
                            @php
                          $sl = 1;
                          @endphp
                          @foreach($users as $user)
                          @if($user->role != 'User')
                          <tr role="row" class="even">
                            <td class="">
                              {{$sl++}}
                            </td>

                            <td>
                                {{$user->name}}
                            </td>
                            <td >
                              {{$user->email}}
                            </td>
                            <td>
                              @foreach($user->roles as $role)
                              <span class="badge badge-light" style="text-transform: capitalize">{{$role->name}}</span>
                              @endforeach
                            </td>
                           
                            <td>
                              @if(Auth::user()->can('admin.edit')||Auth::user()->can('admin.delete'))
                                @if(Auth::user()->can('admin.delete'))
                                <a href="{{route('user.delete', $user->id)}}" class="btn btn-sm btn-danger text-white "><i class="fa fa-trash"></i></a>
                                @endif
                                @if(Auth::user()->can('admin.edit'))
                                <a href="{{route('user.edit', $user->id)}}" class="btn btn-sm btn-info text-white"><i class="fa fa-edit"></i></a>
                                @endif
                              @else
                              <span class="badge badge-light">No Action</span>
                              @endif
                            </td>
                          </tr>
                          @endif
                            
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