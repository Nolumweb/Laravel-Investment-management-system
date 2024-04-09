@extends('user.master')
@section('all')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    
<div class="page-content">
    <div class="container-fluid">


    <h1>User Deposit Confirmation</h1>

    <section class="transaction-history mt-4">
        <div class="container">
            <div class="row">
                <div class="col ms-2">
                    <div class="header-text-full">
                        <h3 class="dashboard_breadcurmb_heading">Pay with Trc 20</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card secbg br-4">
                        <div class="card-body bg-light profile-setting">
                            <div class="row ">
                                <div class="col-md-12">
                                    <h4 class="title text-center">Please follow the instruction below</h4>

                    <p class="text-center mt-2" id="depositMessage">
    You have requested to deposit $
    <b class="text--base" id="amountDisplay"></b>,
    Please pay 
    <b class="text--base" id="paymentAmountDisplay"></b>
    for successful payment.
</p>







  
        
        <p>Copy this address and make payment and only send usdt (trc-20)<br></p>
<p id="paymentAddress" style="color:green !important; ">TXBzN9nsFVqozc51xAuNsK85iUtSTMTjdy</p>
<button style="color:green !important; margin-top:0; padding-top:0;" onclick="copyText()">
    <span id="copyIcon"><i class="fas fa-copy"></i></span>
</button>
<span id="copied-text"></span>






      </h6>
</p>             


<form id="depositForm" method="POST" action="{{ route('user.deposit') }}" enctype="multipart/form-data">
 @csrf
 <!-- <input type="text" class="form-control"  name="amount" > -->
 <input type="hidden" class="form-control" id="amount" name="amount" >
    
    <div class="col-md-12 mt-2">
        <label>Upload evidence of payment <span class="text--danger">*</span></label>

        <div id="imagePreviewContainer" style="display: none;">
    <div class="fileinput-new thumbnail withdraw-thumbnail" data-trigger="fileinput">
        <!-- Display selected image here -->
        <img id="previewImage" class="img-fluid" src="" alt="...">
    </div>
</div>


                <div class="mt-2 fileinput-preview fileinput-exists thumbnail wh-100-10 "></div>
                <div class="img-input-div">
                    <span class="btn btn-success btn-file  ">
                        <input type="file" name="Uploadevidenceofpayment" id="imageInput" accept="image/*" required>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <span>Confirm Now</span>
            </button>
            <a href="#" onclick="history.go(-1)" class="mt-1 btn btn-secondary">Back</a>
        </div>
    </div>
</form>













                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




</div>
</div>













<script>
    // Fetch the amount from localStorage
    var amount = localStorage.getItem('amount');

    // Check if the amount is present in localStorage
    if (amount) {
        // Set the value of the amount input field
        document.getElementById('amount').value = `${amount} `;
        // Update the HTML content of the elements with the amount
        document.getElementById('amountDisplay').innerHTML = `${amount} `;
        document.getElementById('paymentAmountDisplay').innerHTML = `Amount: ${amount} `;
    } else {
        // Hide the paragraph if the amount is not found
        document.getElementById('depositMessage').style.display = 'none';
    }

    // Function to copy payment address to clipboard
    function copyText() {
        var textToCopy = document.getElementById('paymentAddress').innerText;
        var tempInput = document.createElement("input");
        tempInput.value = textToCopy;
        document.body.appendChild(tempInput);
        tempInput.select();
        tempInput.setSelectionRange(0, 99999);
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        var copyIcon = document.getElementById('copyIcon');
        copyIcon.innerHTML = '<i class="fas fa-check"></i>';
        copyIcon.style.color = 'green';
        var copiedText = document.getElementById('copied-text');
        copiedText.innerText = 'Copied!';
    }

    // Function to preview uploaded image
   
    function previewImage(event) {
    var previewContainer = document.getElementById('imagePreviewContainer');
    var previewImage = document.getElementById('previewImage');
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        previewImage.src = reader.result;
        previewContainer.style.display = 'block'; // Show the image preview container
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        previewImage.src = ''; // Clear the preview image src if no file is selected
        previewContainer.style.display = 'none'; // Hide the image preview container
    }
}

document.getElementById('imageInput').addEventListener('change', previewImage);





    // Event listener for file input change
    document.getElementById('imageInput').addEventListener('change', previewImage);
</script>





@endsection

