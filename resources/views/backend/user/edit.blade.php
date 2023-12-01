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
        <form action="{{route('user.update', $user->id)}}" method="POST" >
            @csrf
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6 col-12 col-sm-12">
                    <div class="form-group ">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$user->name}}" id="name" placeholder="Enter name">
                      @error('name') 
                            <p class="text-danger ">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6 col-12 col-sm-12">
                    <div class="form-group ">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}" placeholder="Enter email">
                      @error('email') 
                            <p class="text-danger ">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6 col-12 col-sm-12">
                    <div class="form-group ">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" value="" placeholder="Enter password">
                        @error('password') 
                            <p class="text-danger ">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6 col-12 col-sm-12">
                    <div class="form-group ">
                        <label for="con_password">Confirm Password</label>
                        <input type="password" class="form-control" name="con_password" id="con_password" value="{{old('con_password')}}" placeholder="Enter confirm password">
                    @error('con_password') 
                        <p class="text-danger ">{{$message}}</p>
                    @enderror
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6 col-12 col-sm-12">
                    <div class="form-group ">
                        <label for="role">Add Role</label>
                        <select name="role" id="role" class="form-control select-form" style="text-transform: capitalize;">
                            <option value="" class="disable selected">---Select Role---</option>
                            @foreach($roles as $role)
                            <option value="{{$role->name}}"  {{$user->hasRole($role->name) ? 'selected': ''}}>{{$role->name}}</option>
          
                            @endforeach
                          </select>                            
                        </select>
                      @error('role') 
                            <p class="text-danger ">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                
                
            </div>

            
            <button class="btn btn-lg btn-success">Update</button>
        </form>
    </div>
    
</div>

@endsection