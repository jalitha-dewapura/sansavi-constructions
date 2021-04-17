<!-- Main Header -->
<!-- nav-bar -->
<!-- header -->
    
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <!-- /.SEARCH FORM -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <!-- /.Messages Dropdown Menu -->
        
        <!-- Notifications Dropdown Menu -->
        <!-- /.Notifications Dropdown Menu -->
        
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <!-- img src="{!! asset('img/avatar5.png') !!}" class="user-image img-circle elevation-2" alt="User Image" -->
                @if( auth()->check() )
                    <span class="d-none d-md-inline text-dark">{{ auth()->user()->name }}</span>
                @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary d-none">
                    <!-- img src="{!! asset('img/avatar5.png') !!}" class="img-circle elevation-2" alt="User Image" -->
                    @if( auth()->check() )
                        <p>
                        {{ auth()->user()->name }}
                        <!-- small> - </small -->
                        </p>
                    @endif
                </li>
                <!-- Menu Body -->
                <!--
                <li class="user-body">
                    <div class="row">
                        <div class="col-4 text-center">
                            <a href="#">Link</a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="#">Link</a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="#">Link</a>
                        </div>
                    </div>
                </li>
                -->
                <!-- Menu Footer-->
                <li class="user-footer">
                    <!-- a href="#" class="btn btn-default btn-flat">Profile</a -->
                    <a href="{{ route('login.logout') }}" class="btn btn-default btn-flat float-right btn-block">Sign out</a>
                </li>
            </ul>
        </li>
        <!--
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
        -->
    </ul>
</nav>
<!-- /.Navbar -->
    
<!-- /header -->
<!-- /.nav-bar -->
<!-- /.Main Header -->