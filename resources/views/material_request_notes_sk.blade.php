@extends('layouts.home_layout')

@section('yield_contant')
<!-- Content Wrapper -->
<!-- -- div class="content-wrapper" -- -->


<!-- Main content -->
<section class="content">
<div>
    <br>
    <h2 class="ml-5">Material requests belongs to the site</h2>
    <hr>
    <br>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title"> Material Requests</h3>
                </div>
                <!-- /.card-header -->
                <!-- /.card-body -->
                <div class="card-body">
                    
                    <table id="table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%" >ID</th>
                                <th style="width: 12.5%">SRN Date</th>
                                <th style="width: 10%" class="no-sort">Urgent</th>
                                <th style="width: 12.5%">Delivery Date</th>
                                <th style="width: 15%" class="no-sort" >Total Cost (Rs)</th>
                                <th style="width: 10%" class="no-sort">Complete</th>
                                <th style="width: 10%" class="no-sort">Status</th>
                                <th style="width: 25%; text-align: center;" class="no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody id="site_list">
                            @isset($material_request_notes)
                                @foreach($material_request_notes as $note)
                                <tr>
                                    <td>{{ $note->id }}</td>
                                    <td>{{ $note->note_date }}</td>
                                    <td class="text-center">{{ $note->is_urgent == true ? "Urgent" : "Non-urgent" }}</td>
                                    <td>{{ $note->delivery_date }}</td>

                                    @php
                                        $total_cost = 0;
                                        foreach ($note->materials as $material) {
                                            $total_cost += $material->cost;
                                        }
                                    @endphp
                                    <td class="text-right">{{ number_format((float)$total_cost, 2, '.', ',') }}</td>
                                    <td class="text-center">{{ $note->is_complete? "Complete" : "Not-Complete"}}</td>
                                    @if($note->goodReceiveNote)
                                        <td class="text-center text-info">Received</td>
                                    @else
                                        @if($note->is_approved == "Pending")
                                            <td class="text-center text-warning">{{ $note->is_approved }}</td>
                                        @elseif($note->is_approved == "Approved")
                                            <td class="text-center text-success">{{ $note->is_approved }}</td>
                                        @elseif($note->is_approved == "Declined")
                                            <td class="text-center text-danger">{{ $note->is_approved }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                    @endif
                                    <td class="d-flex justify-content-start">
                                        @if($note->is_complete == 'false')
                                            <a class="btn btn-outline-info btn-sm three-btn mr-2" id="view_{{$note->id}}" href="{{ route('material_request_note.show', ['note_id' => $note->id]) }}"><b>View</b></a> 
                                            <a class="btn btn-outline-warning btn-sm three-btn mr-2" id="edit_{{$note->id}}" onclick="return {{ $note->is_complete? 'false' : 'true'}}"  href="{{ route('material_request_note.edit', ['note_id' => $note->id]) }}" disabled=""><b>Edit</b></a>
                                            <button class="btn btn-outline-danger btn-sm three-btn r-2" id="delete_{{$note->id}}" onclick="note_delete({{$note->id}})" ><b>Delete</b></button>
                                        @else
                                            @if($note->is_approved == "Approved")
                                                <a class="btn btn-outline-info btn-sm three-btn" id="view_{{$note->id}}" href="{{ route('material_request_note.show', ['note_id' => $note->id]) }}"><b>View</b></a> 
                                                <button class="btn btn-outline-success btn-sm three-btn btn-approve" data-object="{{ $note->toJson() }}" data-toggle="modal" data-target="#view_approve_note_modal"><b>AN</b></button>
                                                @if($note->goodReceiveNote)
                                                    <button class="btn btn-outline-warning btn-sm three-btn btn-grn-view" data-object="{{ $note->toJson() }}" data-toggle="modal" data-target="#view_good_receive_note_modal"><b>GRN</b></button> 
                                                @else
                                                    <button class="btn btn-outline-warning btn-sm three-btn btn-note" data-id="{{$note->id}}" data-toggle="modal" data-target="#good_receive_note_modal"><b>GRN</b></button>
                                                @endif
                                            @elseif($note->is_approved == "Declined")
                                                <a class="btn btn-outline-info btn-sm three-btn" id="view_{{$note->id}}" href="{{ route('material_request_note.show', ['note_id' => $note->id]) }}"><b>View</b></a> 
                                                <button class="btn btn-outline-danger btn-sm three-btn btn-decline" data-object="{{ $note->toJson() }}" data-toggle="modal" data-target="#view_decline_note_modal"><b>DN</b></button>
                                            @else
                                                <a class="btn btn-outline-info btn-sm three-btn" id="view_{{$note->id}}" href="{{ route('material_request_note.show', ['note_id' => $note->id]) }}"><b>View</b></a> 
                                            @endif
                                        @endif
                                        </td>
                                </tr>
                                @endforeach
                            @endisset
                        </tbody>
                        <tfoot>
                            <tr>
                            <th style="width: 5%" >ID</th>
                                <th style="width: 12.5%">SRN Date</th>
                                <th style="width: 10%">Urgent</th>
                                <th style="width: 12.5%">Delivery Date</th>
                                <th style="width: 15%">Total Cost (Rs)</th>
                                <th style="width: 10%">Complete</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 25%; text-align: center;">Action</th>
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

<!-- Delete Modal -->
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger font-weight-bold">Deleting the material requests note...! </h5>
            </div>
            <div class="modal-body">
                <p>If you continue you will delete this material request. Are you sure to delete this material request? </p>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="col-md-5 mt-3">
                            <button class="btn btn-danger rounded two-btn" id="deleteButton" data-url="{{ route('material_request_note.destroy', ['id']) }}" >Delete</button>
                            <button type="button" class="btn  btn-warning rounded two-btn" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
<!-- /.Delete Modal -->

<!-- Good Receive Note Modal -->

<div class="modal fade" role="dialog" id="good_receive_note_modal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('good_receive_note.store') }}" class="form-horizontal" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="col">
                        <div class="card card-warning mt-3">
                            <div class="card-header">
                                <h3 class="card-title w-100">Create Good Receive Note</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-12">
                                        <!-- material note id -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Material Request Note</label>
                                            </div>
                                            <div class="col-7"> 
                                                <input id="note_id" name="note_id" class="font-weight-normal bg-white border border-white" readonly/>
                                            </div>
                                        </div>
                                        <!-- /.material note id -->
                                        <!-- received date  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Material Received Date</label>
                                            </div>
                                            <div class="col-7"> 
                                                <input type="text" name="received_date" id="received_date" required="required" placeholder="yyyy-mm-dd" class="form-control form-control-sm daterange-picker"/>
                                            </div>
                                        </div>
                                        <!-- /.received date  -->
                                        
                                        <!-- approve note  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Good Receive Note</label>
                                            </div>
                                            <div class="col-7"> 
                                                <textarea type="text" class="form-control form-control-sm w-100" rows="4" name="good_receive_note" id="good_receive_note" placeholder="Comment" required></textarea>
                                            </div>
                                        </div>
                                        <!-- /.approve note -->
                                    </div>
                                </div>
                            </div>
                            <!-- card-body  -->
                        </div>
                        <!-- card  -->
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" id="approve_button" class="btn btn-outline-warning">Create</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
        
<!-- /.Good Receive Note Modal -->


<!-- View Approve Note Modal  -->
<div class="modal fade" id="view_approve_note_modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col">
                    <div class="card card-info mt-3">
                        <div class="card-header">
                            <h3 class="card-title">View Approve Note</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Site Name</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="site_name"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Material Note ID</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="note_id_approve"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Approved By</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="approved_by"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Approved Date</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="approved_date"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Approve Note</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="approve_note"></label>
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
<!-- /.View Approve Note Modal  -->


<!-- View Decline Note Modal  -->
<div class="modal fade" id="view_decline_note_modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col">
                    <div class="card card-warning mt-3">
                        <div class="card-header">
                            <h3 class="card-title">View Declined Note</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Site Name</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="site_name_declined"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Material Note ID</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="note_id_declined"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Approved By</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="declined_by"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Approved Date</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="declined_date"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Approve Note</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="declined_note"></label>
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

<!-- /.View Decline Note Modal -->

<!-- View Good Receive Modal  -->
<div class="modal fade" id="view_good_receive_note_modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col">
                    <div class="card card-success mt-3">
                        <div class="card-header">
                            <h3 class="card-title">View Good Receive Note</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Site Name</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="site_name_grn_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Material Note ID</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="note_id_grn_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Created By</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="created_by_grn_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Created Date</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="created_date_grn_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Good Receive Note</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="good_receive_note_view"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal body  -->
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /.View Good Receive Modal  -->


@endsection

@push('stack_script')
    <!-- data table  -->
    <script>
        $('#table').DataTable({
            "paging"        : true,
            "lengthChange"  : true,
            "searching"     : true,
            "ordering"      : true,
            "info"          : true,
            "autoWidth"     : false,
            "responsive"    : true,
            columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }]

        });
    </script>

    <!-- date picker  -->
    <script>
    $(function(){
        "use strict";
        
        $('.select2').select2({
            theme: 'bootstrap'
            
        });
        
        $('.daterange-picker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            //maxYear: parseInt(moment().format('YYYY'), 10),
            //minYear: parseInt(moment().format('YYYY'), 10),
            locale: {
                format: "YYYY-MM-DD",
                separator: " - ",
                cancelLabel: 'Clear'
            },
            //startDate: moment(),
            //endDate: moment()
        }).val('');
        
    });
    </script>
    <!-- note delete -->
    <script>
        function note_delete(id) {
        $("#deleteModal").modal().show();
        $('#deleteButton').click(function(e){ 
            var url = $(this).data("url");
            url = url.replace("id", id);
            window.location.replace( url );
        });
        }
    </script>
    <script>
        // good receive note
        $(function(){
            $(".btn-note").on('click', function(event){
                event.preventDefault();
                var buttonObject = $( this );
                buttonObject.attr("disabled", true);
                var note_id_value = buttonObject.data('id');
                var modalObject = $("#good_receive_note_modal");
                 
            
                var note_id = $('#note_id');
                note_id.val(note_id_value);
                
                var approveButton = $('#approve_button');
                
                modalObject.modal().show();
                buttonObject.attr("disabled", false);
            });
        });
        //view approved note
        $(function(){
            $(".btn-approve").on('click', function(event){
                event.preventDefault();
                var buttonObject = $( this );
                buttonObject.attr("disabled", true);
                var noteObject = buttonObject.data('object');
                var modalObject = $("#view_approve_note_modal");
                
                var site_name = $('#site_name');
                var note_id = $('#note_id_approve');
                var approved_by = $('#approved_by');
                var approved_date = $('#approved_date');
                var approve_note = $('#approve_note');
                
                
                site_name.text(noteObject.site.name);
                note_id.text(noteObject.id);
                var approved_by_id = noteObject.approve_note.created_by_id? noteObject.approve_note.created_by_id : 0;
                console.log(approved_by_id);
                $.get( 'http://localhost:8000/user/' + approved_by_id, function( data ){
                    approved_by.text(data.name? data.name : '');
                });
                approved_date.text((noteObject.approve_note.created_at).substring(0, 10));
                approve_note.text(noteObject.approve_note.description);
                modalObject.modal().show();
                buttonObject.attr("disabled", false);
            });
        });

        //view declined note
        $(function(){
            $(".btn-decline").on('click', function(event){
                event.preventDefault();
                var buttonObject = $( this );
                buttonObject.attr("disabled", true);
                var noteObject = buttonObject.data('object');
                var modalObject = $("#view_decline_note_modal");
                
                var site_name_declined = $('#site_name_declined');
                var note_id_declined = $('#note_id_declined');
                var declined_by = $('#declined_by');
                var declined_date = $('#declined_date');
                var declined_note = $('#declined_note');
                
                
                site_name_declined.text(noteObject.site.name);
                note_id_declined.text(noteObject.id);
                var declined_by_id = noteObject.approve_note.created_by_id? noteObject.approve_note.created_by_id : 0;
               
                $.get( 'http://localhost:8000/user/' + declined_by_id, function( data ){
                    console.log(data.name);
                    declined_by.text(data.name? data.name : '');
                });
                declined_date.text((noteObject.approve_note.created_at).substring(0, 10));
                declined_note.text(noteObject.approve_note.description);
                modalObject.modal().show();
                buttonObject.attr("disabled", false);
            });
        });

        //view good receive note
        $(function(){
            $(".btn-grn-view").on('click', function(event){
                event.preventDefault();
                var buttonObject = $( this );
                buttonObject.attr("disabled", true);
                var noteObject = buttonObject.data('object');
                var modalObject = $("#view_good_receive_note_modal");
                
                var site_name_grn_view = $('#site_name_grn_view');
                var note_id_grn_view = $('#note_id_grn_view');
                var created_by_grn_view = $('#created_by_grn_view');
                var created_date_grn_view = $('#created_date_grn_view');
                var good_receive_note_view = $('#good_receive_note_view');
                
                
                site_name_grn_view.text(noteObject.site.name);
                note_id_grn_view.text(noteObject.id);
                var created_by_id = noteObject.good_receive_note.created_by_id? noteObject.good_receive_note.created_by_id : 0;
                
                $.get( 'http://localhost:8000/user/' + created_by_id, function( data ){
                    created_by_grn_view.text(data.name? data.name : '');
                });
                created_date_grn_view.text((noteObject.good_receive_note.created_at).substring(0, 10));
                good_receive_note_view.text(noteObject.good_receive_note.description);
                modalObject.modal().show();
                buttonObject.attr("disabled", false);
            });
        });
    </script>
@endpush