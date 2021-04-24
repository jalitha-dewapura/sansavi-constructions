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
                                <th style="width: 12.5%">SRN Date</th>
                                <th style="width: 9%" class="no-sort">Urgent</th>
                                <th style="width: 12.5%">Delivery Date</th>
                                <th style="width: 15%" class="no-sort" >Total Cost (Rs)</th>
                                <th style="width: 9%" class="no-sort">Status</th>
                                <th style="width: 22%; text-align: center;" class="no-sort">Action</th>
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
                                    <td class="text-center">{{ $note->is_complete == true ? "Complete" : "Not-Complete"}}</td>
                                    <td class="d-flex justify-content-around">
                                        @if($note->is_complete and $note->is_approved == "Pending")
                                            <a class="btn btn-outline-info btn-sm three-btn" id="view_{{$note->id}}" href="{{ route('material_request_note.show', ['note_id' => $note->id]) }}"><b>View</b></a> 
                                            <button class="btn btn-outline-warning btn-sm three-btn btn-approve" data-id="{{$note->id}}" data-toggle="modal" data-target="#approve_modal"><b>Approve</b></button>
                                            <button class="btn btn-outline-danger btn-sm three-btn btn-decline"  data-id="{{$note->id}}" data-toggle="modal" data-target="#decline_modal"><b>Decline</b></button>
                                        @elseif($note->is_approved == "Approved")
                                            <a class="btn btn-outline-info btn-sm two-btn" id="view_{{$note->id}}" href="{{ route('material_request_note.show', ['note_id' => $note->id]) }}"><b>View</b></a> 
                                            <a class="btn btn-outline-warning btn-sm two-btn" id="download_{{$note->id}}" href="{{ route('generate_po.generate', ['note_id' => $note->id]) }}"><b>Download</b></a> 
                                        @elseif($note->is_approved == "Declined")
                                            <a class="btn btn-outline-info btn-sm two-btn" id="view_{{$note->id}}" href="{{ route('material_request_note.show', ['note_id' => $note->id]) }}"><b>View</b></a> 
                                            <a class="btn btn-outline-warning btn-sm two-btn" id="note_{{$note->id}}" href="{{ route('material_request_note.show', ['note_id' => $note->id]) }}"><b>Decline Note</b></a> 
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
                                <th style="width: 12.5%">SRN Date</th>
                                <th style="width: 9%">Urgent</th>
                                <th style="width: 12.5%">Delivery Date</th>
                                <th style="width: 15%">Total Cost (Rs)</th>
                                <th style="width: 9%">Status</th>
                                <th style="width: 22%; text-align: center;">Action</th>
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

<!-- Approve Modal  -->
<div class="modal fade" role="dialog" id="approve_modal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('approve_note.approve') }}" class="form-horizontal" method="post">
                @csrf
                <div class="modal-body">
                    <div class="col">
                        <div class="card card-warning mt-3">
                            <div class="card-header">
                                <h3 class="card-title w-100">Approve Material Request</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-12">
                                        <!-- material note  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Material Request Note</label>
                                            </div>
                                            <div class="col-7"> 
                                                <input id="approve_note_id" name="approve_note_id" class="font-weight-normal bg-white border border-white" readonly/>
                                            </div>
                                        </div>
                                        <!-- /.material note  -->
                                        <!-- approve note  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Approve Note</label>
                                            </div>
                                            <div class="col-7"> 
                                                <textarea type="text" class="form-control form-control-sm w-100" rows="4" name="approve_note" id="approve_note" placeholder="Approve Note" required></textarea>
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
                    <button type="submit" id="approve_button" class="btn btn-outline-warning">Approve</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.Approve Modal  -->
<!-- Decline Modal  -->
<div class="modal fade" role="dialog" id="decline_modal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('approve_note.decline') }}" class="form-horizontal" method="post">
                @csrf
                <div class="modal-body">
                    <div class="col">
                        <div class="card card-danger mt-3">
                            <div class="card-header">
                                <h3 class="card-title w-100">Decline Material Request</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-12">
                                        <!-- material note  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Material Request Note</label>
                                            </div>
                                            <div class="col-7"> 
                                                <input id="decline_note_id" name="decline_note_id" class="font-weight-normal bg-white border border-white" readonly/>
                                            </div>
                                        </div>
                                        <!-- /.material note  -->
                                        <!-- approve note  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Decline Note</label>
                                            </div>
                                            <div class="col-7"> 
                                                <textarea type="text" class="form-control form-control-sm w-100" rows="4" name="decline_note" id="decline_note" placeholder="Decline Note" required></textarea>
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
                    <button type="submit" id="decline_button" class="btn btn-outline-danger">Decline</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.Decline Modal  -->

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
    </script>
@endpush