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
                                <th style="width: 20%">User Role</th>
                                <th style="width: 20%">Username</th>
                                <th class="no-sort" style="width: 20%">Phone Number</th>
                                <th class="no-sort" style="width: 15%; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="hospital_list">
                            @php
                                $is_disabled = null;
                                $role_ids = array(2, 3, 4, 5);
                                if( ( auth()->user() ) && ( in_array(auth()->user()->user_role_id, $role_ids) ) ){
                                    $is_disabled = "disabled=true";
                                }
                            @endphp
                            @isset($users)
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->userRole->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <button style="width: 31%; padding : 0; margin : 0;" class="btn btn-info btn-sm" id="view" onclick="view_user_details( {{ $user->id }} )">View</button> 
                                        <button style="width: 31%; padding : 0; margin : 0;" class="btn btn-warning btn-sm" id="edit"  onclick="edit_user_details( {{ $user->id }} )" {{ $is_disabled }}>Edit</button>
                                        <button style="width: 31%; padding : 0; margin : 0;" class="btn btn-danger btn-sm" id="delete" onclick="delete_user_details( {{ $user->id }} )" {{ $is_disabled }}>Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            @endisset
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 5%" >ID</th>
                                <th style="width: 20%">Name</th>
                                <th style="width: 20%">User Role</th>
                                <th style="width: 20%">Username</th>
                                <th style="width: 20%">Phone Number</th>
                                <th class="no-sort" style="width: 15%; text-align: center;">Action</th>
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
<!-- /div -->
<!-- /.Content Wrapper -->
<!-- page script -->


<!-- Delete Modal -->
<!-- Modal -->
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog modalCenter">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-danger">
                Delete User Details
            </div>
            <div class="modal-body">
                <p class="modal_body">Are you sure to delete this user? </p>
                <br><br>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <button style="width: 45%" class="btn btn-danger rounded" id="deleteButton" data-url="{{ route('delete_user', ['id']) }}" >Delete</button>
                        <button style="width: 45%" type="button" class="btn  btn-warning rounded" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>
        
<!-- /.Delete Modal -->



<!-- View Modal -->
<!-- Modal -->
<div id="viewModal" class="modal fade" role="dialog">
    <div class="modal-dialog modalCenter modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <br>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">View User Details</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-hover">
                            <tr class="p-2">
                                <td style="width: 30%">Full Name</td>
                                <td style="width: 70%"><label id="v_user_id"></label></td>
                            </tr>
                            <tr>
                                <td style="width: 30%">User Role</td>
                                <td style="width: 70%"><label id="v_user_role"></label></td>
                            </tr>
                            <tr>
                                <td style="width: 30%">Username</td>
                                <td style="width: 70%"><label id="v_username"></label></td>
                            </tr>
                            <tr>
                                <td style="width: 30%">Phone</td>
                                <td style="width: 70%"><label id="v_phone"></label></td>
                            </tr>
                            
                        </table>
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info m-auto" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- /.View Modal -->

<!-- Edit Modal -->
<!-- Modal -->
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog modalCenter modal-xl">

        <!-- Modal content-->
        <div class="modal-content">
            <br>
            <div class="modal-body">
                <form id="edit_form" class="form-horizontal" action="{{ route('update_user', ['id']) }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Edit User Details</h3>
                        </div>
                        <!-- card-body -->                    
                        <div class="card-body">
                            <!-- FUll Name -->
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label class="col-md-3 col-form-label">
                                    Full Name
                                    @if( $errors->has('name') )
                                        <span style="color:red;">*</span>
                                    @endif
                                </label>
                                <div class="col-sm-8">
                                    <input class="col-md-10" type="text" name="e_name" id="e_name" placeholder="Ful Name" value="{{ old('') }}">
                                </div>
                            </div> 
                            <!-- Select USer Role From -->
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label class="col-md-3 col-form-label">
                                    User Role
                                    @if( $errors->has('user_role_id') )
                                        <span style="color:red;">*</span>
                                    @endif
                                </label>
                                <div class="col-md-8">
                                    <select class="col-md-10" id="e_user_role" name="e_user_role" >
                                        <option value="">Select...</option> 
                                        @isset( $user_roles )
                                            @foreach($user_roles as $user_role)
                                                <option value="{{ $user_role->id }}"> {{$user_role->name}} </option> 
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>    
                            <!-- Username -->
                            <div class="form-group row"> 
                                <div class="col-md-1"></div>
                                <label class="col-md-3 col-form-label">
                                    Username
                                    @if( $errors->has('username') )
                                        <span style="color:red;">*</span>
                                    @endif
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="col-md-10" name="e_username" id="e_username" placeholder="Username">
                                </div>
                            </div>
                            <!-- Phone Number -->
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label class="col-md-3 col-form-label">
                                    Phone Number
                                    @if( $errors->has('phone') )
                                        <span style="color:red;">*</span>
                                    @endif
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="col-md-10" name="e_phone" id="e_phone" placeholder="Phone Number">
                                </div>
                            </div>  
                            
                            <!-- Footer Buttons -->
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <button style="width: 45%" type="submit" class="btn btn-info rounded" id="editButton" >Update</button>
                                    <button style="width: 45%" type="button" class="btn  btn-default rounded" data-dismiss="modal">Close</button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>            
        </div>
    </div>
</div>

<!-- /.content -->
<!-- -- /div -- -->
<!-- /.Content Wrapper -->
@endsection