@component('mail::message')
# Withdrawal Approved

Hello {{ $withdrawal->user->name }},

Your withdrawal request has been approved.

Transaction ID: {{ $withdrawal->transaction_id }} <br>
Amount: {{ $withdrawal->amount }}<br>
Remaining Balance: {{ $withdrawal->user->wallet_balance }}

Thank you.

Regards,
{{ config('app.name') }}
@endcomponent


