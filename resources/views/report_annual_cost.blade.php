@extends('layouts.home_layout')

@section('yield_contant')
<!-- Content Wrapper -->
<!-- -- div class="content-wrapper" -- -->


<!-- Main content -->
<section class="content">
<div>
    <br>
    <h2 class="ml-5">Annual Material Cost of The Company</h2>
    <hr>
    <br>
</div>
<div class="container-fluid">

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">Report Details</h3>
                </div>
                <!-- /.card-header -->
                <!-- /.card-body -->
                <div class="card-body">
                    <form class="form-horizontal" action="{{route('report_annual_cost.generate')}}" method="post" autocomplete="off"> 
                        @csrf
                        
                        <div class="form-group row d-flex justify-content-center">
                            <label class="col-md-3 col-form-label">
                                Select Year
                            </label>
                            <div class="col-md-4">
                                <select class="w-100" id="year" name="year" required>
                                    <option value="">---SELECT---</option> 
                                    @isset( $current_year )
                                        @for($i = 0; $i < 5; $i++)
                                            <option value="{{ $current_year - $i }}"> {{$current_year - $i}} </option>
                                        @endfor
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <button type="submit" class="btn btn-outline-info col-12" name="generate"><b>Generate Report</b></button>
                            </div>
                            <div class="col-lg-5 col-md-4 col-sm-3"></div>
                        </div>
                    </form>    
                </div>
            </div> 
        </div>
</div>
<!-- /.container-fluid -->
                  

</section>

@endsection


@push('stack_script')

@endpush