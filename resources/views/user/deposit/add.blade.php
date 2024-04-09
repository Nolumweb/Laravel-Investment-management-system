@extends('user.master')
@section('all')

<style>
 

   
</style>

<div class="page-content">
        <div class="container-fluid">
            <div class="row">

            <section class="payment-gateway mt-4">
    <div class="container-fluid">
       <div class="row ms-2 mt-4 mb-2">
           <div class="col">
               <div class="header-text-full">
                   <h3 class="dashboard_breadcurmb_heading mb-1">Add Fund</h3>
                   <nav aria-label="breadcrumb">
                       <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="https://growthstoneinvest.com/user/dashboard">Dashboard</a>
                           </li>
                           <li class="breadcrumb-item active" aria-current="page">Add Fund</li>
                       </ol>
                   </nav>
               </div>
           </div>
       </div>

       <div class="row mt-4 ms-2 me-2">
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="gateway-box">
                        <img
                            class="img-fluid gateway"
                            src="{{ asset('backend/assets/images/crepto/bm.jpg') }}"
                            alt="BTC">
                    </div>
                    <div class="btn mx-3 my-3" style="background-color: #478cff;">
                                <a href="#" class="btn-buy text-light" onclick="showInvestModal()" style="text-decoration:none;">Pay Now</a>
                  </div>
                </div>
                            
                
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="gateway-box">
                        <img
                            class="img-fluid gateway"
                            src="{{ asset('backend/assets/images/crepto/eth.jpg') }}"
                            alt="Eth">
                 </div>
                 <div class="btn mx-3 my-3" style="background-color: #478cff;">
                                <a href="#" class="btn-buy text-light" onclick="showInvestModal()" style="text-decoration:none;">Pay Now</a>
                 </div>
                </div>
                            
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="gateway-box">
                        <img
                            class="img-fluid gateway"
                            src="{{ asset('backend/assets/images/crepto/us.jpg') }}"
                            alt="usdt 20"
                        >
                        <!-- <button type="button"
                            data-id="1002"
                            data-name="Trc 20"
                            data-currency="Usdt"
                            data-gateway="trc-20"
                            data-min_amount="50"
                            data-max_amount="1000000"
                            data-percent_charge="0"
                            data-fix_charge="0"
                            class="gold-btn addFund addFundCustomButton"
                            data-bs-toggle="modal" data-bs-target="#addFundModal">Pay Now </button> -->
                    </div>

                    <div class="btn mx-3 my-3" style="background-color: #478cff;">
                                <a href="#" class="btn-buy text-light" onclick="showInvestModal()" style="text-decoration:none;">Pay Now</a>
                     </div>


                </div>
                   </div>
    </div>
</section>




               
            </div>
        </div>
    </div>
    

    
 <!-- Modal for inserting amount -->


 
 <div class="modal" id="investModal" >
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title method-name" id="planModalLabel">Add Fund</h4>

                    <button type="button" class="close" onclick="hideInvestModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <h4>Transaction Limit: $50 - $100</h4>
                    <input type="number" id="amountInput" class="form-control" placeholder="Enter amount">
                    <p id="amountError" style="color: red; display: none;">Please follow the transaction limit.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="showPreviewModal()">Next</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal for preview -->
    
    <div class="modal" id="previewModal">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview</h5>
                    <button type="button" class="close" onclick="hidePreviewModal()">&times;</button>
                </div>
                <div class="modal-body" id="previewBody">
                    <!-- Preview content will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="pay()">Pay</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    function showInvestModal() {
        document.getElementById('investModal').style.display = 'block';
    }

    function hideInvestModal() {
        document.getElementById('investModal').style.display = 'none';
    }

    function showPreviewModal() {
        var amount = document.getElementById('amountInput').value;
        var minAmount = 50;
        var maxAmount = 100;
        
        // Validate amount
        if (isNaN(amount) || amount < minAmount || amount > maxAmount) {
            // Display error message
            document.getElementById('amountError').style.display = 'block';
            return;
        }

        // Hide error message if validation passes
        document.getElementById('amountError').style.display = 'none';

        // Proceed to the next step
        var charge = 0; // Example charge value
        var conversionRate = 0; // Example conversion rate
        var convertedAmount = amount ;
        var previewContent = '<br>Charge: ' + charge + '<br>Total Amount: ' + convertedAmount;
        document.getElementById('previewBody').innerHTML = previewContent;
        document.getElementById('investModal').style.display = 'none';
        document.getElementById('previewModal').style.display = 'block';
        
        // Store the amount in localStorage
        localStorage.setItem('amount', amount);
    }

    function hidePreviewModal() {
        document.getElementById('previewModal').style.display = 'none';
    }

    function pay() {
        // Retrieve the amount from localStorage
        var amount = localStorage.getItem('amount');
        
        // Redirect the user to the confirmation page
        window.location.href = '/user/deposit/confirm';
    }
</script>


    

@endsection















