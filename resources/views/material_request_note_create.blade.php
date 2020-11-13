@extends('layouts.home_layout')

@section('yield_contant')
<!-- Content Wrapper -->
<!-- -- div class="content-wrapper" -- -->


<!-- Main content -->

<section class="content">

<div>
    <br>
    <h2 class="ml-5">Create New Material Request Note</h2>
    <hr>
    <br>
</div>


<div class="card card-info">
    <!-- card-header -->
    <div class="card-header">
        <h3 class="card-title">Item Details</h3>
    </div>
    <!-- /.card-header -->
    
    <!-- card-body -->
    <div class="card-body">
        <!-- create material note form -->
        <form class="form-horizontal" action="{{ route('material_request_note.store') }}" method="post" autocomplete="off"> 
            @csrf
            <div class="col col-md-10 offset-md-1">
                <div class="form-row" id="form_body">
                    <div class="div col-6">
                        <!-- SRN Date -->
                        <div class="form-group row">
                            <label for="note_date" class="col col-auto col-sm-3 col-form-label">SRN Date</label>
                            <div class="col col-auto col-sm-8">
                                <input type="text" name="note_date" id="note_date" required="required" placeholder="yyyy-mm-dd" class="form-control form-control-sm daterange-picker"/>
                            </div>      
                        </div>
                        <!-- Site Name -->
                        <div class="form-group row">
                            <label for="site" class="col col-auto col-sm-3 col-form-label">Site Name</label>
                            <div class="col col-auto col-sm-8">
                                <select name="site" id="site" class="form-control form-control-sm w-100">
                                    <option value="">---SELECT---</option>
                                    @isset($sites)
                                        @foreach($sites as $site)
                                            <option value="{{$site->id}}">{{$site->name}}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>      
                        </div>
                        <!-- Is Urgent  -->
                        <div class="form-group row">
                            <label for="site" class="col col-auto col-sm-3 col-form-label">Urgent</label>
                            <div class="col col-auto col-sm-8">
                                <label class="col-5 p-0">
                                    <input type="radio" id="urgent" name="is_urgent" value="yes" class="minimal">
                                    Yes
                                </label>
                                <label class="col-5 p-0">
                                    <input type="radio" id="non_urgent" name="is_urgent" value="no" class="minimal">
                                    No
                                </label>
                            </div>      
                        </div>
                        <!-- Delivery Date -->
                        <div class="form-group row">
                            <label for="delivery_date" class="col col-auto col-sm-3 col-form-label">Delivery Date</label>
                            <div class="col col-auto col-sm-8">
                                <input type="text" name="delivery_date" id="delivery_date" required="required" placeholder="yyyy-mm-dd" class="form-control form-control-sm daterange-picker"/>
                            </div>      
                        </div>
                    </div>
                    <div class="div col-6">
                        <!-- Item Name -->
                        <div class="form-group row">
                            <label for="item" class="col col-auto col-sm-3 col-form-label">Item</label>
                            <div class="col col-auto col-sm-8">
                                <select name="item_id" id="item_id" required="required" class="form-control select2" style="width: 100%;">
                                    <option value="">---SELECT---</option>
                                    @isset($items)
                                        @foreach($items as $item)
                                            <option value="{{$item->id}}" data-object="{{ $item->toJson() }}">{{$item->name}}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>      
                        </div>
                        <!-- Quantity -->
                        <div class="form-group row">
                            <label for="quantity" class="col col-auto col-sm-3 col-form-label">Quantity</label>
                            <div class="col col-auto col-sm-8">
                                <div class="input-group">
                                    <input type="number" name="quantity" id="quantity" required="required" placeholder="Quantity" class="form-control form-control-sm" min="1"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text" name="quantity_measuring_unit_id" id="quantity_measuring_unit_id" style="height: 31px;"></span>
                                    </div>
                                </div>
                            </div>      
                        </div>
                        <div class="form-group row">
                            <label class="col col-auto col-sm-3 col-form-label">Estimated Cost</label>
                            <div class="col col-auto col-sm-8">
                                <input type="text" class="form-control-plaintext w-100" name="cost" id="cost" placeholder="Rupees" readonly="readonly">
                            </div>      
                        </div>
                        <div class="form-group row">
                            <label class="col col-auto col-sm-3 col-form-label">Description</label>
                            <div class="col col-auto col-sm-8">
                                <textarea type="text" class="form-control form-control-sm w-100" rows="4" name="description" id="description" placeholder="Description"></textarea>
                            </div>      
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4 col-sm-5">
                                <button type="submit" class="btn btn-sm btn-outline-info col-12" name="create"><b>Add</b></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </form>
        <!-- /.create material note form -->
    </div>
    <!-- /.card-body -->
 
</div>


</section>
<!-- /.content -->
<!-- -- /div -- -->
<!-- /.Content Wrapper -->
@endsection

@push('stack_script')
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
    
<script>
$(function(){
    //"use strict";
    
    $('#item_id').on("select2:select", function(event){
        var data = event.params.data;
        var elementObject = $( data.element );
        var dataObject = elementObject.data('object');
        var unit_price = dataObject.price;
        var quantity_measuring_unit_id = $("#quantity_measuring_unit_id");
        if( ( dataObject ) && ( dataObject.measuring_unit ) ){
            quantity_measuring_unit_id.text( dataObject.measuring_unit.name );
        }else{
            quantity_measuring_unit_id.text( null );
        }

        var quantity = $('#quantity');
        var cost = $('#cost');
        var total_cost = quantity.val()*unit_price;
        if(total_cost != 0){
            cost.val(total_cost.toLocaleString());
        }else{
            cost.val('');
        }

        quantity.on('focusout', function(){
            total_cost = quantity.val()*unit_price;
            if(total_cost != 0){
                cost.val(total_cost.toLocaleString());
            }else{
                cost.val('');
            }
        });
        quantity.on('focusin', function(){
            cost.val('');
        });
    });
    
    $('#item_id').on("select2:unselect", function(event){
        var quantity_measuring_unit_id = $("#quantity_measuring_unit_id");
        quantity_measuring_unit_id.text( null );
    });

    
    
});
</script>
@endpush