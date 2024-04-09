@extends('user.master')
@section('all')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">All Commission Bonus</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Commission  </h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th>Sn</th>
                                    <th>Transaction Id</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Date Of Created</th>
                                    <th>Status</th>
                                    <th>Actions</th> <!-- Added column for actions -->
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($transaction as $key => $item)
    <tr>
        <td>{{ $key+1 }}</td>
        <td class="text-center">{{ $item->transaction_id }}</td>
        <td class="text-center">{{ $item->amount }}</td>
        <td class="text-center">{{ $item->type }}</td>


        <td class="text-center">{{ $item->created_at->format('D, j, Y, h:i A') }}</td>
        <td class="text-center">
            @if($item->status == 'pending')
                <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i>Pending</div>
            @elseif($item->status == 'completed')
                <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Approved</div>
            @elseif($item->status == 'failed')
                <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-danger align-middle me-2"></i>Rejected</div>
            @endif
        </td>
        <td>
            @if($item->status == 'pending')
                <a href="#" class="btn btn-info sm" title="Edit Data" onclick="openPaymentModal( '{{ $item->amount }}', '{{ $item->created_at->format('D, j, Y, h:i A') }}', '{{ $item->feedback }}','{{ $item->id }}')"><i class="fa fa-pencil-alt"></i></a>
            @else
                <a href="#" class="btn btn-info sm" title="View Data" onclick="openPaymentModal( '{{ $item->amount }}', '{{ $item->created_at->format('D, j, Y, h:i A') }}','{{ $item->feedback }}', '{{ $item->id }}')"><i class="fas fa-eye"></i></a>
            @endif
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
                <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Display evidence of payment, amount, and email here -->
                <p><strong>Amount:</strong> <span id="paymentAmount"></span></p>
                
                <p><strong>Transaction Date :</strong> <span id="userEmail"></span></p>
                
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
