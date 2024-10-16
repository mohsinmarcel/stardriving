<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Star Driving School</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/Logo-02.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.styles')

</head>

{{-- <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'> --}}

<body class="loading">
    @include('partials.changepassword')
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <!-- LOGO -->
            <a href="/" class="logo text-center logo-light">
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/Logo-02.png') }}" alt="" height="65">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('assets/images/Logo-02.png') }}" alt="" height="16">
                </span>
            </a>

            <!-- LOGO -->
            <a href="index.html" class="logo text-center logo-dark">
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="16">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('assets/images/logo_sm_dark.png') }}" alt="" height="16">
                </span>
            </a>

            <div class="h-100" id="left-side-menu-container" data-simplebar>

                <!--- Sidemenu -->
                @include('partials.navbar')
                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                @include('partials.topbar')
                <!-- end Topbar -->

                <!-- Start Content-->
                <div class="container-fluid vertical-scrollable">
                    @yield('content')
                </div>
                <!-- container -->

            </div>
            <!-- content -->

            <!-- Footer Start -->
            @include('partials.footer')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->
    @include('partials.scripts')
    <script>
        //CHANGE pASSWORD modal Open
        $('#btnShowCP').click(function() {
            $('#newpassword_confirmation').val('');
            $('#newpassword').val('');
            $('#oldpassword').val('');
            $('#changePasswordModal #modelError').css('display', 'none');
            $('#changePasswordModal').modal('show');
        })
        $('#changePassword').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('admin.change.password') }}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'JSON',
                beforeSend: function() {

                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        if (data.status) {
                            $('#changePasswordModal').modal('hide');
                            $.NotificationApp.send("Message!", "Profile changed successfully.",
                                "top-right", "rgba(0,0,0,0.2)", "success")
                        }
                    } else {
                        printErrorMsg(data.error, "#changePasswordModal #modelError");
                    }
                },
                error: function(jhxr, status, err) {
                    console.log(jhxr);
                },
                complete: function() {}
            });
        })
    </script>
</body>

</html>
