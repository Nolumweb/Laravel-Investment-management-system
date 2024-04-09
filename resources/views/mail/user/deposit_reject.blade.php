
@component('mail::message')
# Deposit Rejected

Your deposit request has been rejected.

Transaction ID: {{ $transaction->transaction_id }}
Amount: {{ $transaction->amount }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent