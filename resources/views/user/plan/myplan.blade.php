@extends('user.master')
@section('all')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">My Plan</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Plan Method </h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="table-light">
            
                            <tr>

        

                                <th>Name</th>
                                <th> Transaction Id</th>
                                <th> Invested Amount</th>
                                  <th>Amount Return </th>
                                <th>Start Date</th>
                                <th>Matured Date</th>
                                <th>Profit %</th>
                                <th>Duration</th>
                                <th>Status</th>

                                <!-- Add more columns as needed -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userPlans as $plan)
                            <tr>

                                <td>{{ $plan->plan->name }}</td>
                                <td>{{ $plan->transaction_id }}</td>
                                 <td>{{ $plan->amount }}</td>
                                <td>{{ $plan->amount + ($plan->amount * $plan->plan->profit_percentage / 100) }}</td>
                                <td>{{ $plan->start_date }}</td>
                                <td>{{ $plan->maturity_date }}</td>
                                <td>{{ $plan->plan->profit_percentage	 }}</td>
                                <td>{{ $plan->plan->duration_value }} {{ $plan->plan->duration_unit }}</td>
                                
                                <td>{{ $plan->status }}</td>

                                <!-- Add more columns as needed -->
                            </tr>
                            @endforeach
                        

                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>

<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Display evidence of payment, amount, and email here -->
                <p><strong>Amount:</strong> <span id="paymentAmount"></span></p>
                <p><strong>Email:</strong> <span id="userEmail"></span></p>
                <p><strong>Feedback:</strong> <span id="feedBack"></span></p>

            </div>
            <div class="modal-footer" id="modalFooter">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>


        </div>
    </div>
</div>



<script>
    function openPaymentModal( amount, userEmail,feedBack, depositId) {
        document.getElementById('paymentAmount').textContent = amount;
        document.getElementById('userEmail').textContent = userEmail;
        document.getElementById('feedBack').textContent = feedBack;
        // Set deposit ID as a data attribute on modalFooter
        document.getElementById('modalFooter').setAttribute('data-deposit-id', depositId);

        $('#paymentModal').modal('show');
    }


   
</script>


@endsection
