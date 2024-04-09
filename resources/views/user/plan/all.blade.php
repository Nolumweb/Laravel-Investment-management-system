<!-- resources/views/user/investment_plans.blade.php -->

@extends('user.master')
@section('all')

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Plan Data</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
       


<div class="row">
        @foreach($plans as $plan)
                <div class="col-md-3">
                <div class="card mb-3">
                            <div class=" text-center card-header">
                                {{ $plan->name }}
                            </div>
                        <div class="card-body">
                                <p>Duration: {{ $plan->duration_value }} {{ $plan->duration_unit }}</p>
                                <p>Profit Percentage: {{ $plan->profit_percentage }}%</p>
                                <p>Min Amount: {{ $plan->min_amount }}</p>
                                <p>Max Amount: {{ $plan->max_amount }}</p>
                             <p class='text-center'>   <a href="#" class="btn-buy  text-primary" onclick="showInvestModal({{ $plan }})" style="text-decoration:none;">Invest Now</a></p>
                        </div>
                        </div>       
                     </div>

                        @endforeach
            </div> <!-- end row -->



      
    </div> <!-- container-fluid -->
</div>

<!-- Your modal HTML -->
<div class="modal" id="investModal">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title method-name" id="planModalLabel">Investment Details</h4>
                <button type="button" class="close" onclick="hideInvestModal()">&times;</button>
            </div>
            <div class="modal-body">
            <p >Balance: <span class='text-success'><b>{{ $user->wallet_balance }}</b></span></p>

                <p id="modalPlanName"></p>
                <p id="modalDuration"></p>
                <p id="modalProfitPercentage"></p>
                <p id="modalAmountRange"></p>
                <form action="{{ route('user.plan') }}" method="post" id="investForm">
                    @csrf
                    <input type="hidden" name="plan_id" id="modalPlanId">
                    <div class="form-group">
                        <input type="number" class="form-control" id="amount" placeholder="Enter the amount" name="amount" min="0"  require>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="hideInvestModal()">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showInvestModal(plan) {
        $('#modalPlanName').text(plan.name);
        $('#modalDuration').text('Duration: ' + plan.duration_value + ' ' + plan.duration_unit);
        $('#modalProfitPercentage').text('Profit Percentage: ' + plan.profit_percentage + '%');
        $('#modalAmountRange').text('Invest: ' + plan.min_amount + ' - ' + plan.max_amount);
        $('#modalPlanId').val(plan.id);
        $('#investModal').modal('show');
    }

    function hideInvestModal() {
        $('#investModal').modal('hide');
    }
</script>

@endsection
