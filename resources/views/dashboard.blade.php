
@extends('user.master')
@section('all')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="page-content">
    <div class="container-fluid">

    <!-- start page title -->
    <div class="row">
    <div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0"> {{ __('Dashboard') }}</h4>

        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Upcube</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>

    </div>
    </div>
    </div>
    <!-- end page title -->

    <div class="row">

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body bg-primary">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2 text-white"> {{ __('My Wallet  Balance') }}</p>
                            <h4 class="mb-2"></h4>                                                                          <div>

</div>                    
                            <p class="text-muted mb-0"><span class="text-white fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>${{ $totalWalletBalance }}</span></p>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title bg-light text-primary rounded-3">
                                <i class="mdi mdi-currency-usd font-size-24"></i>
                            </span>
                        </div>
                    </div>
                    <!-- <div class="text-center">
                        <strong><a class=" text-light" href="">{{ __('Veiw Details') }}</a></strong>
                     </div> -->

                </div><!-- end cardbody -->
            </div><!-- end card -->
            </div><!-- end col -->



            <div class="col-xl-3 col-md-6">
              <div class="card">
                  <div class="card-body bg-danger">
                      <div class="d-flex">
                          <div class="flex-grow-1">
                              <p class="text-truncate font-size-14 mb-2 text-light">{{ __('Total Deposit') }}</p>
                              <h4 class="mb-2"></h4>
                              <p class="text-muted mb-0"><span class="text-light fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>${{ $totalDeposit }}</span></p>
                          </div>
                          <div class="avatar-sm">
                              <span class="avatar-title bg-light text-danger rounded-3">
                                  <i class="mdi mdi-currency-usd font-size-24"></i>
                              </span>
                          </div>
                      </div>
                      <!-- <div class="text-center">
                        <strong><a class=" text-light" href="">{{ __('Veiw Details') }}</a></strong>
                     </div> -->

                  </div><!-- end cardbody -->
              </div><!-- end card -->
              </div><!-- end col -->


              <div class="col-xl-3 col-md-6 ">
                <div class="card bg-success">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2 text-white">{{ __('Total Withdrawal') }}</p>
                                <h4 class="mb-2"></h4>
                                <p class="text-muted mb-0"><span class="text-white fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>${{ $totalWithdrawal }}</span></p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="mdi mdi-currency-usd font-size-24"></i>
                                </span>
                            </div>
                        </div>
                        <!-- <div class="text-center">
                            <strong><a class=" text-danger" href="">{{ __('Veiw Details') }}</a></strong>
                         </div> -->

                    </div><!-- end cardbody -->
                </div><!-- end card -->
                </div><!-- end col -->



            <div class="col-xl-3 col-md-6">
              <div class="card">
                  <div class="card-body bg-warning">
                      <div class="d-flex">
                          <div class="flex-grow-1">
                              <p class="text-truncate font-size-14 mb-2 text-light">{{ __('Total Investment') }}</p>
                              <h4 class="mb-2"></h4>
                              <p class="text-muted mb-0"><span class="text-white fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>${{ $totalInvestment }}</span></p>
                          </div>
                          <div class="avatar-sm">
                              <span class="avatar-title bg-light text-warning rounded-3">
                                  <i class="mdi mdi-currency-usd font-size-24"></i>
                              </span>
                          </div>
                      </div>
                      <!-- <div class="text-center">
                        <strong><a class=" text-light" href="">{{ __('Veiw Details') }}</a></strong>
                     </div> -->

                  </div><!-- end cardbody -->
              </div><!-- end card -->
              </div><!-- end col -->






    <div class="col-xl-12 col-md-12">
    <div class="card">
        <div class="card-body">
           

            <div>
            @if ($referralLink)
                    <p>Your referral link: <a href="{{ $referralLink }}">{{ $referralLink }}</a></p>
                @else
                    <p>No referral link available.</p>
                @endif



  <!-- <p id="referralLink" style="color:green !important;" value="{{ $referralLink }}">{{ $referralLink }}</p> -->
  <!-- <button id="copyButton" style="color:green !important; margin-top:0; padding-top:0;">
    <span id="copyIcon"><i class="fas fa-copy"></i></span> Copied!
  </button> -->
</div>


            <!-- <h4 class="card-title mb-4">Latest Transactions</h4> -->

            

        </div><!-- end card -->
    </div><!-- end card -->
    </div>
    <!-- end col -->



    </div>
    <!-- end row -->
    </div>

    </div>


    @endsection

    @push('style')
    <style type="text/css">
      #copyBoard{
        cursor: pointer;
        height: 100%;
      }
        .input-group-text {
            background-color: #0a1227;
            border: 1px solid #373768;
            color: #fff;
        }
        #referralURL{
            background: #20204e;
            border-color: #20204e;
            color: #fff;
        }
    </style>
    @endpush

    @push('script')



    <script>
   const referralLinkElement = document.getElementById('referralLink');
const copyButton = document.getElementById('copyButton');
const copyIcon = document.getElementById('copyIcon');

copyButton.addEventListener('click', () => {
  navigator.clipboard.writeText(referralLinkElement.textContent)
    .then(() => {
      // Success! Update button text and icon
      copyIcon.classList.remove('fa-copy');
      copyIcon.classList.add('fa-check');  // Assuming you have a checkmark icon class
      copyButton.textContent = 'Copied!';
    })
    .catch(error => {
      // Clipboard write failed, handle error
      console.error('Failed to copy text:', error);
      copyButton.textContent = 'Error!';
    });
});

// Optional: Reset button text and icon after a short delay
setTimeout(() => {
  copyIcon.classList.remove('fa-check');
  copyIcon.classList.add('fa-copy');
  copyButton.textContent = 'Copy';
}, 2000); // Adjust delay as needed (in milliseconds)

</script>



    <script>

        (function ($) {
            "use strict";
            $('.planModal').on('click', function () {
                var modal = $('#planModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find($('#planModalLabel').text($(this).data('name')));
            });
            $('.copyBoard').click(function(){
                "use strict";
                    var copyText = document.getElementById("referralURL");
                    copyText.select();
                    copyText.setSelectionRange(0, 99999);
                    /*For mobile devices*/
                    document.execCommand("copy");
                    iziToast.success({message: "Copied: " + copyText.value, position: "topRight"});
              });
        })(jQuery);
    </script>
    @endpush

