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
                <h4>Reset email</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('reset.password.email') }}" class="needs-validation" novalidate="">
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

                    <button type="submit" class="btn btn-primary btn-lg btn-block w-25" tabindex="4">
                      Reset
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