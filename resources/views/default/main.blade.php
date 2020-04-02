@php
    use App\Functions\Functions as Functions;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Trang chủ tin tức | Phan Thiện Khiêm</title>
    @include('default.elements.head')
</head>
<body>
<div class="super_container">
    <!-- Header -->
    @include('default.block.header') <!-- Chứa phần Header có các menu trên Top -->
    <!-- Menu -->
    @include('default.block.menu_top_after_scroll') <!-- Chứa phần menu top sau khi scroll chuột xuống -->
    
    <!-- Content Container -->
    @yield('content')
    <!-- Footer -->
    <footer class="footer">
        @include('default.block.footer')  
    </footer>
</div>
@include('default.elements.script') 
</body>
</html>