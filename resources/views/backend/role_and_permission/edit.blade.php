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
<div class="col-md-12 pb-5">    
  <h2>Add Role Permision Edit </h2>
</div>
    <div class="col-md-6 offset-md-3  rounded py-3" style="background: #fff; box-shadow: 0 0 8px #ddd">        
        <form action="{{route('role.permission.update', $role->id)}}" method="POST" >
            @csrf
            <div class="form-group ">
                <label for="name">Role Name</label>
                <input type="text" class="form-control" name="name" value="{{$role->name}}" placeholder="Enter role name">


              @error('name') 
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="permissions">Permissions</label>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1" {{ App\Models\User::roleHasPermissions($role, $all_permissions) ? 'checked' : '' }}>
                    <label class="form-check-label" for="checkPermissionAll">All</label>
                 @error('permissions') 
                    <p class="text-danger ">{{$message}}</p>
                @enderror
                </div>
                <hr>
                @php $i = 1; @endphp
                @foreach ($permission_groups as $group)
                    <div class="row">
                        @php
                            $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                            $j = 1;
                        @endphp
                        
                        <div class="col-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $i }}Management">{{ $group->name }}</label>
                            </div>
                        </div>

                        <div class="col-9 role-{{ $i }}-management-checkbox">
                           
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})" name="permissions[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                    <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                                @php  $j++; @endphp
                            @endforeach
                            <br>
                        </div>

                    </div>
                    @php  $i++; @endphp
                @endforeach
            </div>

            
            <button class="btn btn-lg btn-success">Submit</button>
        </form>
    </div>
    
</div>

@endsection