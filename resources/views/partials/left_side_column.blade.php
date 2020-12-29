<!-- Left side column. contains the logo and sidebar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4">
    <!-- Brand Logo -->
    <!--
    <a href="javascript:void(0)" class="brand-link">
        <img src="javascript:void(0)"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Home</span>
    </a>
    -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">            
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                
                <!-- li -->
                <li class="nav-header w-100 p-3">
                    <img src="/img/Ransavi-Construction-Logo.png" alt="logo" class="img-responsive">
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <p>
                            &nbsp;
                            Sites Details
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('site.create') }}" class="nav-link text-white">                                
                                <p>&nbsp; New Site</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('site.index') }}" class="nav-link">                                
                                <p>&nbsp; All Sites</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">                                
                                <p>&nbsp; Active Sites</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                        <p>
                            &nbsp;
                            Items Details
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('items.create') }}" class="nav-link">                                
                                <p>&nbsp; New Item</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('items.index') }}" class="nav-link">                                
                                <p>&nbsp; All Items</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="fa fa-money" aria-hidden="true"></i>
                        <p>
                            &nbsp;
                            Material Requests
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('material_request_note.create') }}" class="nav-link">                                
                                <p>&nbsp; New Request</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('material_request_note.index') }}" class="nav-link">                                
                                <p>&nbsp; All Material Requests</p>
                            </a>
                        </li>
                    </ul>         
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">                                
                                <p>&nbsp; Send Purchasing Orders</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">                                
                                <p>&nbsp; Good Receive Notes</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="fa fa-file-text" aria-hidden="true"></i>
                        <p>
                            &nbsp;
                            Report Generation
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">                                
                                <p>&nbsp; Report 1</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">                                
                                <p>&nbsp; Report 2</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="fa fa-user" aria-hidden="true"></i>
                        <p>
                            &nbsp;
                            Administraton
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.create') }}" class="nav-link">                                
                                <p>&nbsp; New User</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link">                                
                                <p>&nbsp; All Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- /.li -->
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- /.Main Sidebar Container -->

<!-- /.Left side column. contains the logo and sidebar -->