@extends('admin.master')
@section('all')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Wallet Data</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Wallet Data </h4>
        

    
    <!-- Display a form for creating a new wallet -->
    <form action="{{ route('wallets.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $wallet->id }}">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="form-group">
            <label for="min_amount">Min Amount</label>
            <input type="number" class="form-control" id="min_amount" name="min_amount">
        </div>
        <div class="form-group">
            <label for="max_amount">Max Amount</label>
            <input type="number" class="form-control" id="max_amount" name="max_amount">
        </div>
        <div class="form-group">
            <label for="charge">Charge</label>
            <input type="number" class="form-control" id="charge" name="charge">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>



                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>




        </div>
    </div>
</div>



@endsection
