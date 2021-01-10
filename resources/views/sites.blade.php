@extends('layouts.home_layout')

@section('yield_contant')
<!-- Content Wrapper -->
<!-- -- div class="content-wrapper" -- -->


<!-- Main content -->
<section class="content">
<div>
    <br>
    <h2 class="ml-5">View / Edit / Delete All Sites</h2>
    <hr>
    <br>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">Site Details</h3>
                </div>
                <!-- /.card-header -->
                <!-- /.card-body -->
                <div class="card-body">
                    
                    <table id="table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%" >ID</th>
                                <th style="width: 15%">Name</th>
                                <th style="width: 15%">District</th>
                                <th style="width: 10%"class="no-sort" >Status</th>
                                <th style="width: 17.5%">Purchasing Officer</th>
                                <th style="width: 17.5%">Project Manager</th>
                                <th style="width: 20%; text-align: center;" class="no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody id="site_list">
                            <!-- @php
                                $is_disabled = null;
                                $role_ids = array(2, 3, 4, 5);
                                if( ( auth()->user() ) && ( in_array(auth()->user()->user_role_id, $role_ids) ) ){
                                    $is_disabled = "disabled=true";
                                }
                            @endphp -->
                            @isset($sites)
                                @foreach($sites as $site)
                                <tr>
                                    <td>{{ $site->id }}</td>
                                    <td>{{ $site->name }}</td>
                                    <td>{{ $site->district->name }}</td>
                                    <td>{{ $site->is_active == true ? "Active" : "Suspended" }}</td>
                                    <td>{{ $site->purchasingOfficer->name?? '' }}</td>
                                    <td>{{ $site->projectManager->name?? '' }}</td>
                                    <td class="d-flex justify-content-around">
                                        <button class="btn btn-outline-info btn-sm three-btn btn-view" data-object="{{ $site->toJson() }}" data-toggle="modal" data-target="#view_modal"><b>View</b></button> 
                                        <button class="btn btn-outline-warning btn-sm three-btn btn-edit" data-object="{{ $site->toJson() }}" data-toggle="modal" data-target="#edit_modal"><b>Edit</b></button>
                                        <button class="btn btn-outline-danger btn-sm three-btn btn-delete" data-url="{{ route('site.destroy', [$site->id]) }}" data-toggle="modal" data-target="#delete_modal"><b>Delete</b></button>
                                    </td>
                                </tr>
                                @endforeach
                            @endisset
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 5%" >ID</th>
                                <th style="width: 15%">Name</th>
                                <th style="width: 15%">District</th>
                                <th style="width: 10%"class="no-sort" >Status</th>
                                <th style="width: 17.5%">Purchasing Officer</th>
                                <th style="width: 17.5%">Project Manager</th>
                                <th style="width: 20%; text-align: center;" class="no-sort">Action</th>
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
                            <h3 class="card-title">View Site Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Site Name</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="name_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Province</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="province_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">District</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="district_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Started Date</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="started_date_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Purchasing Officer</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="po_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Project Manager</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="pm_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Quantity Surveyor</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="qs_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Stock Keeper</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="sk_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Active Status</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="status_view"></label>
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

<!-- edit modal  -->
<div class="modal fade" id="edit_modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{route('site.update')}}" method="post" class="form-horizontal">
                @csrf
                <div class="modal-body">
                    <div class="col">
                        <div class="card card-info mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Edit Site Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-12">
                                        <!-- Site Name  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Site Name</label>
                                            </div>
                                            <div class="col-7"> 
                                                <input type="text" name="name_edit" id="name_edit" required="required" placeholder="Name" class="form-control form-control-sm"/>
                                            </div>
                                        </div>
                                        <!-- Province  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Province</label>
                                            </div>
                                            <div class="col-7"> 
                                                <select class="form-control form-control-sm" id="province_edit" name="province_edit" required>
                                                    <option value="">---SELECT---</option>
                                                    @isset( $provinces )
                                                        @foreach($provinces as $province)
                                                            <option value="{{ $province->id }}"> {{$province->name}} </option> 
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                        <!-- District  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">District</label>
                                            </div>
                                            <div class="col-7"> 
                                                <select class="form-control form-control-sm" id="district_edit" name="district_edit" required>
                                                    <option value="">---SELECT---</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Construction Started Date -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Construction Started Date</label>
                                            </div>
                                            <div class="col-7"> 
                                                <input type="text" class="form-control form-control-sm" name="started_date_edit" id="started_date_edit" placeholder="yyyy-mm-dd" required>
                                            </div>
                                        </div>
                                        <!-- Purchasing Officer  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Purchasing Officer</label>
                                            </div>
                                            <div class="col-7"> 
                                                <select class="form-control form-control-sm" id="po_edit" name="po_edit">
                                                    <option value="">---SELECT---</option>
                                                    @isset( $purchasing_officers )
                                                        @foreach($purchasing_officers as $purchasing_officer)
                                                            <option value="{{ $purchasing_officer->id }}"> {{$purchasing_officer->name}} </option> 
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Project Manager  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Project Manager</label>
                                            </div>
                                            <div class="col-7"> 
                                                <select class="form-control form-control-sm" id="pm_edit" name="pm_edit">
                                                    <option value="">---SELECT---</option>
                                                    @isset( $project_managers )
                                                        @foreach($project_managers as $project_manager)
                                                            <option value="{{ $project_manager->id }}"> {{$project_manager->name}} </option> 
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Quantity Surveyor  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Quantity Surveyor</label>
                                            </div>
                                            <div class="col-7"> 
                                                <select class="form-control form-control-sm" id="qs_edit" name="qs_edit">
                                                    <option value="">---SELECT---</option>
                                                    @isset( $quantity_surveyors )
                                                        @foreach($quantity_surveyors as $quantity_surveyor)
                                                            <option value="{{ $quantity_surveyor->id }}"> {{$quantity_surveyor->name}} </option> 
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Stock Keeper  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Stock Keeper</label>
                                            </div>
                                            <div class="col-7"> 
                                                <select class="form-control form-control-sm" id="sk_edit" name="sk_edit">
                                                    <option value="">---SELECT---</option>
                                                    @isset( $stock_keepers )
                                                        @foreach($stock_keepers as $stock_keeper)
                                                            <option value="{{ $stock_keeper->id }}"> {{$stock_keeper->name}} </option> 
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Active Status -->
                                        <div class="form-group row"> 
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Active Status</label>
                                            </div>
                                            <div class="col-7">
                                                <div class="form-group">
                                                    <label class="col-5">
                                                        <input type="radio" id="active_edit" name="status_edit" value="active" class="minimal">
                                                        <label class="font-weight-normal">Active</label>
                                                    </label>
                                                    <label class="col-6">
                                                        <input type="radio" id="suspended_edit" name="status_edit" value="suspended" class="minimal">
                                                        <label class="font-weight-normal">Suspended</label>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- material id  -->
                                        <div class="form-group row">
                                            <input type="hidden" id="site_id" name="site_id" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- card body  -->
                        </div>
                        <!-- card  -->
                    </div>     
                </div>
                <!-- modal body  -->
                <div class="modal-footer d-flex justify-content-center">
                    <div class="col-3">
                        <button type="submit" class="btn btn-info two-btn">Update</button>
                        <button type="button" class="btn btn-secondary two-btn" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.edit modal  -->

<!-- delete modal  -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-danger font-weight-bold">Deleting the site...!</h3>
            </div>
            <div class="modal-body">
                <p>If you continue, you will delete this site from the system. Are you sure to delete it?</p>
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

        $(".btn-view").on('click', function(event){
            event.preventDefault();
            var buttonObject = $( this );
            buttonObject.attr('disabled', true);
            var jsonObject = buttonObject.data('object');
            var modalObject = $('#view_modal');
            
            var name_value = jsonObject.name;
            var province_value = jsonObject.province.name;
            var district_value = jsonObject.district.name;
            var started_date_value = jsonObject.started_date;
            var po_value = jsonObject.purchasing_officer? jsonObject.purchasing_officer.name : '';
            var pm_value = jsonObject.project_manager? jsonObject.project_manager.name : '';
            var qs_value = jsonObject.quantity_surveyor? jsonObject.quantity_surveyor.name : '';
            var sk_value = jsonObject.stock_keeper? jsonObject.stock_keeper.name : '';
            var status_value = jsonObject.is_active? "Active" : "Completed or Suspended";
            
            var name = $("#name_view");
            var province = $("#province_view");
            var district = $("#district_view");
            var started_date = $("#started_date_view");
            var po = $("#po_view");
            var pm = $("#pm_view");
            var qs = $("#qs_view");
            var sk = $("#sk_view");
            var status = $("#status_view");

            name.text(name_value);
            province.text( province_value );
            district.text( district_value );
            started_date.text( started_date_value );
            po.text( po_value );
            pm.text( pm_value );
            qs.text( qs_value );
            sk.text( sk_value );
            status.text(status_value);

            modalObject.modal().show();
            buttonObject.attr("disabled", false);
        });

        $('.btn-edit').on('click', function(event){
            event.preventDefault();
            var buttonObject = $( this );
            buttonObject.attr('disabled', true);
            var jsonObject = buttonObject.data('object');
            var modalObject = $('#edit_modal');

            var name_value = jsonObject.name;
            var province_value = jsonObject.province.id;
            var district_value = jsonObject.district.id;
            var started_date_value = jsonObject.started_date;
            var po_value = jsonObject.purchasing_officer? jsonObject.purchasing_officer.id : '';
            var pm_value = jsonObject.project_manager? jsonObject.project_manager.id : '';
            var qs_value = jsonObject.quantity_surveyor? jsonObject.quantity_surveyor.id : '';
            var sk_value = jsonObject.stock_keeper? jsonObject.stock_keeper.id : '';
            var status_value = jsonObject.is_active;
            var site_id_value = jsonObject.id;

            var name = $("#name_edit");
            var province = $("#province_edit option");
            var district = $("#district_edit");
            var started_date = $("#started_date_edit");
            var po = $("#po_edit option");
            var pm = $("#pm_edit option");
            var qs = $("#qs_edit option");
            var sk = $("#sk_edit option");
            var active = $('#active_edit');
            var suspended = $('#suspended_edit');
            var site_id = $("#site_id");
            
            name.val(name_value);
            site_id.val(site_id_value);

            $.each(province, function(k, v){
                if( v.value == province_value ){
                    $(v).attr('selected', 'selected');
                }else{
                    $(v).attr('selected', false);
                }
            }); 
            
            $.get('http://localhost:8000/districts?province_id='+province_value, function( data ){
                district.empty();
                var option = $("<option>");
                option.text("---SELECT---");
                district.append( option );
                $.each(data, function(key, value){
                    option = $("<option>");
                    option.attr("value", value.id);
                    if(value.id == district_value){
                        option.attr('selected', 'selected');
                    }else{
                        option.attr('selected', false);
                    }
                    option.text( value.name );
                    district.append( option );
                });
            });
            started_date.val(started_date_value);

            $.each(po, function(k, v){
                if( v.value == po_value ){
                    $(v).attr('selected', 'selected');
                }else{
                    $(v).attr('selected', false);
                }
            }); 
            $.each(pm, function(k, v){
                if( v.value == pm_value ){
                    $(v).attr('selected', 'selected');
                }else{
                    $(v).attr('selected', false);
                }
            }); 
            $.each(qs, function(k, v){
                if( v.value == qs_value ){
                    $(v).attr('selected', 'selected');
                }else{
                    $(v).attr('selected', false);
                }
            }); 
            $.each(sk, function(k, v){
                if( v.value == sk_value ){
                    $(v).attr('selected', 'selected');
                }else{
                    $(v).attr('selected', false);
                }
            }); 

            
            if(status_value){
                suspended.attr('checked', false);
                active.attr('checked', true);
            }else{
                active.attr('checked', false);
                suspended.attr('checked', true);
            }

            modalObject.modal().show();
            buttonObject.attr('disabled', false);
            
        });

        $('#province_edit').change( function(){
            var district = $('#district_edit');
            var province_value = $( this ).val();
            $.get('http://localhost:8000/districts?province_id='+province_value, function( data ){
                district.empty();
                var option = $("<option>");
                option.text("---SELECT---");
                district.append( option );
                $.each(data, function(key, value){
                    option = $("<option>");
                    option.attr("value", value.id);
                    option.text( value.name );
                    district.append( option );
                });
            });
        });

        $('.btn-delete').on('click', function(event){
            var buttonObject = $( this);
            var url = buttonObject.data('url');
            $('#delete_modal').modal().show();
            $('#delete_button').on('click', function(){
                window.location.replace( url );
            });
        });
    });
    
</script>

@endpush