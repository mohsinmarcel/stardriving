<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Log In | Star Driving School</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/Logo-02.png')}}">

        <!-- App css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
        <style>
            .custom-control-input:checked~.custom-control-label::before {
                color: #f14242;
                border-color: #f14242;
                background-color: #f14242;
            }
           body.authentication-bg {
                height: 100vh;
            }
                body.authentication-bg .account-pages {
                height: 100%;
                display: inline-flex;
                width: 100%;
                align-items: center;
                justify-content: center;
            }
            @media(max-width: 767px){
            body.authentication-bg .account-pages {
                height: auto;
                margin: 50px auto;
            }
                  body.authentication-bg {
                     height: auto;   
                  }
            }
        </style>
    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header pt-2 pb-2 text-center">
                                    <span><img src="assets/images/Logo-02.png" alt="" height="75"></span>
                            </div>

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Sign In</h4>
                                    @error('email')
                                    <p class="text-danger my-2">{{$message}}</p>
                                    @enderror
                                    
                                </div>
                                @if(Session::has('Success'))
                                    <p class="alert alert-success">{{ Session::get('Success') }}</p>
                                @endif
                                @if(Session::has('Error'))
                                    <p class="alert alert-danger">{{ Session::get('Error') }}</p>
                                @endif
                                <form action="{{route('login.post')}}" method="POST" novalidate="on">
                                    @csrf
                                    <div class="form-group">
                                        <label for="emailaddress">Email or Username</label>
                                        <input class="form-control" type="email" id="email" name="email" required="" placeholder="Enter your email">
                                    </div>

                                    <div class="form-group">
                                        {{-- <a href="pages-recoverpw.html" class="text-muted float-right"><small>Forgot your password?</small></a> --}}
                                        <label for="password">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-append" data-password="false">
                                                <div class="input-group-text">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group " style="float: right">
                                        <div class="custom-control custom-checkbox">
                                            <a href="{{route('login.forgetPassword')}}" >Forget Password?</a>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3" style="display: flow-root;">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signin" name="remember" checked>
                                            <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn" style="background-color: #f14242 !important;color:white" type="submit"> Log In </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        {{-- <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Don't have an account? <a href="pages-register.html" class="text-muted ml-1"><b>Sign Up</b></a></p>
                            </div> <!-- end col -->
                        </div> --}}
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            
        </footer>

        <!-- bundle -->
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>
