@component('mail::message')
# Withdrawal Rejected

Hello {{ $withdrawal->user->name }},

Your withdrawal request has been rejected.

Transaction ID: {{ $withdrawal->transaction_id }}<br>
Reason: {{ $withdrawal->feedback }}





Thank you.

Regards,
{{ config('app.name') }}
@endcomponent
