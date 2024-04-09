@extends('user.master')
@section('all')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Kyc Settings </h4>

            <form method="POST" action="{{ route('kyc.upload') }}" enctype="multipart/form-data">
             @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

           

    <div class="row mb-3">
    <label for="document_type" class="col-sm-2 col-form-label">{{ __('Document Type') }}</label>
    <div class="col-sm-10">
        <select class="form-select @error('document_type') is-invalid @enderror" id="document_type" name="document_type" required>
            <option value="ID" {{ old('document_type') == 'ID' ? 'selected' : '' }}>{{ __('National ID') }}</option>
            <option value="Passport" {{ old('document_type') == 'Passport' ? 'selected' : '' }}>{{ __('Passport') }}</option>
            <option value="Driving License" {{ old('document_type') == 'Driving License' ? 'selected' : '' }}>{{ __('Driving License') }}</option>
        </select>
        @error('document_type')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

            <!-- end row --> 


          



            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">{{'Upload Document' }}</label>
                <div class="col-sm-10">
                <input name="document_file" class="form-control" type="file"  id="image">
                </div>
            </div>
            <!-- end row -->

              <div class="row mb-3">
                 <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                <div class="col-sm-10">
                    <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image))? url('kyc_documents/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap">
                </div>
            </div>
           
            <!-- end row --> 

                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Kyc">
            </form>



        </div>
    </div>
</div> <!-- end col -->
</div>



</div>
</div>



<script type="text/javascript">
    
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
