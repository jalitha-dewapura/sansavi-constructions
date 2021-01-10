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
                                <th style="width: 15%">Code</th>
                                <th style="width: 15%">Name</th>
                                <th style="width: 15%">Price (Rs)</th>
                                <th style="width: 15%"class="no-sort" >Measuring Units</th>
                                <th style="width: 15%">Item Type</th>
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
                            @isset($items)
                                @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-right">{{ number_format((float)$item->price, 2, '.', ',') }}</td>
                                    <td>{{ $item->measuringUnit->name }}</td>
                                    <td>{{ $item->is_consumable == true ? "Consumable" : "Asset" }}</td>
                                    <td class="d-flex justify-content-around">
                                        <button class="btn btn-outline-info btn-sm three-btn btn-view" data-object="{{ $item->toJson() }}" data-toggle="modal" data-target="#view_modal"><b>View</b></button> 
                                        <button class="btn btn-outline-warning btn-sm three-btn btn-edit" data-object="{{ $item->toJson() }}" data-toggle="modal" data-target="#edit_modal"><b>Edit</b></button>
                                        <button class="btn btn-outline-danger btn-sm three-btn btn-delete" data-url="{{ route('item.destroy', [$item->id]) }}" data-toggle="modal" data-target="#delete_modal"><b>Delete</b></button>
                                    </td>
                                </tr>
                                @endforeach
                            @endisset
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 5%" >ID</th>
                                <th style="width: 15%">Code</th>
                                <th style="width: 15%">Name</th>
                                <th style="width: 15%">Price (Rs)</th>
                                <th style="width: 15%"class="no-sort" >Measuring Units</th>
                                <th style="width: 15%">Item Type</th>
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

<!-- view modal -->
<div class="modal fade" id="view_modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col">
                    <div class="card card-info mt-3">
                        <div class="card-header">
                            <h3 class="card-title">View Item Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <label  class="font-weight-normal">Item Code</label>
                                </div>
                                <div class="col-7">
                                    <label  class="font-weight-normal" id="code_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label class="font-weight-normal">Item Name</label>
                                </div>
                                <div class="col-7">
                                    <label class="font-weight-normal" id="name_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label class="font-weight-normal">Measuring Unit</label>
                                </div>
                                <div class="col-7">
                                    <label class="font-weight-normal" id="measuring_unit_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label class="font-weight-normal">Unit Price</label>
                                </div>
                                <div class="col-7">
                                    <label class="font-weight-normal" id="price_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label class="font-weight-normal">Item Type</label>
                                </div>
                                <div class="col-7">
                                    <label class="font-weight-normal" id="type_view"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label class="font-weight-normal">Description</label>
                                </div>
                                <div class="col-7">
                                    <label class="font-weight-normal" id="description_view"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <buttn class="btn btn-info" data-dismiss="modal">Close</buttn>
            </div>
        </div>
    </div>
</div>
<!-- /.view modal -->

<!-- edit modal -->
<div class="modal fade" id="edit_modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('item.update') }}" class="form-horizontal">
                @csrf
                <div class="modal-body">
                    <div class="col">
                        <div class="card card-info mt-3">
                            <div class="card-header">
                                <div class="card-title">Edit Item Details</div>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-12">
                                        <!-- Item Code  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Item Code</label>
                                            </div>
                                            <div class="col-7"> 
                                                <input type="text" name="code_edit" id="code_edit" class="bg-white border border-white" readonly/>
                                            </div>
                                        </div>
                                        <!-- Item Name  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Item Name</label>
                                            </div>
                                            <div class="col-7"> 
                                                <input type="text" name="name_edit" id="name_edit" required="required" placeholder="Name" class="form-control form-control-sm"/>
                                            </div>
                                        </div>
                                        <!-- Measuting Unit  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Measuring Unit</label>
                                            </div>
                                            <div class="col-7"> 
                                                <select class="form-control form-control-sm" id="measuring_unit_edit" name="measuring_unit_edit" required>
                                                    <option value="">---SELECT---</option>
                                                    @isset( $measuring_units )
                                                        @foreach($measuring_units as $measuring_unit)
                                                            <option value="{{ $measuring_unit->id }}">{{$measuring_unit->name}}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Price  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Price (Rs)</label>
                                            </div>
                                            <div class="col-7"> 
                                                <input type="number" name="price_edit" id="price_edit" required="required" placeholder="Rupees" class="form-control form-control-sm"/>
                                            </div>
                                        </div>
                                        <!-- Description  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Description</label>
                                            </div>
                                            <div class="col-7"> 
                                                <textarea type="text" class="form-control form-control-sm" name="description_edit" id="description_edit" placeholder="Name, Brand, Volume" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <!-- Item Type -->
                                        <div class="form-group row"> 
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Item type</label>
                                            </div>
                                            <div class="col-7">
                                                <div class="form-group">
                                                    <label class="col-4">
                                                        <input type="radio" id="consumable_edit" name="item_type_edit" value="consumable" class="minimal">
                                                        <label class="font-weight-normal">Consumable</label>
                                                    </label>
                                                    <label class="col-4">
                                                        <input type="radio" id="asset_edit" name="item_type_edit" value="asset" class="minimal">
                                                        <label class="font-weight-normal">Asset</label>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- item id  -->
                                        <div class="form-group row">
                                            <input type="hidden" id="item_id" name="item_id" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal body  -->
                <!-- modal footer  -->
                <div class="modal-footer d-flex justify-content-center">
                    <div class="col-3">
                        <button type="submit" class="btn btn-info two-btn">Update</button>
                        <button type="button" class="btn btn-secondary two-btn" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal footer  -->
            </form>
            
        </div>
    </div>
</div>
<!-- /.edit modal -->

<!-- delete modal  -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-danger font-weight-bold">Deleting the item...!</h3>
            </div>
            <div class="modal-body">
                <p>If you continue, you will delete this item from the system. Are you sure to delete it?</p>
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

            var code = $('#code_view');
            var name = $('#name_view');
            var measuring_unit = $('#measuring_unit_view');
            var price = $('#price_view');
            var type = $('#type_view');
            var description = $('#description_view');

            var code_value = jsonObject.code;
            var name_value = jsonObject.name;
            var measuring_unit_value = jsonObject.measuring_unit.name;
            var price_value = jsonObject.price ;
            var type_value = jsonObject.is_consumable? 'Consumable' : 'Asset';
            var description_value = jsonObject.description;
            
            code.text(code_value);
            name.text(name_value);
            measuring_unit.text(measuring_unit_value);
            price.text(price_value);
            type.text(type_value);
            description.text(description_value);

            modalObject.modal().show();
            buttonObject.attr('disabled', false);
        });

        $('.btn-edit').on('click', function(event){
            event.preventDefault();
            var buttonObject = $( this );
            buttonObject.attr('disabled', true);
            var jsonObject = buttonObject.data('object');
            var modalObject = $('#edit_modal');

            var code = $('#code_edit');
            var name = $('#name_edit');
            var measuring_unit = $('#measuring_unit_edit option');
            var price = $('#price_edit');
            var description = $('#description_edit');
            var asset = $('#asset_edit');
            var consumable = $('#consumable_edit');
            var item_id = $('#item_id');

            var code_value = jsonObject.code;
            var name_value = jsonObject.name;
            var measuring_unit_value = jsonObject.measuring_unit.id;
            var price_value = jsonObject.price ;
            var type_value = jsonObject.is_consumable;
            var description_value = jsonObject.description;
            var item_id_value = jsonObject.id;

            code.val(code_value);
            name.val(name_value);
            price.val(price_value);
            description.val(description_value);
            item_id.val(item_id_value);

            $.each(measuring_unit, function(k, v){
                if(v.value == measuring_unit_value){
                    $(v).attr('selected', true);
                }else{
                    $(v).attr('selected', false);
                }
            });

            if(type_value){
                asset.attr('checked', false);
                consumable.attr('checked', true);
            }else{
                consumable.attr('checked', false);
                asset.attr('checked', true);

            }

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