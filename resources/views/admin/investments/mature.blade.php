@extends('admin.master')
@section('all')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">All investment</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Withdrawal Method </h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="table-light">
                                
                            <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Plan</th>
                    <th>Amount</th>
                    <th>Start Date</th>
                    <th>Maturity Date</th>
                    <th>Date Created</th>
                    <th>Status</th>
                    <th>Action</th>
                    <!-- Add more columns if necessary -->
                </tr>
            </thead>
            <tbody>
                @foreach($investments as $investment)
                    <tr>
                    <td>{{ $investment->id }}</td>
                        <td>{{ $investment->user->name }}</td>
                        <td>{{ $investment->plan->name }}</td>
                        <td>{{ $investment->amount }}</td>
                        <td>{{ $investment->start_date }}</td>
                        <td>{{ $investment->maturity_date }}</td>
                        <td class="text-center">{{ $investment->created_at->format('D, j, Y') }} ({{ $investment->created_at->diffForHumans() }})</td>
                        <td class="text-center">
                            @if($investment->status == 'active')
                                <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i>Active</div>
                            @elseif($investment->status == 'matured')
                                <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Matured</div>
                            @elseif($investment->status == 'completed')
                                <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-secondary align-middle me-2"></i>Completed</div>
                            @endif
                        </td>



        <td>                                                                                                        
                <a href="#" class="btn btn-info sm" title="View Data" onclick="openPaymentModal( '{{ $investment->user->name }}', '{{ $investment->plan->name }}','{{ $investment->amount }}','{{ $investment->start_date }}','{{ $investment->maturity_date }}','{{ $investment->status }}','{{ $investment->created_at->format('D, j, Y') }} ({{ $investment->created_at->diffForHumans() }})', '{{ $investment->id }}')"><i class="fas fa-eye"></i></a>
        </td>
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
                <h5 class="modal-title" id="paymentModalLabel">Investment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Display evidence of payment, amount, and email here -->
                <p><strong>User:</strong> <span id="User"></span></p>
                <p><strong>Plan:</strong> <span id="Plan"></span></p>
                <p><strong>Amount:</strong> <span id="Amount"></span></p>
                <p><strong>Start Date:</strong> <span id="Start_Date"></span></p>
                <p><strong>Maturity Date:</strong> <span id="Maturity_Date"></span></p>
                <p><strong>Status:</strong> <span id="Status"></span></p>
                <p><strong>Date Created:</strong> <span id="Date_Created"></span></p>
            </div>
            <div class="modal-footer" id="modalFooter">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



        </div>
    </div>
</div>



    <script>


    function openPaymentModal(User, Plan, Amount, Start_Date, Maturity_Date, Status, Date_Created) {
    // Sanitize user-provided data
    User = $('<div>').text(User).html(); // Escape HTML entities
    Plan = $('<div>').text(Plan).html();
    Amount = $('<div>').text(Amount).html();
    Start_Date = $('<div>').text(Start_Date).html();
    Maturity_Date = $('<div>').text(Maturity_Date).html();
    Status = $('<div>').text(Status).html();
    Date_Created = $('<div>').text(Date_Created).html();

    // Set the sanitized data to modal elements
    document.getElementById('User').textContent = User;
    document.getElementById('Plan').textContent = Plan;
    document.getElementById('Amount').textContent = Amount;
    document.getElementById('Start_Date').textContent = Start_Date;
    document.getElementById('Maturity_Date').textContent = Maturity_Date;
    document.getElementById('Status').textContent = Status;
    document.getElementById('Date_Created').textContent = Date_Created;

    $('#paymentModal').modal('show');
}

</script>

   

@endsection
