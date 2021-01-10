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
                                        <button class="btn btn-outline-info btn-sm two-btn btn-view" data-object="{{ $user->toJson() }}" data-toggle="modal" data-target="#view_modal"><b>View</b></button> 
                                        <!-- <button class="btn btn-outline-warning btn-sm three-btn btn-edit" data-object="{{ $user->toJson() }}" data-toggle="modal" data-target="#edit_modal"><b>Edit</b></button> -->
                                        <button class="btn btn-outline-danger btn-sm two-btn btn-delete" data-url="{{ route('user.destroy', [$user->id])}}" data-toggle="modal" data-target="#delete_modal"><b>Delete</b></button>
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


<!-- view modal  -->
<div class="modal fade" id="view_modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col">
                    <div class="card card-info mt-3">
                        <div class="card-header">
                            <h3 class="card-title">View User Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Name</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="name_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">User Role</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="user_role_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Username</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="username_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Email</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="email_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Phone Number</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="phone_view"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal body  -->
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /.view modal  -->

<!-- delete modal  -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-danger font-weight-bold">Deleting the user...!</h3>
            </div>
            <div class="modal-body">
                <p>If you continue, you will delete this user from the system. Are you sure to delete?</p>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="col-md-5 mt-3">
                            <button class="btn btn-danger rounded two-btn" id="delete_button">Delete</button>
                            <button type="button" class="btn btn-warning rounded two-btn" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.delete modal  -->

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

        $('.btn-view').on('click', function(event){
            event.preventDefault();
            var buttonObject = $( this );
            buttonObject.attr('disabled', true);
            var jsonObject = buttonObject.data('object');
            var modalObject = $('#view_modal');

            var name = $('#name_view');
            var user_role = $('#user_role_view');
            var username = $('#username_view');
            var email = $('#email_view');
            var phone = $('#phone_view');

            var name_value = jsonObject.name;
            var user_role_value = jsonObject.user_role.name;
            var username_value = jsonObject.username;
            var email_value = jsonObject.email;
            var phone_value = jsonObject.phone? jsonObject.phone : '' ;
            
            name.text(name_value);
            user_role.text(user_role_value);
            username.text(username_value);
            email.text(email_value);
            phone.text(phone_value);

            modalObject.modal().show();
            buttonObject.attr('disabled', false);
        });

        $('.btn-delete').on('click', function(event){
            var buttonObject = $( this);
            var url = buttonObject.data('url');
            console.log(url);
            $('#delete_modal').modal().show();
            $('#delete_button').on('click', function(){
                window.location.replace( url );
            });
        });
    });
</script>

@endpush