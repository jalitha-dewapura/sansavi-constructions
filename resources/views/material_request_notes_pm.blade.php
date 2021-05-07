@extends('layouts.home_layout')

@section('yield_contant')
<!-- Content Wrapper -->
<!-- -- div class="content-wrapper" -- -->


<!-- Main content -->
<section class="content">
<div>
    <br>
    <h2 class="ml-5">Approve Material requests</h2>
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
                                <th style="width: 15%" class="no-sort">Site Name</th>
                                <th style="width: 11%">SRN Date</th>
                                <th style="width: 9%" class="no-sort">Urgent</th>
                                <th style="width: 11%">Delivery Date</th>
                                <th style="width: 15%" class="no-sort" >Total Cost (Rs)</th>
                                <th style="width: 9%" class="no-sort">Status</th>
                                <th style="width: 25%; text-align: center;" class="no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody id="site_list">
                            @isset($material_request_notes)
                                @foreach($material_request_notes as $note)
                                <tr>
                                    <td>{{ $note->id }}</td>
                                    <td>{{ $note->site->name }}</td>
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
                                        @if($note->is_approved == "Pending")
                                            <a class="btn btn-outline-info btn-sm three-btn" id="view_{{$note->id}}" href="{{ route('material_request_note.show', ['note_id' => $note->id]) }}"><b>View</b></a> 
                                        @elseif($note->is_approved == "Approved")
                                            @if($note->goodReceiveNote)
                                                <a class="btn btn-outline-info btn-sm three-btn" id="view_{{$note->id}}" href="{{ route('material_request_note.show', ['note_id' => $note->id]) }}"><b>View</b></a> 
                                                <button class="btn btn-outline-success btn-sm three-btn btn-grn-view" data-object="{{ $note->toJson() }}" data-toggle="modal" data-target="#view_good_receive_note_modal"><b>GRN</b></button> 
                                                <a class="btn btn-outline-warning btn-sm three-btn" id="download_{{$note->id}}" href="{{ route('generate_po.generate', ['note_id' => $note->id]) }}"><b>Download</b></a> 
                                            @else
                                                <a class="btn btn-outline-info btn-sm three-btn" id="view_{{$note->id}}" href="{{ route('material_request_note.show', ['note_id' => $note->id]) }}"><b>View</b></a> 
                                                <button class="btn btn-outline-success btn-sm three-btn btn-approve-view" data-object="{{ $note->toJson() }}" data-toggle="modal" data-target="#view_approve_note_modal"><b>AN</b></button> 
                                                <a class="btn btn-outline-warning btn-sm three-btn" id="download_{{$note->id}}" href="{{ route('generate_po.generate', ['note_id' => $note->id]) }}"><b>Download</b></a> 
                                            @endif
                                        @elseif($note->is_approved == "Declined")
                                            <a class="btn btn-outline-info btn-sm three-btn" id="view_{{$note->id}}" href="{{ route('material_request_note.show', ['note_id' => $note->id]) }}"><b>View</b></a> 
                                            <button class="btn btn-outline-danger btn-sm three-btn btn-decline-view" data-object="{{ $note->toJson() }}" data-toggle="modal" data-target="#view_decline_note_modal"><b>DN</b></button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @endisset
                        </tbody>
                        <tfoot>
                            <tr>
                            <th style="width: 5%" >ID</th>
                                <th style="width: 15%">Site Name</th>
                                <th style="width: 11%">SRN Date</th>
                                <th style="width: 9%">Urgent</th>
                                <th style="width: 11%">Delivery Date</th>
                                <th style="width: 15%">Total Cost (Rs)</th>
                                <th style="width: 9%">Status</th>
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


<!-- View Approve Note Modal  -->
<div class="modal fade" id="view_approve_note_modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col">
                    <div class="card card-success mt-3">
                        <div class="card-header">
                            <h3 class="card-title">View Approve Note</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Site Name</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="site_name_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Material Note ID</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="note_id_approve_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Approved By</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="approved_by_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Approved Date</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="approved_date_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Approve Note</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="approve_note_view"></label>
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
<!-- /.View Approve Note Modal  -->


<!-- View Decline Note Modal  -->
<div class="modal fade" id="view_decline_note_modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col">
                    <div class="card card-danger mt-3">
                        <div class="card-header">
                            <h3 class="card-title">View Declined Note</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Site Name</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="site_name_declined_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Material Note ID</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="note_id_declined_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Approved By</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="declined_by_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Approved Date</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="declined_date_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Approve Note</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="declined_note_view"></label>
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
    <script>
        $(function(){
            $(".btn-approve").on('click', function(event){
                event.preventDefault();
                var buttonObject = $( this );
                buttonObject.attr("disabled", true);
                var note_id_value = buttonObject.data('id');
                var modalObject = $("#approve_modal");
                 
            
                var note_id = $('#approve_note_id');
                note_id.val(note_id_value);
                
                var approveButton = $('#approve_button');
                
                modalObject.modal().show();
                buttonObject.attr("disabled", false);
            });

            $(".btn-decline").on('click', function(event){
                event.preventDefault();
                var buttonObject = $( this );
                buttonObject.attr("disabled", true);
                var note_id_value = buttonObject.data('id');
                var modalObject = $("#decline_modal");
                console.log(note_id_value); 
            
                var note_id = $('#decline_note_id');
                note_id.val(note_id_value);
                
                var declineButton = $('#decline_button');
                
                modalObject.modal().show();
                buttonObject.attr("disabled", false);
            });
        });
        //view approved note
        $(function(){
            $(".btn-approve-view").on('click', function(event){
                event.preventDefault();
                var buttonObject = $( this );
                buttonObject.attr("disabled", true);
                var noteObject = buttonObject.data('object');
                var modalObject = $("#view_approve_note_modal");
                
                var site_name = $('#site_name_view');
                var note_id = $('#note_id_approve_view');
                var approved_by = $('#approved_by_view');
                var approved_date = $('#approved_date_view');
                var approve_note = $('#approve_note_view');
                
                
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
            $(".btn-decline-view").on('click', function(event){
                event.preventDefault();
                var buttonObject = $( this );
                buttonObject.attr("disabled", true);
                var noteObject = buttonObject.data('object');
                var modalObject = $("#view_decline_note_modal");
                
                var site_name_declined = $('#site_name_declined_view');
                var note_id_declined = $('#note_id_declined_view');
                var declined_by = $('#declined_by_view');
                var declined_date = $('#declined_date_view');
                var declined_note = $('#declined_note_view');
                
                
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
                var created_by_id = noteObject.good_receive_note.created_by_id? noteObject.receive_note.created_by_id : 0;
               
                $.get( 'http://localhost:8000/user/' + created_by_id, function( data ){
                    console.log(data.name);
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