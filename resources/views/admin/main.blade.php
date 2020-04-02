<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Phần chứa các đường dẫn css-->
    @include('admin.elements.head')
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <!-- Phần chứa các Menu bên trái -->
            @include('admin.elements.left-menu')
        </div>
        <!-- Phần chứa các template cố định top navigation -->
        <div class="top_nav">
            @include('admin.elements.top-nav')
        </div>
        
        @yield('content')
        
        <footer>
            @include('admin.elements.footer')
        </footer>
        <!-- /footer -->
    </div>
</div>
@include('admin.elements.script')
</body>
</html>