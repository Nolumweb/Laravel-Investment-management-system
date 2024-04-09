@component('mail::message')
# Deposit Pending Approval

Your deposit request has been submitted successfully and is pending for admin to approve.

Transaction ID: {{ $transaction->transaction_id }}
Amount: {{ $transaction->amount }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent





