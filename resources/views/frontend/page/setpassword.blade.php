
@extends('frontend.master')

@section('mainbody')

		<!-- BREADCRUMB -->
		<div class="section">
			<!-- container -->
			<div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 m-auto">
                        <div class="row">
                            <div class="heading_s1">
                                <h2 class="mb-15 mt-15">Set new password</h2>
                                <p class="mb-30">Please create a new password that you don\'t use on any other site.</p>
                            </div>
                            <div class="offset-md-3 col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <form method="POST" action="{{route('socialite.setpass', $sid)}}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="password" name="password" placeholder="Enter your new Password *">
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="password"  name="cpassword" placeholder="Confirm you password *">
                                            @error('cpassword')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-heading btn-block hover-up" name="setpass">Set password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
				
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

@endsection