@extends('admin.master')
@section('all')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">





   </b>
    <div class="row">
        <div class="col-10 offset-1   justify-content-center">
            <div class="card">
                <div class="card-body">
                    <b><h4 class="card-title">New Ticket</h4>
                    <p class="card-title-desc text-primary text-center"> Customer Support Form.</p>


                    <form method="post" action="{{ route('sup.reply', $ticket->id) }}" enctype="multipart/form-data" id="myForm" >
                        @csrf

                         
                         <div class="mb-3">
						 <div class="md-3 form-group">
                            <label >{{ __("Select Images For Attachment") }} <span class="text-danger"><b>*</b></span></label>
                                <div class="custom-file">
                                    <input type="file" class="form-control"  id="customFileLang" name="image" accept="image/*" multiple required>
                                </div>
                            </div>
                        </div>



                        <div class="mb-3">
                            <label>{{ __('Description In Details') }}<span class="text-danger"><b>*</b></span></label>
                                <textarea required class="form-control" type="text" id ="details" name="message" rows="8" placeholder="Full Details" required></textarea>
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
             

                image: {
                    required : false,
                },

                details: {
                    required : true,
                },

            },


            messages :{
            

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
