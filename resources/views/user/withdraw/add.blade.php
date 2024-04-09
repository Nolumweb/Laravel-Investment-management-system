@extends('user.master')
@section('all')

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
                           <li class="breadcrumb-item"><a href="">Dashboard</a>
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
                    <a href="#" class="btn-buy text-light" alt="BTC" onclick="showInvestModal(this)" style="text-decoration:none;">Pay Now</a>
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
                 <a href="#" class="btn-buy text-light" alt="Eth" onclick="showInvestModal(this)" style="text-decoration:none;">Pay Now</a>
                 </div>
                </div>
                            
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="gateway-box">
                        <img
                            class="img-fluid gateway"
                            src="{{ asset('backend/assets/images/crepto/us.jpg') }}"
                            alt="usdt"
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
 <a href="#" class="btn-buy text-light" alt="Usdt" onclick="showInvestModal(this)" style="text-decoration:none;">Pay Now</a>
         
                </div>


                </div>


                   </div>
    </div>
</section>




               
            </div>
        </div>
    </div>
    

    
<!-- Your modal HTML -->
<div class="modal" id="investModal">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title method-name" id="planModalLabel">Withdraw Fund</h4>
                <button type="button" class="close" onclick="hideInvestModal()">&times;</button>
            </div>
            <form id="withdrawForm" action="{{ route('user.withdraw') }}" method="POST">
                    @csrf
        <div class="modal-body">

            <h6>Previous Balance: <span class='text-success'  id="previousBalance">{{ $balance }}</span></h6>

                <div class="form-group">                
                    <label for="amount">Amount:</label>
                    <input type="number" class="form-control" id="amount" name="amount" required placeholder="Enter amount">
                </div>
                
                <div class="form-group">
                    <label for="walletAddress">Wallet Address:</label>
                    <input type="text" class="form-control" id="walletAddress" placeholder="Enter wallet address" name="wallet_address" required>
                </div>
                <!-- Display alt value here -->
                <input type="hidden" id="altValue" name="altValue">

            </div>

              
               
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="hideInvestModal()">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
               
                </form>

           
        </div>
    </div>
</div>



    
   
    
    <script>
   

// Function to show modal and capture alt value
function showInvestModal(element) {
    var altValue = element.getAttribute('alt');
    document.getElementById('altValue').value = altValue;
    $('#investModal').modal('show');
}






// Function to submit investment
function submitInvestment() {
    var amount = document.getElementById('amount').value;
    var walletAddress = document.getElementById('walletAddress').value;
    var altValue = document.getElementById('altValue').value;
    
    
    // Clear the input fields and hide the modal after submission
    document.getElementById('amount').value = '';
    document.getElementById('walletAddress').value = '';
    document.getElementById('altValue').value = '';
    $('#investModal').modal('hide');
}

// Function to hide modal
function hideInvestModal() {
    $('#investModal').modal('hide');
}


</script>


    

@endsection















