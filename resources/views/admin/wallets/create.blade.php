@extends('admin.master')
@section('all')


<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Send Money </h4>
            <form action="{{ route('wallets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

           


                <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input name="name" class="form-control" type="text"   placeholder="Enter the name">
                </div>
            </div>

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                    <input name="address" class="form-control" type="text"   placeholder="Enter the receiver address">
                </div>
            </div>

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Min Amount</label>
                <div class="col-sm-10">
                    <input name="min_amount" class="form-control" type="number"   placeholder="Enter the receiver min_amount">
                </div>
            </div>
            <!-- end row --> 


            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Mix Amount</label>
                <div class="col-sm-10">
                    <input name="max_amount" class="form-control" type="number"   placeholder="Enter the max amount">
                </div>
            </div>
            <!-- end row --> 
            

            <!-- <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label"> Image </label>
                <div class="col-sm-10">
       <input name="image" class="form-control" type="file"  id="image">
                </div>
            </div>

              <div class="row mb-3">
                 <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                <div class="col-sm-10">
                    <img id="showImage" class="rounded avatar-lg" src="" alt="Card image cap">
                </div>
            </div> -->
            <!-- end row -->
                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Submit">
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



