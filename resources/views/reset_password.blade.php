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
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-8 offset-md-3 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">

            <div class="card card-primary mt-5">
              <div class="card-header">
                <h4>Set new Password</h4>
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
                <form method="POST" action="{{ route('update.password.token',$user->remember_token) }}" class="needs-validation" novalidate="">
                  @csrf
                    <div class="form-group">
                    <label for="password">New Password</label>
                    <input id="password" type="password" class="form-control" name="password" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                        Please fill in your password
                        </div>
                        @error('password')
                        <p class="text-danger ">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input id="confirm_password" type="password" class="form-control" name="confirm_password" tabindex="2" required autofocus>
                    <div class="invalid-feedback">
                        Please fill in your Confirm Password
                        </div>
                        @error('confirm_password')
                        <p class="text-danger ">{{$message}}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block w-25" tabindex="4">
                      Change
                    </button>
                  </div>
                </form>
                
              </div>
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