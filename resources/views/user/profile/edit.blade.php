@extends('user.master')
@section('all')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Edit Profile Page </h4>
            <form method="post" action="{{ route('store.profile') }}" enctype="multipart/form-data" id="myForm" >
                @csrf

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Firstname</label>
                <div class="col-sm-10">
                    <input name="firstname" class="form-control" type="text" value="{{ $editData->firstname }}">
                </div>
            </div>
            <!-- end row -->


              <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Lastname</label>
                <div class="col-sm-10">
                    <input name="lastname" class="form-control" type="text" value="{{ $editData->lastname }}">
                </div>
            </div>
            <!-- end row -->



              <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">User Email</label>
                <div class="col-sm-10">
                    <input name="email" class="form-control" type="text" value="{{ $editData->email }}">
                </div>
            </div>
            <!-- end row -->


              <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">UserName</label>
                <div class="col-sm-10">
                    <input name="username" class="form-control" type="text" value="{{ $editData->username }}">
                </div>
            </div>
            <!-- end row -->

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Mobile Number</label>
                <div class="col-sm-10">
                    <input name="phone" class="form-control" type="number" value="{{ $editData->phone }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">State</label>
                <div class="col-sm-10">
                    <input name="state" class="form-control" type="text" value="{{ $editData->state }}">
                </div>
            </div>


            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Country</label>
                <div class="col-sm-10">
                    <input name="country" class="form-control" type="text" value="{{ $editData->country }}">
                </div>
            </div>








            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Profile Image </label>
                <div class="col-sm-10">
       <input name="profile_image" class="form-control" type="file"  id="image">
                </div>
            </div>
            <!-- end row -->

              <div class="row mb-3">
                 <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                <div class="col-sm-10">
                    <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image))? url('upload/user_images/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap">
                </div>
            </div>
            <!-- end row -->
<input type="submit" class="btn btn-info waves-effect waves-light" value="Update Profile">
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

                    firstname: {
                    required : true,
                },

                lastname: {
                    required : true,
                },

                 username: {
                    required : true,
                },
                 email: {
                    required : true,
                },



            },
            messages :{
                firstname: {
                    required : 'Please Enter Your Firstname',
                },
                 laststname: {
                    required : 'Please Enter Your Lastname',
                },


                username: {
                    required : 'Please Enter Your Username',
                },
                email: {
                    required : 'Please Enter Your Email',
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


    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>


@endsection
