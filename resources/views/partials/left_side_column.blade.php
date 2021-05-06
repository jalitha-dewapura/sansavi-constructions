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
                <!-- Super Admin -->
                @if(auth()->user()->user_role_id == 1)
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
                            <a href="{{ route('material_request_note.index_sk') }}" class="nav-link">                                
                                <p>&nbsp; All Material Requests SK</p>
                            </a>
                        </li>
                    </ul>         
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('material_request_note.index_qs') }}" class="nav-link">                                
                                <p>&nbsp; All Material Requests QS</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('material_request_note.index_pm') }}" class="nav-link">                                
                                <p>&nbsp; All Material Requests PM</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('material_request_note.index_po') }}" class="nav-link">                                
                                <p>&nbsp; All Material Requests PO</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('material_request_note.index_hr') }}" class="nav-link">                                
                                <p>&nbsp; All Material Requests HR</p>
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
                            <a href="{{ route('report_site_annual_cost.index') }}" class="nav-link">                                
                                <p>&nbsp; Annual Report for Site</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('report_annual_cost.index') }}" class="nav-link">                                
                                <p>&nbsp; Annual Report for Company</p>
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
                @endif
                <!-- /.Super Admin -->
                <!-- Purchasing Officer -->
                @if(auth()->user()->user_role_id == 2)
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
                            <a href="{{ route('site.index') }}" class="nav-link">                                
                                <p>&nbsp; All Sites</p>
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
                            <a href="{{ route('material_request_note.index_po') }}" class="nav-link">                                
                                <p>&nbsp; All Material Requests</p>
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
                            <a href="{{ route('report_site_annual_cost.index') }}" class="nav-link">                                
                                <p>&nbsp; Annual Report for Site</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('report_annual_cost.index') }}" class="nav-link">                                
                                <p>&nbsp; Annual Report for Company</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- /.li -->
                @endif
                <!-- /.Purchasing Officer -->
                <!-- Project Manager -->
                @if(auth()->user()->user_role_id == 3)
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
                            <a href="{{ route('site.index') }}" class="nav-link">                                
                                <p>&nbsp; All Sites</p>
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
                            <a href="{{ route('material_request_note.index_pm') }}" class="nav-link">                                
                                <p>&nbsp; All Material Requests</p>
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
                            <a href="{{ route('report_site_annual_cost.index') }}" class="nav-link">                                
                                <p>&nbsp; Annual Report for Site</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('report_annual_cost.index') }}" class="nav-link">                                
                                <p>&nbsp; Annual Report for Company</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                <!-- /.Project Manager -->
                <!-- Quantity Surveyor -->
                @if(auth()->user()->user_role_id == 4)
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
                            <a href="{{ route('site.index') }}" class="nav-link">                                
                                <p>&nbsp; All Sites</p>
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
                            <a href="{{ route('material_request_note.index_qs') }}" class="nav-link">                                
                                <p>&nbsp; All Material Requests</p>
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
                            <a href="{{ route('report_site_annual_cost.index') }}" class="nav-link">                                
                                <p>&nbsp; Annual Report for Site</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('report_annual_cost.index') }}" class="nav-link">                                
                                <p>&nbsp; Annual Report for Company</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- /.li -->
                @endif
                <!-- /.Quantity Surveyor -->
                <!-- Stock Keeper -->
                @if(auth()->user()->user_role_id == 5)
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
                            <a href="{{ route('site.index') }}" class="nav-link">                                
                                <p>&nbsp; All Sites</p>
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
                            <a href="{{ route('material_request_note.index_sk') }}" class="nav-link">                                
                                <p>&nbsp; All Material Requests</p>
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
                            <a href="{{ route('report_site_annual_cost.index') }}" class="nav-link">                                
                                <p>&nbsp; Annual Report for Site</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('report_annual_cost.index') }}" class="nav-link">                                
                                <p>&nbsp; Annual Report for Company</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- /.li -->
                @endif
                <!-- /.Stock Keeper -->
                <!-- HR Officer -->
                @if(auth()->user()->user_role_id == 6)
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
                            <a href="{{ route('material_request_note.index_hr') }}" class="nav-link">                                
                                <p>&nbsp; All Material Requests</p>
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
                            <a href="{{ route('report_site_annual_cost.index') }}" class="nav-link">                                
                                <p>&nbsp; Annual Report for Site</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('report_annual_cost.index') }}" class="nav-link">                                
                                <p>&nbsp; Annual Report for Company</p>
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
                @endif
                <!-- /.HR Officer -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- /.Main Sidebar Container -->

<!-- /.Left side column. contains the logo and sidebar -->