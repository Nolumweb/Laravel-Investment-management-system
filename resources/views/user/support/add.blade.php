@extends('user.master')
@section('all')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="page-content">
<div class="container-fluid">





   
    <div class="row">
        <div class="col-10 offset-1   justify-content-center">
            <div class="card">
                <div class="card-body">
                    <b><h4 class="card-title">New Ticket</h4>
                    <p class="card-title-desc text-primary text-center">Fill in and submit your ticket. One of our IT engineers will get back to you as soon as possible.</p>


                    <form method="post" action="{{ route('store.support') }}" enctype="multipart/form-data" id="myForm" >
                        @csrf



        <div class="mb-3">
            <label>{{ __("Subject") }}<span class="text-danger"><b>*</b></span></label>
            <div>
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject Goes Here" required/>
            </div>
        </div>


                        <div class="mb-3">
                            <label  >{{ __("Short Description") }}<span class="text-danger"><b>*</b></span></label>
                            <input type="text" name="short_msg" id="short_msg" class="form-control" required placeholder="Short Description" required/>
                        </div>

                        <div class="mb-3">
                            <label >{{__('Device Name') }}<span class="text-danger"><b>*</b></span> </label>
                            <div>
                                <select class="form-select" name="device" aria-label="Default select example">
                                    <option selected="device"  >{{ __('Others') }}</option>
                                    @foreach($device as $p)
                                    <option value="{{ $p->brand }}"  >{{ $p->brand }} </option>
                                   @endforeach
                                    </select>
                            </div>
                        </div>





                        <div class="mb-3">
            <div class="md-3 form-group">
                <label for="example-text-input" class="form-label">{{ __(" Date Of Issue") }}<span class="text-danger"><b>*</b></span></label>
                 <input class="form-control e   Subject-input" name="checkin_date" type="date"  id="start_date" placeholder="YY-MM-DD" required/>
            </div>
        </div>


                        @if ($errors->has('image'))
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                       
            <div class="mb-3">
			 <div >
                <label >{{ __("Select Images For Attachment") }} </label>
                    <div class="custom-file">
                        <input type="file" class="form-control"  id="customFileLang "
                            name="image" accept="image/*" multiple>
                    </div>
                </div>
            </div>



                        <div class="mb-3">
                            <label>{{ __('Description In Details') }}<span class="text-danger"><b>*</b></span></label>
                                <textarea required class="form-control" type="text" id ="message" name="message" rows="8" placeholder="Full Details" required></textarea>
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

                message: {
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
                
                message: {
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
