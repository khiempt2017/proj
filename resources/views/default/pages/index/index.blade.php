@extends('default.main')
@section('content')
    @include('default.block.slider') <!-- Chứa phần Slider -->    
       
    <div class="content_container">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="main_content">
                        <!-- Phần Featured -->
                        @include('default.pages.index.index-child.left-content.featured')
                        <!-- Category -->
                        @include('default.pages.index.index-child.left-content.category')
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="col-lg-3">
                    @include('default.pages.index.index-child.right-content.sidebar')
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="content_container">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="main_content">
                        <!-- Featured 2 -->
                        @include('default.pages.index.index-child.left-content.featured-2')
                        <!-- Category 2-->
                        @include('default.pages.index.index-child.left-content.category-2')
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="col-lg-3">
                    @include('default.pages.index.index-child.right-content.sidebar-2')   
                </div>
            </div>
        </div>
    </div> --}}
@endsection