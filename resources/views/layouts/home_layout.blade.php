<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <title>{{ config('app.name', 'Title') }}</title>
    <!-- main meta data -->
    @section('section_main_meta')
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <!-- Tell the browser to be responsive to screen width -->
        <!-- meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/ -->
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" id="meta-viewport"/>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @show
    <!-- ./main meta data -->
    <!-- meta data stack -->
    @stack('meta_stack')
    <!-- /.meta data stack -->
    <!-- style sheet -->
    @section('stylesheet_section')
        <!-- fonts -->
        <link rel="stylesheet" type="text/css" href="{!! asset('fonts/@fortawesome/fontawesome-free/css/all.min.css') !!}"/>
        <link rel="stylesheet" type="text/css" href="{!! asset('fonts/font-awesome/css/font-awesome.min.css') !!}"/>
    
        <link rel="stylesheet" type="text/css" href="{!! asset('css/app.css') !!}"/>
        <link rel="stylesheet" type="text/css" href="{!! asset('css/main.css') !!}"/>
        <link rel="stylesheet" type="text/css" href="{!! asset('css/calendar.css') !!}"/>
    @show
    <!-- /.style sheet -->
    <!-- script -->
    @section('script_section') 
        <script src="{!! asset('js/app.js') !!}"></script>
        <!-- <script src="{!! asset('js/calendar.js') !!}"></script> -->
        <script>
            window.my_app_url = my_app_url = "{{ config('app.url') }}";
            window.auth_user_object = new Object();
            @if( auth()->user() )
                window.auth_user_object = JSON.parse( '{!! auth()->user()->toJson() !!}' );
            @endif
        </script>
    @show
    <!-- /.script -->
    
    <!-- style sheet -->
    @section('optional_stylesheet_section')
    @show
    <!-- /.style sheet -->
    <!-- script -->
    @section('optional_script_section')
    @show
    <!-- /.script -->
    <!-- style stack -->
    @stack('style_stack')
    <!-- /.style stack -->
</head>
<body class="hold-transition sidebar-mini">
<!-- wrapper -->
<div class="wrapper">
    
<!-- Main Header -->
@section('main_header_section')
    @includeIf('partials.main_header', array())
@show
<!-- /.Main Header -->
    

    
<!-- column-break -->
<!-- div class="w-100 d-none d-md-block"></div -->
<!-- /.column-break --> 
 
<!-- section -->
<!-- <div class="row wrapper flex-fill p-0 m-0"> -->
    
    <!-- Left side column. contains the logo and sidebar -->
    @section('left_side_column_section')
        @includeIf('partials.left_side_column', array())
    @show
    <!-- /.Left side column. contains the logo and sidebar -->
    
    @section('content_wrapper_section')
    <!-- Right side column -->
    <!-- <div class="content-wrapper"> -->
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <!-- Main content -->
        <!-- -- <section class="content container-fluid" id="container_fluid"> -- -->

        <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <!-- flash-message -->
            @includeIf('partials.flash_message', array())
        <!-- /.flash-message -->
            
        <!-- row -->
        <!-- div class="row" -->
            <!-- col -->
            <!-- div class="col col-sm-12 p-0 m-0" -->
                
            @yield('yield_contant')
                
            <!-- /div -->
            <!-- /.col -->
        <!-- /div -->
        <!-- /.row -->
            
        <!--------------------------
        | Your Page Content Here |
        -------------------------->

        <!-- -- </section> -- -->
        <!-- /.Main content -->
        </div>
        <!-- /.Content Wrapper. Contains page content -->
        
    <!-- </div> -->
    <!-- /.Right side column -->
    @show
    
<!-- </div> -->
<!-- /.section -->
    
<!-- column-break -->
<!-- div class="w-100 d-none d-md-block"></div -->
<!-- /.column-break --> 

<!-- Main Footer -->
@section('main_footer_section')
    @includeIf('partials.main_footer', array())
@show
<!-- /.Main Footer -->
      
</div>
<!-- /.wrapper -->
<!-- document script --> 
@section('document_script_section')
    
@show
<!-- /.document script -->    
<!-- script stack -->
@stack('stack_script')
<!-- /.script stack -->  
</body>
</html>