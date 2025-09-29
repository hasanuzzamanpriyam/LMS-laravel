<!doctype html>
<html lang="en">

<head>
    @include('backend.section.link')
    <title>LMS Admin Dashboard</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('backend.section.sidebar')
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('backend.section.header')
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            @yield('content')
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        @include('backend.section.footer')
    <!--end wrapper-->


    @include('backend.section.script')
</body>

</html>
