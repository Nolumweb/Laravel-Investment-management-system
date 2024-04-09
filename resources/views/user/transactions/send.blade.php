@extends('user.master')
@section('all')


<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Send Money </h4>
            <form method="POST" action="{{ route('user.send') }}">
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

                  <input type="hidden" name="transaction_type" value="transfer">
           

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Receiver email</label>
                <div class="col-sm-10">
                <input type="email" class="form-control" name="recipient_email" placeholder="Recipient Email" value="{{ old('recipient_email') }}" required>

                </div>
            </div>
            <!-- end row --> 


            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Amount</label>
                <div class="col-sm-10">
                    <input name="amount" class="form-control" step="0.01"  type="number" value="{{ old('amount') }}" required  placeholder="Enter the amount">
                </div>
            </div>
            <!-- end row --> 
            

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input name="password" class="form-control" type="password" required  placeholder="Enter your password">
                </div>
            </div>
            <!-- end row --> 



           
            <!-- end row --> 

                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Send Money">
            </form>



        </div>
    </div>
</div> <!-- end col -->
</div>



</div>
</div>

@endsection
