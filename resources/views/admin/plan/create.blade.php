@extends('admin.master')
@section('all')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Plans Page </h4><br><br>


    

                    <form method="POST" action="{{ route('plan.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                      

                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <div class="row">
                                <div class="col">
                                    <input type="number" name="duration_value" id="duration_value" class="form-control" required>
                                </div>
                                <div class="col">
                                    <select name="duration_unit" id="duration_unit" class="form-control" required>
                                        <option value="hours">Hours</option>
                                        <option value="days">Days</option>
                                        <option value="weeks">Weeks</option>
                                        <option value="months">Months</option>
                                        <option value="years">Years</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="profit_percentage">Profit Percentage</label>
                            <input type="number" name="profit_percentage" id="profit_percentage" class="form-control" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label for="min_amount">Minimum Amount</label>
                            <input type="number" name="min_amount" id="min_amount" class="form-control" step="0.01">
                        </div>

                        <div class="form-group">
                            <label for="max_amount">Maximum Amount</label>
                            <input type="number" name="max_amount" id="max_amount" class="form-control" step="0.01">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
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
