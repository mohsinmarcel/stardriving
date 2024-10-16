<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Change Password | Star Driving School</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="/assets/images/Logo-02.png">

        <!-- App css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
        <style>
            .custom-control-input:checked~.custom-control-label::before {
                color: #f14242;
                border-color: #f14242;
                background-color: #f14242;
            }
        </style>
    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages mt-5 mb-5">
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
                                    <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Forget Password</h4>
                                    @error('email')
                                        <p class="text-danger my-2">{{$message}}</p>
                                    @enderror
                                    
                                </div>

                                <form action="{{route('login.changePassword.post', $token)}}" method="POST" novalidate="on">
                                    @csrf
                                    <div class="form-group">
                                        <label for="newPassword">New Password</label>
                                        <input class="form-control" type="password" id="newPassword" name="newPassword" placeholder="Enter your new password">
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="confirmPassword">Confirm Password</label>
                                        <input class="form-control" type="password" id="confirmPassword" name="confirmPassword" placeholder="Enter your new password">
                                    </div> --}}

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
        <script src="/assets/js/vendor.min.js"></script>
        <script src="/assets/js/app.min.js"></script>
        
    </body>
</html>