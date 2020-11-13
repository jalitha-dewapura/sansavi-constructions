@extends('layouts.home_layout')

@section('yield_contant')
<!-- Content Wrapper -->
<!-- -- div class="content-wrapper" -- -->


<!-- Main content -->
<section class="content">
<div>
    <br>
    <h2 class="ml-5">View / Edit / Delete All Users</h2>
    <hr>
    <br>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">User Details</h3>
                </div>
                <!-- /.card-header -->
                <!-- /.card-body -->
                <div class="card-body">
                    
                    <table id="table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%" >ID</th>
                                <th style="width: 20%">Name</th>
                                <th style="width: 17.5%">User Role</th>
                                <th style="width: 20%">Username</th>
                                <th class="no-sort" style="width: 17.5%">Phone Number</th>
                                <th class="no-sort" style="width: 20%; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="user_list">
                            <!-- @php
                                $is_disabled = null;
                                $role_ids = array(2, 3, 4, 5);
                                if( ( auth()->user() ) && ( in_array(auth()->user()->user_role_id, $role_ids) ) ){
                                    $is_disabled = "disabled=true";
                                }
                            @endphp -->
                            @isset($users)
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->userRole->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td class="d-flex justify-content-around">
                                        <button class="btn btn-outline-info btn-sm three-btn" id="view" onclick="view_user_details( {{ $user->id }} )"><b>View</b></button> 
                                        <button class="btn btn-outline-warning btn-sm three-btn" id="edit"  onclick="edit_user_details( {{ $user->id }} )" {{ $is_disabled }}><b>Edit</b></button>
                                        <button class="btn btn-outline-danger btn-sm three-btn" id="delete" onclick="delete_user_details( {{ $user->id }} )" {{ $is_disabled }}><b>Delete</b></button>
                                    </td>
                                </tr>
                                @endforeach
                            @endisset
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 5%" >ID</th>
                                <th style="width: 20%">Name</th>
                                <th style="width: 17.5%">User Role</th>
                                <th style="width: 20%">Username</th>
                                <th style="width: 17.5%">Phone Number</th>
                                <th class="no-sort" style="width: 20%; text-align: center;">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
                  

</section>

<!-- /.content -->
<!-- -- /div -- -->
<!-- /.Content Wrapper -->
@endsection


@push('stack_script')

<script>
    $(function () {
        $('#table').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }]
        });
    });
</script>

@endpush