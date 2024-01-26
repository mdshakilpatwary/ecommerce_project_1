<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>User registration</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('backend')}}/assets/css/app.min.css">
  <link rel="stylesheet" href="{{asset('backend')}}/assets/bundles/jquery-selectric/selectric.css">
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
          <div class="col-12 col-sm-10 offset-sm-1 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Register</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('register')}}">
                    @csrf
                  <div class="row">
                    <div class="form-group col-12">
                      <label for="name">Name</label>
                      <input id="name" type="text" class="form-control" name="name" name="{{old('name')}}" autofocus>
                      @error('name') 
                      <p class="text-danger ">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{old('email')}}">
                    @error('email') 
                    <p class="text-danger ">{{$message}}</p>
                    @enderror
                  </div>
                  <div class="row">
                    <div class="form-group col-12">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                        name="password">
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                      @error('password') 
                      <p class="text-danger ">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                      <label for="password_confirm" class="d-block">Password Confirmation</label>
                      <input id="password_confirm" type="password" class="form-control" name="password_confirm">
                      @error('password_confirm') 
                      <p class="text-danger">{{$message}}</p>
                    @enderror
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
              <div class="mb-4 text-muted text-center">
                Already Registered? <a href="{{route('login')}}">Login</a>
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
  <script src="{{asset('backend')}}/assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="{{asset('backend')}}/assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('backend')}}/assets/js/page/auth-register.js"></script>
  <!-- Template JS File -->
  <script src="{{asset('backend')}}/assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="{{asset('backend')}}/assets/js/custom.js"></script>
</body>

</html>