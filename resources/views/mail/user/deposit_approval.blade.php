@component('mail::message')
# Deposit Approved

Your deposit request has been approved.

Transaction ID: {{ $transaction->transaction_id }}
Amount: {{ $transaction->amount }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent