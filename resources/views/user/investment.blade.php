@extends('user.master')
@section('all')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">
<div class="row">



    <form action="{{route('store.investment')}}" method="post" class="account-form login-form">
        @csrf

        <div class="form-group">
            <input type="text" name="id" required>
            <input type="text" name="" required>
            <input type="text" name="id" required>
            <input type="text" name="id" required>

        </div>

        <div class="form-group">
            <label>Enter Amount<sup class="text-danger">*</sup></label>
            <div class="input-group">
                <input id="amount" type="text" class="form--control" name="amount" placeholder="@lang('Amount')" required
                value="{{old('amount')}}" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-2">
                <button type="submit" class="btn btn--base w-100 bg-danger" data-bs-dismiss="modal">Close</button>
            </div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn--base w-100">Confirm</button>
            </div>
        </div>
      </form>



</div>
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

