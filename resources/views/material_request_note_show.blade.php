@extends('layouts.home_layout')


@section('yield_contant')
<!-- Content Wrapper -->
<!-- -- div class="content-wrapper" -- -->


<!-- Main content -->
<section class="content">
<div>
    <br>
    <h2 class="ml-5">View Material Request</h2>
    <hr>
    <br>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="col-5">
                <div class="row d-flex justify-content-center">
                    <label class="col col-auto col-sm-5">SRN No</label>
                    <label id="srn_no" class="col col-auto col-sm-5">{{ $note->id }}</label>      
                </div>
                <div class="row d-flex justify-content-center">
                    <label class="col col-auto col-sm-5">Site Name</label>
                    <label id="srn_no" class="col col-auto col-sm-5">{{ $note->site->name }}</label>      
                </div>
                <div class="row d-flex justify-content-center">
                    <label class="col col-auto col-sm-5">Urgernt Order</label>
                    <label id="srn_no" class="col col-auto col-sm-5">{{ $note->is_urgent? "Urgent" : "Not Urgent" }}</label>      
                </div>
            </div>
            <div class="col-5">
                <div class="row d-flex justify-content-center">
                    <label class="col col-auto col-sm-5">SRN Date</label>
                    <label id="srn_no" class="col col-auto col-sm-5">{{ $note->note_date }}</label>      
                </div>
                <div class="row d-flex justify-content-center">
                    <label class="col col-auto col-sm-5">Completion Status</label>
                    <label id="srn_no" class="col col-auto col-sm-5">{{ $note->is_complete? "Complete" : "Not Complete" }}</label>      
                </div>
                <div class="row d-flex justify-content-center">
                    <label class="col col-auto col-sm-5">Delivery Date</label>
                    <label id="srn_no" class="col col-auto col-sm-5">{{ $note->delivery_date }}</label>      
                </div>
            </div>
            <!-- col-5  -->
        </div>
        <!-- col-12  -->
    </div>
    <!-- row  -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">Material List</h3>
                </div>
                <!-- /.card-header -->
                <!-- /.card-body -->
                <div class="card-body">
                    
                    <table id="table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 20%"> Item </th>
                                <th style="width: 10%"> Quantity </th>
                                <th style="width: 20%"> Unit Price (Rs)</th>
                                <th style="width: 20%"> Total Cost (Rs)</th>
                                <th style="width: 30%"> Description </th>
                            </tr>
                        </thead>
                        <tbody id="material_list">
                            @isset($materials)
                                @foreach($materials as $material)
                                <tr>
                                    <td>{{ $material->item->name }}</td>
                                    <td>{{ $material->quantity }} {{ $material->item->measuringUnit->name }}</td>
                                    <td class="text-right">{{ number_format((float)$material->item->price, 2, '.', ',') }}</td>
                                    <td class="text-right">{{ number_format((float)$material->cost, 2, '.', ',') }}</td>
                                    <td>{{ $material->description }}</td>
                                </tr>
                                @endforeach
                            @endisset
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 20%"> Item </th>
                                <th style="width: 10%"> Quantity </th>
                                <th style="width: 20%"> Unit Price (Rs)</th>
                                <th style="width: 20%"> Total Cost (Rs)</th>
                                <th style="width: 30%"> Description </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-12 -->
    </div>
</div>
<!-- container-fluid  -->
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