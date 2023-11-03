@extends('backend.master')

@section('maincontent')
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
  <div class="container alerterror">
  <div class="alert alert-danger alert-dismissible show fade ">
                        <div class="alert-body">
                          <button class="close" data-dismiss="alert">
                            <span>×</span>
                          </button>
                          {{ session('error')}}
                        </div>
   </div>
  </div>
  
  @endif

<div class="section-body">
    <div class="row mt-sm-4">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card author-box">
          <div class="card-body">
            <div class="author-box-center">
                <h4 >Change your Password</h4>


                <div class="row">
                    <div class="col-md-4 offset-md-4">

                        <form action="{{route('admin.password.update', Auth::user()->id)}}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="oldPass">Old Password</label>
                                <input type="password" name="oldPass" id="" class="form-control" placeholder="Enter Your Old Password">
                                @error('oldPass')
                                <p class="text-danger">{{ $message}}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="newPass">New Password</label>
                                <input type="password" name="newPass" id="" class="form-control" placeholder="Enter Your New Password">
                                @error('newPass')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="conPass">Confirm Password</label>
                                <input type="password" name="conPass" id="" class="form-control" placeholder="Enter Your Confirm Password">
                                @error('conPass')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-info btn-lg" name="">Change Password</button>
                            </div>
                           
                        </form>
                    </div>
                </div>
          
              
              <div class="w-100 d-sm-none"></div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
  @endsection