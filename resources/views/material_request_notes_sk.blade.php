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
                                <th style="width: 15%">SRN Date</th>
                                <th style="width: 10%" class="no-sort">Urgent</th>
                                <th style="width: 15%">Delivery Date</th>
                                <th style="width: 15%" class="no-sort" >Total Cost (Rs)</th>
                                <th style="width: 10%" class="no-sort">Complete</th>
                                <th style="width: 10%" class="no-sort">Status</th>
                                <th style="width: 20%; text-align: center;" class="no-sort">Action</th>
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
                                    <td class="text-center">{{ $note->is_approved }}</td>
                                    <td class="d-flex justify-content-around">
                                        <a class="btn btn-outline-info btn-sm three-btn" id="view_{{$note->id}}" href="{{ route('material_request_note.show', ['note_id' => $note->id]) }}"><b>View</b></a> 
                                        <a class="btn btn-outline-warning btn-sm three-btn" id="edit_{{$note->id}}" onclick="return {{ $note->is_complete? 'false' : 'true'}}"  href="{{ route('material_request_note.edit', ['note_id' => $note->id]) }}" disabled=""><b>Edit</b></a>
                                        <button class="btn btn-outline-danger btn-sm three-btn" id="delete_{{$note->id}}" onclick="note_delete({{$note->id}})" ><b>Delete</b></button>
                                    </td>
                                </tr>
                                @endforeach
                            @endisset
                        </tbody>
                        <tfoot>
                            <tr>
                            <th style="width: 5%" >ID</th>
                                <th style="width: 15%">SRN Date</th>
                                <th style="width: 10%">Urgent</th>
                                <th style="width: 15%">Delivery Date</th>
                                <th style="width: 15%">Total Cost (Rs)</th>
                                <th style="width: 10%">Complete</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 20%; text-align: center;">Action</th>
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
                <p class="modal_body">If you continue you will delete this material request. Are you sure to delete this material request? </p>
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
        function note_delete(id) {
        $("#deleteModal").modal().show();
        $('#deleteButton').click(function(e){ 
            var url = $(this).data("url");
            url = url.replace("id", id);
            window.location.replace( url );
        });
}
    </script>
@endpush