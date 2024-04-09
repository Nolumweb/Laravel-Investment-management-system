@component('mail::message')
# Admin Deposit Notification

Hello Admin,

A user has made a deposit. Please review the details below:

- Amount: {{ $transaction->amount }}
- Transaction ID: {{ $transaction->transaction_id }}



Thank you.
@endcomponent

