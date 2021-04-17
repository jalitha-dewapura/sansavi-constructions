@extends('layouts.home_layout')

@section('yield_contant')
<!-- Content Wrapper -->
<!-- -- div class="content-wrapper" -- -->


<!-- Main content -->

<section class="content">

<div>
    <br>
    <h2 class="ml-5">Create New Site</h2>
    <hr>
    <br>
</div>


<div class="card card-info">
    <!-- card-header -->
    <div class="card-header">
        <h3 class="card-title">Site Details</h3>
    </div>
    <!-- /.card-header -->
    
    <!-- card-body -->
    <div class="card-body">
        <!-- create site form -->
        <form class="form-horizontal" action="{{route('site.store')}}" method="post" autocomplete="off"> 
            @csrf
            <!-- Site Name -->
            <div class="form-group row d-flex justify-content-center">
                <label class="col-md-3 col-form-label">
                    Site Name
                    @if( $errors->has('name') )
                        <span style="color:red;">*</span>
                    @endif
                </label>
                <div class="col-md-6">
                    <input type="text" class="w-100" name="name" placeholder="Site Name" value="{{ old('name') }}" >
                </div>
            </div>     
            <!-- Select Province -->
            <div class="form-group row d-flex justify-content-center">
                <label class="col-md-3 col-form-label">
                    Select Province
                    @if( $errors->has('province') )
                        <span style="color:red;">*</span>
                    @endif
                </label>
                <div class="col-md-6">
                    <select class="w-100" id="province" name="province" >
                        <option value="">---SELECT---</option> 
                        @isset( $provinces )
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}" {{ (old('province') == $province->id) ? 'selected': null }}> {{$province->name}} </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            <!-- Select District -->
            <div class="form-group row d-flex justify-content-center">
                <label class="col-md-3 col-form-label">
                    Select District
                    @if( $errors->has('district') )
                        <span style="color:red;">*</span>
                    @endif
                </label>
                <div class="col-md-6">
                    <select class="w-100" id="district" name="district">
                        <option value="">---SELECT---</option> 
                        @isset( $districts )
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" {{ (old('district') == $district->id) ? 'selected': null }}> {{$district->name}} </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            <!-- Construction Started Date -->
            <div class="form-group row d-flex justify-content-center"> 
                <label class="col-md-3 col-form-label">
                    Construction Started Date
                    @if( $errors->has('started_date') )
                        <span style="color:red;">*</span>
                    @endif
                </label>
                <div class="col-md-6">
                    <input type="text" class="w-100" name="started_date" id="started_date" placeholder="yyyy-mm-dd" value="{{ old('started_date') }}">
                </div>
            </div>
            <!-- Select Purchasing Officer -->
            <div class="form-group row d-flex justify-content-center">
                <label class="col-md-3 col-form-label">
                    Select Purchasing Officer
                    @if( $errors->has('po_id') )
                        <span style="color:red;">*</span>
                    @endif
                </label>
                <div class="col-md-6">
                    <select class="w-100" id="po_id" name="po_id">
                        <option value="">---SELECT---</option> 
                        @isset( $purchasing_officers )
                            @foreach($purchasing_officers as $purchasing_officer)
                                <option value="{{ $purchasing_officer->id }}" {{ (old('po_id') == $purchasing_officer->id) ? 'selected': null }}> {{$purchasing_officer->name}} </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            <!-- Select Project Manager -->
            <div class="form-group row d-flex justify-content-center">
                <label class="col-md-3 col-form-label">
                    Select Project Manager
                    @if( $errors->has('pm_id') )
                        <span style="color:red;">*</span>
                    @endif
                </label>
                <div class="col-md-6">
                    <select class="w-100" id="pm_id" name="pm_id">
                        <option value="">---SELECT---</option> 
                        @isset( $project_managers )
                            @foreach($project_managers as $project_manager)
                                <option value="{{ $project_manager->id }}" {{ (old('pm_id') == $project_manager->id) ? 'selected': null }}> {{$project_manager->name}} </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            <!-- Select Quantity Surveyor -->
            <div class="form-group row d-flex justify-content-center">
                <label class="col-md-3 col-form-label">
                    Select Quantity Surveyor
                    @if( $errors->has('qs_id') )
                        <span style="color:red;">*</span>
                    @endif
                </label>
                <div class="col-md-6">
                    <select class="w-100" id="qs_id" name="qs_id">
                        <option value="">---SELECT---</option> 
                        @isset( $quantity_surveyors )
                            @foreach($quantity_surveyors as $quantity_surveyor)
                                <option value="{{ $quantity_surveyor->id }}" {{ (old('qs_id') == $quantity_surveyor->id) ? 'selected': null }}> {{$quantity_surveyor->name}} </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            <!-- Select Stock Keeper -->
            <div class="form-group row d-flex justify-content-center">
                <label class="col-md-3 col-form-label">
                    Select Stock Keeper
                    @if( $errors->has('sk_id') )
                        <span style="color:red;">*</span>
                    @endif
                </label>
                <div class="col-md-6">
                    <select class="w-100" id="sk_id" name="sk_id">
                        <option value="">---SELECT---</option> 
                        @isset( $stock_keepers )
                            @foreach($stock_keepers as $stock_keeper)
                                <option value="{{ $stock_keeper->id }}" {{ (old('sk_id') == $stock_keeper->id) ? 'selected': null }}> {{$stock_keeper->name}} </option>
                            @endforeach
                        @endisset
                    </select>
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
        <!-- /.create site form -->
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

$(function () {
    //Date picker
    $('#started_date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
          format: 'YYYY-MM-DD'
        },
    }).val('');

    $('#province').change(function(){
        var province_id =  $(this).val();
        var district_form = $('#district');
        $.get('http://localhost:8000/districts?province_id='+province_id, function( data ){
            district_form.empty();
            var option = $("<option>");
            option.attr("value", "");
            option.text( "---SELECT---" );
            district_form.append( option );
            $.each(data, function(key, value){
                option = $("<option>");
                option.attr("value", value.id);
                option.text( value.name );
                district_form.append( option );
            });
        })
    });
})
</script>

@endpush