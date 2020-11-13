@extends('layouts.home_layout')

@section('yield_contant')
<!-- Content Wrapper -->
<!-- -- div class="content-wrapper" -- -->


<!-- Main content -->

<section class="content">

<div>
    <br>
    <h2 class="ml-5">Add New User</h2>
    <hr>
    <br>
</div>


<div class="card card-info">
    <!-- card-header -->
    <div class="card-header">
        <h3 class="card-title">User Details</h3>
    </div>
    <!-- /.card-header -->
    
    <!-- card-body -->
    <div class="card-body">
        <!-- add user form -->
        <form class="form-horizontal" method="post" action="{{route('user.store')}}" autocomplete="off"> 
            @csrf
            <!-- Select User Role -->
            <div class="form-group row d-flex justify-content-center">
                <label class="col-md-3 col-form-label">
                    Select User Role
                    @if( $errors->has('user_role_id') )
                        <span style="color:red;">*</span>
                    @endif
                </label>
                <div class="col-md-6">
                    <select class="w-100" id="user_role_id" name="user_role_id" required>
                        <option value="">---SELECT---</option> 
                        @isset( $user_roles )
                            @foreach($user_roles as $user_role)
                                <option value="{{ $user_role->id }}" {{ (old('user_role_id') == $user_role->id) ? 'selected': null }}> {{$user_role->name}} </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            <!-- Full Name -->
            <div class="form-group row d-flex justify-content-center">
                <label class="col-md-3 col-form-label">
                    Full Name
                    @if( $errors->has('name') )
                        <span style="color:red;">*</span>
                    @endif
                </label>
                <div class="col-md-6">
                    <input type="text" class="w-100" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                </div>
            </div>     
            <!-- Username -->
            <div class="form-group row d-flex justify-content-center"> 
                <label class="col-md-3 col-form-label">
                    Username
                    @if( $errors->first('username') == "The username field is required.")
                        <span style="color:red;">*</span>
                    @endif
                </label>
                <div class="col-md-6">
                    <input type="text" class="w-100" name="username" id="username" placeholder="user_name" value="{{ old('username') }}" required>
                    @if( $errors->first('username') == "The username has already been taken." )
                        <br>
                        <span style="color:red; font-size:12px;">{{$errors->first('username')}}</span>
                    @endif
                </div>
            </div>
            <!-- Email Address -->
            <div class="form-group row d-flex justify-content-center"> 
                <label class="col-md-3 col-form-label">
                    Email Address
                    @if( $errors->has('email') )
                        <span style="color:red;">*</span>
                    @endif
                </label>
                <div class="col-md-6">
                    <input type="email" class="w-100" name="email" id="email" placeholder="user@example.com" value="{{ old('email') }}" required>
                    @if( $errors->first('username') == "The username has already been taken." )
                        <br>
                        <span style="color:red; font-size:12px;">{{$errors->first('username')}}</span>
                    @endif
                </div>
            </div>
            <!-- Phone Number -->
            <div class="form-group row d-flex justify-content-center"> 
                <label class="col-md-3 col-form-label">
                    Phone Number
                </label>
                <div class="col-md-6">
                    <input type="text" class="w-100" name="phone" id="phone" placeholder="07xxxxxxxx" value="{{ old('phone') }}">
                </div>
            </div>
            <!-- Password -->
            <div class="form-group row d-flex justify-content-center"> 
                <label class="col-md-3 col-form-label">
                    Password
                    @if( $errors->has('password') )
                        <span style="color:red;">*</span>
                    @endif
                </label>
                <div class="col-md-6">
                    <input type="text" class="w-100" name="password" id="password" placeholder="Default Passward" value="{{ old('password') }}" required>
                </div>
            </div>
            <br>
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