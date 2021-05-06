@extends('layouts.home_layout')


@section('yield_contant')
<!-- Content Wrapper -->
<!-- -- div class="content-wrapper" -- -->


<!-- Main content -->
<section class="content">

<div class="container">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 mt-lg-4 mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h3 class="mb-0 text-gray-800">Welcome back, {{auth()->user()->name}}</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="row h-100">
                <div class="card col-11">
                    <div class="card-body">
                        <h4 class="font-weight-bold">User Profile</h4>
                        <div class="col-12 mb-3 d-flex justify-content-center">
                            <img class="profile-image"  src="/img/avatar5.png">
                        </div>
                        <div class="col-12 mb-3 d-flex justify-content-center">
                            <h4>{{auth()->user()->name}}</h4>
                        </div>
                        <div class="col-12 mb-3 d-flex justify-content-start">
                            <div class="col-5">
                                <p>Designation : </p>
                                <p>Email : </p>
                                <p>Phone Number : </p>
                            </div>
                            <div class="col-6">
                                <!-- taking the user role  -->
                                @if(auth()->user()->user_role_id == 1)
                                    <p>Super User</p>  
                                @elseif(auth()->user()->user_role_id == 2)
                                    <p>Purchasing Officer</p>  
                                @elseif(auth()->user()->user_role_id == 3)
                                    <p>Project Manager</p>  
                                @elseif(auth()->user()->user_role_id == 4)
                                    <p>Quantity Surveyor</p>  
                                @elseif(auth()->user()->user_role_id == 5)
                                    <p>Stock Keeper</p>  
                                @elseif(auth()->user()->user_role_id == 6)
                                    <p>HR Officer</p>  
                                @else
                                    <p></p>
                                @endif
                                <p>{{auth()->user()->email}}</p>
                                <p>{{auth()->user()->phone}}</p>
                            </div>
                        </div>

                        <div class="col-12 mt-5 mb-3 d-flex justify-content-center">
                            <button class="btn btn-info m-2 btn-edit"  data-object="{{ auth()->user() }}" data-toggle="modal" data-target="#edit_user_modal">Update Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row ">
                <div class="light">
                    <div class="calendar">
                        <div class="calendar-header">
                            <span class="month-picker" id="month-picker">February</span>
                            <div class="year-picker">
                            <span class="year-change" id="prev-year">
                                <pre><</pre>
                            </span>
                            <span id="year">2021</span>
                            <span class="year-change" id="next-year">
                                <pre>></pre>
                            </span>
                            </div>
                        </div>
                        <div class="calendar-body">
                        <div class="calendar-week-day">
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>
                        <div class="calendar-days"></div>
                    </div>
                        <!-- <div class="calendar-footer">
                            <div class="toggle">
                                <span>Dark Mode</span>
                                <div class="dark-mode-switch">
                                    <div class="dark-mode-switch-ident"></div>
                                </div>
                            </div>
                        </div> -->
                        <div class="month-list"></div>
                </div>
                </div>
            </div>
            <!-- <div class="row dashboard-grid">
                <h1>Something</h1>
            </div> -->
        </div>
    </div>
</div>


</section>
<!-- /.content -->
<!-- -- /div -- -->
<!-- /.Content Wrapper -->




<!-- edit user modal  -->
<div class="modal fade" id="edit_user_modal">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <form action="{{route('user.update')}}" method="post" class="form-horizontal">
                @csrf
                <div class="modal-body">
                    <div class="col">
                        <div class="card card-info mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Edit User Profile</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-12">
                                        <!-- Name  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Name</label>
                                            </div>
                                            <div class="col-7"> 
                                                <input type="text" name="name_edit" id="name_edit" required="required" class="form-control form-control-sm"/>
                                            </div>
                                        </div>
                                        <!-- Phone -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Phone Number</label>
                                            </div>
                                            <div class="col-7"> 
                                                <input type="text" name="phone_edit" id="phone_edit" required="required" pattern="[0-9]{10}" class="form-control form-control-sm"/>
                                            </div>
                                        </div>
                                        <!-- Email  -->
                                        <div class="form-group row">
                                            <div class="col-5">
                                                <label  class="font-weight-normal">Email</label>
                                            </div>
                                            <div class="col-7"> 
                                                <input type="email" name="email_edit" id="email_edit" required="required" class="form-control form-control-sm"/>
                                            </div>
                                        </div>
                                        <!-- user id  -->
                                        <div class="form-group row">
                                            <input type="hidden" id="user_id_edit" name="user_id_edit" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- card body  -->
                        </div>
                        <!-- card  -->
                    </div>     
                </div>
                <!-- modal body  -->
                <div class="modal-footer d-flex justify-content-center">
                    <div class="col-6">
                        <button type="submit" class="btn btn-info">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.edit modal  -->


@endsection



@push('stack_script')

<script>
    $(function () {

        $('.btn-edit').on('click', function(event){
            event.preventDefault();
            var buttonObject = $( this );
            buttonObject.attr('disabled', true);
            var jsonObject = buttonObject.data('object');
            var modalObject = $('#edit_user_modal');
            
            var name_value = jsonObject.name;
            var phone_value = jsonObject.phone;
            var email_value = jsonObject.email;
            var user_id_value = jsonObject.id;

            var name = $("#name_edit");
            var phone = $("#phone_edit");
            var email = $("#email_edit");
            var user_id = $("#user_id_edit");
            console.log(user_id_value);
            name.val(name_value);
            phone.val(phone_value);
            email.val(email_value);
            user_id.val(user_id_value);

            modalObject.modal().show();
            buttonObject.attr('disabled', false);
            
        });
    });
    
</script>
<script src="{!! asset('js/calendar.js') !!}"></script>
    
@endpush