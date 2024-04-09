@extends('user.master')
@section('all')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Edit Ticket Page </h4><br><br>

            <form method="post" action="{{ route('update.support') }}" id="myForm" enctype="multipart/form-data" >
                @csrf
<input type="hidden" name="id" value="{{ $data->id }}">




                <div class="mb-"3">
				 <div>
                    <label>{{ __("Subject") }}<span class="text-danger"><b>*</b></span></label>
                    <div>
                        <input type="text" class="form-control" name="subject" value="{{ $data->subject }}">
                    </div>
                </div>


            <div class="mb-3">
			  <div>
                <label  >{{ __("Short Description") }}<span class="text-danger"><b>*</b></span></label>
                <input type="text" name="short_msg" class="form-control" value="{{ $data->short_msg }}">
            </div>
  </div>
		
		   <div class="mb-3">
			  <div>
                <label  >{{ __("Device") }}<span class="text-danger"><b>*</b></span></label>
                <input type="text" name="device" class="form-control" value="{{ $data->device }}">
            </div>
  </div>
		
		

                <div class="mb-3">
                    <div>
                        <label for="example-text-input" class="form-label">{{ __("Date of Issue") }}<span class="text-danger"><b>*</b></span></label>
                         <input class="form-control" name="checkin_date" type="date" value="{{ $data->checkin_date }}" >
                    </div>
                </div>


                        @if ($errors->has('image'))
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
            <div class="mb-3">
			 <div >
                <label >{{ __("Select Images For Attachment") }} </label>
              
                    <div class="custom-file">
                        <input type="file" class="form-control"  id="customFileLang"
                            name="image" accept="image/*">
                    </div>
                </div>
            </div>



                <div class="mb-3">
                    <label>{{ __('Description In Details') }}<span class="text-danger"><b>*</b></span></label>
                    
                        <textarea required class="form-control" type="text" name="details" rows="8" value="{{ $data->details }}">{{ $data->details }}</textarea>
                </div>


                                <div class="mb-0 text-center">
                                    <div>
                            <button type="submit " class="btn btn-primary waves-effect waves-light me-1 ">Submit </button>
                            <a href=" {{ URL::previous() }}"  type="reset" class="btn btn-secondary waves-effect ">Cancel </a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->



         </div>
        </div>


        <script type="text/javascript">
            $(document).ready(function (){
                $('#myForm').validate({
                    rules: {
                        subject: {
                            required : true,
                        },
                         short_msg: {
                            required : true,
                        },

                        device: {
                            required : true,
                        },

                        checkin_date: {
                            required : true,
                        },


                        image: {
                            required : false,
                        },

                        details: {
                            required : true,
                        },

                    },


                    messages :{
                        subject: {
                            required : ' Subject Can Not Be Empty ',
                        },

                        short_msg : {
                            required : 'Short Description Can Not Be Empty',
                        },

                        device : {
                            required : 'Device Name Can Not Be Empty',
                        },

                        checkin_date: {
                            required : '',
                        },

                        image: {
                            required : 'Image Can Not Be Empty',
                        },
                        details: {
                            required : ' Description Can Not Be Empty',
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
