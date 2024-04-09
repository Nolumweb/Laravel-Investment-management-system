<div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title method-name" id="planModalLabel">Payment By Trc 20 - Usdt</h4>
                        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fal fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="payment-form">
                                                            <p class="depositLimit lebelFont">Transaction Limit: 50 - 1000000  $</p>
                                <p class="depositCharge lebelFont">Charge: 0 $  </p>
                            
                            <input type="hidden" class="gateway" name="gateway" value="Usdt">

                            <form>
                                <div class="form-group mb-30 mt-3">
                                    <div class="box">
                                        <h5 class="text-dark">Amount</h5>

                                        <div class="input-group input-box">
                                            <input type="text" class="amount form-control" name="amount">
                                            <button class="show-currency btn-custom">USD</button>
                                        </div>
                                    </div>
                                    <pre class="text-danger errors"></pre>
                                </div>
                            </form>
                        </div>

                        <div class="payment-info text-center">
                            <img id="loading" src="https://growthstoneinvest.com/assets/admin/images/loading.gif" alt="loader" class="w-15" style="display: none;">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-custom checkCalc">Next</button>
                    </div>

                </div>
            </div>
        </div>
