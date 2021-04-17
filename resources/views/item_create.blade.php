@extends('layouts.home_layout')

@section('yield_contant')
<!-- Content Wrapper -->
<!-- -- div class="content-wrapper" -- -->


<!-- Main content -->

<section class="content">

<div>
    <br>
    <h2 class="ml-5">Create New Item</h2>
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
        <!-- create item form -->
        <form class="form-horizontal" action="{{ route('items.store') }}" method="post" autocomplete="off"> 
            @csrf
            <!-- Item Code -->
            <div class="form-group row d-flex justify-content-center">
                <label class="col-md-3 col-form-label">
                    Item Code
                </label>
                <div class="col-md-6">
                    @isset( $item_code )
                        <input type="text" class="w-100 bg-white border border-white" value={{$item_code}} disabled> 
                    @endisset
                </div>
            </div>
            <!-- Item Name -->
            <div class="form-group row d-flex justify-content-center">
                <label class="col-md-3 col-form-label">
                    Item Name
                    @if( $errors->has('name') )
                        <span style="color:red;">*</span>
                    @endif
                </label>
                <div class="col-md-6">
                    <input type="text" class="w-100 form-control form-control-sm" name="name" placeholder="Item Name" value="{{ old('name') }}" required>
                </div>
            </div>     
            <!-- Measuring Units -->
            <div class="form-group row d-flex justify-content-center"> 
                <label class="col-md-3 col-form-label">
                    Measuring Unit
                    @if( $errors->has('measuring_unit_id') )
                        <span style="color:red;">*</span>
                    @endif
                </label>
                <div class="col-md-6">
                    <select class="w-100 form-control form-control-sm" id="measuring_unit_id" name="measuring_unit_id" required>
                        <option value="">Select...</option> 
                        @isset( $measuring_units )
                            @foreach($measuring_units as $measuring_unit)
                                <option value="{{ $measuring_unit->id }}" {{ (old('measuring_unit_id') == $measuring_unit->id) ? 'selected': null }}> {{$measuring_unit->name}} </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            <!-- Price -->
            <div class="form-group row d-flex justify-content-center"> 
                <label class="col-md-3 col-form-label">
                    Price (Rs)
                    @if( $errors->has('price'))
                        <span style="color:red;">*</span>
                    @endif
                </label>
                <div class="col-md-6">
                    <input type="number" step="0.01" class="w-100 form-control form-control-sm" name="price" id="price" placeholder="Rupees" value="{{ old('price') }}" required>
                </div>
            </div>
            <!-- Description -->
            <div class="form-group row d-flex justify-content-center"> 
                <label class="col-md-3 col-form-label">
                    Description
                </label>
                <div class="col-md-6">
                    <textarea type="text" class="w-100 form-control form-control-sm" name="description" id="description" placeholder="Name, Brand, Volume" rows="3">{{ old('description') }}</textarea>
                </div>
            </div>
            <!-- Item Type -->
            <div class="form-group row d-flex justify-content-center"> 
                <label class="col-md-3 col-form-label">
                    Select type
                </label>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-3">
                            <input type="radio" id="consumable" name="item_type" value="consumable" class="minimal" checked>
                            Consumable
                        </label>
                        <label class="col-3">
                            <input type="radio" id="asset" name="item_type" value="asset" class="minimal">
                            Asset
                        </label>
                    </div>
                </div>
            </div>
            <!-- Footer Buttons -->
            <div class="row d-flex justify-content-center">
                <div class="col-lg-1 col-md-2 col-sm-3">
                    <button type="submit" class="btn btn-outline-info col-12" name="create"><b>Create</b></button>
                </div>
                <div class="col-lg-1 col-md-2 col-sm-3">
                    <button type="reset" class="btn btn-outline-secondary col-12" name="reset"><b>Reset</b></button>
                </div>
                <div class="col-lg-7"></div>

            </div>
            <br>
        </form>
        <!-- /.add hospital form -->
    </div>
    <!-- /.card-body -->
 
</div>


</section>
<!-- /.content -->
<!-- -- /div -- -->
<!-- /.Content Wrapper -->
@endsection