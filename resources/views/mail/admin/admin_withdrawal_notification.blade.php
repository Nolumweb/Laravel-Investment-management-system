<!-- admin_withdrawal_notification.blade.php -->
@component('mail::message')
# New Withdrawal Request

Hello Admin,

A new withdrawal request has been submitted by a user.

Withdrawal Details:
- User: {{ $transaction->user->name }} ({{ $transaction->user->email }})
- Amount: {{ $transaction->amount }}
- Transaction ID: {{ $transaction->transaction_id }}

Please review and take necessary action.

Regards,
{{ config('app.name') }}
@endcomponent
