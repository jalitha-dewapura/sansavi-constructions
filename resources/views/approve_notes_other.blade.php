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
                                <th style="width: 20%" class="no-sort">Site Name</th>
                                <th style="width: 16%">SRN Date</th>
                                <th style="width: 10%" class="no-sort">Urgent</th>
                                <th style="width: 16%">Delivery Date</th>
                                <th style="width: 15%" class="no-sort" >Total Cost (Rs)</th>
                                <th style="width: 10%" class="no-sort">Status</th>
                                <th style="width: 8%; text-align: center;" class="no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody id="site_list">
                            @isset($material_request_notes)
                                @foreach($material_request_notes as $note)
                                    <tr>
                                        <td>{{ $note->id }}</td>
                                        <td>{{ $note->site->name }}</td>
                                        <td>{{ $note->note_date }}</td>
                                        <td>{{ $note->is_urgent == true ? "Urgent" : "Non-urgent" }}</td>
                                        <td>{{ $note->delivery_date }}</td>
                                        @php
                                            $total_cost = 0;
                                            foreach ($note->materials as $material) {
                                                $total_cost += $material->cost;
                                            }
                                        @endphp
                                        <td class="text-right">{{ number_format((float)$total_cost, 2, '.', ',') }}</td>
                                        <td>{{ $note->is_approved }}</td>
                                        <td class="d-flex justify-content-around">
                                            <button class="btn btn-outline-info btn-sm one-btn" id="view" onclick="view_user_details( {{ $note->id }} )"><b>View</b></button> 
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 5%" >ID</th>
                                <th style="width: 20%">Site Name</th>
                                <th style="width: 16%">SRN Date</th>
                                <th style="width: 10%"></th>Urgent</th>
                                <th style="width: 16%">Delivery Date</th>
                                <th style="width: 15%">Total Cost (Rs)</th>
                                <th style="width: 10%">Approved</th>
                                <th style="width: 8%; text-align: center;">Action</th>
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
@endpush