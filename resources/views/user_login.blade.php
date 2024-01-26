<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>User Login</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('backend')}}/assets/css/app.min.css">
  <link rel="stylesheet" href="{{asset('backend')}}/assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('backend')}}/assets/css/style.css">
  <link rel="stylesheet" href="{{asset('backend')}}/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{asset('backend')}}/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.icon' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>

              </div>
              <!-- success or error msg part html start -->
              @if(session('success'))
              <div class="alert alert-success alertsuccess mx-3">
                  {{ session('success') }}
              </div>
              @endif

              @if(session('error'))
                  <div class="alert alert-danger alerterror mx-3">
                      {{ session('error') }}
                  </div>
              @endif
            <!-- success or error msg part html end-->
              <div class="card-body">
                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                  @csrf
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                    @error('email')
                    <p class="text-danger ">{{$message}}</p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="{{Route('forget.password')}}" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                    @error('password')
                    <p class="text-danger ">{{$message}}</p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me" required>
                      <label class="custom-control-label" for="remember-me" >Remember Me</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
                <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">Login With Social</div>
                </div>
                <div class="row sm-gutters">
                  <div class="offset-3 col-6">
                    <a href="{{route('socialite.create')}}" class="btn btn-block btn-social btn-facebook">
                      <span class="fab fa-google"></span> Google
                    </a>
                  </div>
                  {{-- <div class="col-6">
                    <a class="btn btn-block btn-social btn-twitter">
                      <span class="fab fa-twitter"></span> Twitter
                    </a>
                  </div> --}}
                </div>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="{{route('register')}}">Create One</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="{{asset('backend')}}/assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="{{asset('backend')}}/assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="{{asset('backend')}}/assets/js/custom.js"></script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>