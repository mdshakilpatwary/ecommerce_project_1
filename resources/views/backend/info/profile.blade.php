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

<div class="section-body">
    <div class="row mt-sm-4">
      <div class="col-12 col-md-12 col-lg-4">
        <div class="card author-box">
          <div class="card-body">
            <div class="author-box-center">
          
              @if(Auth::user()->image)
              <img src="{{asset('uploads/user/'.Auth::user()->image) }}" alt="Admin" class="rounded-circle author-box-picture"></a>
             @else
              <img src="{{asset('uploads/user/avater.jpg')}}" alt="Admin" class="rounded-circle author-box-picture" >
             @endif 

              <div class="clearfix"></div>
              <div class="author-box-name">
                <a href="#">{{Auth::user()->username}}</a>
              </div>
              <div class="author-box-job">{{Auth::user()->role}}</div>
            </div>
            <div class="text-center">
              <div class="author-box-description">
                <p>
                  {{Auth::user()->description}}
                </p>
              </div>
              
              <div class="w-100 d-sm-none"></div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h4>Personal Details</h4>
          </div>
          <div class="card-body">
            <div class="py-4">
              <p class="clearfix">
                <span class="float-left">
                  Birthday
                </span>
                <span class="float-right text-muted">
                  {{Auth::user()->birth}}
                </span>
              </p>
              <p class="clearfix">
                <span class="float-left">
                  Phone
                </span>
                <span class="float-right text-muted">
                  {{Auth::user()->phone}}
                </span>
              </p>
              <p class="clearfix">
                <span class="float-left">
                  Mail
                </span>
                <span class="float-right text-muted">
                  {{Auth::user()->email}}
                </span>
              </p>
              <p class="clearfix">
                <span class="float-left">
                  Facebook
                </span>
                <span class="float-right text-muted">
                  <a href="#">John Deo</a>
                </span>
              </p>
              <p class="clearfix">
                <span class="float-left">
                  Twitter
                </span>
                <span class="float-right text-muted">
                  <a href="#">@johndeo</a>
                </span>
              </p>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h4>Skills</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
              <li class="media">
                <div class="media-body">
                  <div class="media-title">Java</div>
                </div>
                <div class="media-progressbar p-t-10">
                  <div class="progress" data-height="6" style="height: 6px;">
                    <div class="progress-bar bg-primary" data-width="70%" style="width: 70%;"></div>
                  </div>
                </div>
              </li>
              <li class="media">
                <div class="media-body">
                  <div class="media-title">Web Design</div>
                </div>
                <div class="media-progressbar p-t-10">
                  <div class="progress" data-height="6" style="height: 6px;">
                    <div class="progress-bar bg-warning" data-width="80%" style="width: 80%;"></div>
                  </div>
                </div>
              </li>
              <li class="media">
                <div class="media-body">
                  <div class="media-title">Photoshop</div>
                </div>
                <div class="media-progressbar p-t-10">
                  <div class="progress" data-height="6" style="height: 6px;">
                    <div class="progress-bar bg-green" data-width="48%" style="width: 48%;"></div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-12 col-lg-8">
        <div class="card">
          <div class="padding-20">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab" aria-selected="true">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab" aria-selected="false">Setting</a>
              </li>
            </ul>
            <div class="tab-content tab-bordered" id="myTab3Content">
              <div class="tab-pane fade active show" id="about" role="tabpanel" aria-labelledby="home-tab2">
                <div class="row">
                  <div class="col-md-3 col-6 b-r">
                    <strong>Full Name</strong>
                    <br>
                    <p class="text-muted">{{Auth::user()->name}}</p>
                  </div>
                  <div class="col-md-3 col-6 b-r">
                    <strong>Mobile</strong>
                    <br>
                    <p class="text-muted">{{Auth::user()->name}}</p>
                  </div>
                  <div class="col-md-3 col-6 b-r">
                    <strong>Email</strong>
                    <br>
                    <p class="text-muted">{{Auth::user()->name}}</p>
                  </div>
                  <div class="col-md-3 col-6">
                    <strong>Location</strong>
                    <br>
                    <p class="text-muted">{{Auth::user()->country}}</p>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                <form method="POST" action="{{route('admin.profile.update', Auth::user()->id)}}" class="needs-validation" enctype="multipart/form-data">
                  @csrf
                  <div class="card-header">
                    <h4>Edit Profile</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-6 col-12">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}">
                        <div class="invalid-feedback">
                          Please fill in the name
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>user Name</label>
                        <input type="text" disabled class="form-control" name="username" value="{{Auth::user()->username}}">
                        
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6 col-12">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}">
                        <div class="invalid-feedback">
                          Please fill in the email
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Phone</label>
                        <input type="tel" name="phone" class="form-control" value="{{Auth::user()->phone}}">
                        <div class="invalid-feedback">
                          Please fill in the phone
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Phone</label>
                        <input type="date" name="birth" class="form-control" value="{{Auth::user()->phone}}">
                        <div class="invalid-feedback">
                          Please fill in the phone
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="{{Auth::user()->address}}">
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Country</label>
                        <input type="text" name="country" class="form-control" value="{{Auth::user()->country}}">
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Facebook</label>
                        <input type="text" name="facebook" class="form-control" value="{{Auth::user()->facebook}}">
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" >
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-12 col-12">
                        <label>Short Description</label>
                        <textarea name="description" class="form-control" id="" cols="20" rows="10">{{Auth::user()->description}}</textarea>
                      </div>
                      
                    </div>

                  </div>
                  <div class="card-footer text-right">
                    <button class="btn btn-primary">Save Changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection