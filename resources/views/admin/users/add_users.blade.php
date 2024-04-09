@extends('admin.master')
@section('all')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Users Page </h4><br><br>




                <form method="post" action="{{ route('user.store') }}" id="myForm" >
                    @csrf

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Name </label>
                    <div class="form-group col-sm-10">
                        <input name="name" class="form-control" type="text"    >
                    </div>
                </div>
                <!-- end row -->
                  <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Username </label>
                    <div class="form-group col-sm-10">
                        <input name="username" class="form-control" type="text"    >
                    </div>
                </div>
                <!-- end row -->
      <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Email </label>
                    <div class="form-group col-sm-10">
                        <input name="email" class="form-control  @error('email') is-invalid @enderror" type="email"  >

                        @error('email')
                        <div class="invalid-feedback "><h6 class="text-danger">{{ $message }}</h6></div>
                        @enderror
                    </div>
                </div>



                <!-- end row -->
      <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Password </label>
                    <div class="form-group col-sm-10">
                        <input name="password" class="form-control" type="text"  >
                    </div>
                </div>
                <!-- end row -->



    <input type="submit" class="btn btn-info waves-effect waves-light" value="Add User">
                </form>



            </div>
        </div>
    </div> <!-- end col -->
    </div>

    </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                name: {
                    required : true,
                },
               username: {
                    required : true,
                },
                 email: {
                    required : true,
                },
                 password: {
                    required : true,
                },

            },
            messages :{
                name: {
                    required : 'Please Enter Your Name',
                },
              username: {
                    required : 'Please Enter Your Username',
                },
                email: {
                    required : 'Please Enter Your Email',
                },
                password: {
                    required : 'Please Enter Your Password',
                },

            },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });

    </script>

    @endsection
