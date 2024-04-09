<!-- user_withdrawal_notification.blade.php -->
@component('mail::message')
# Withdrawal Request Submitted

Hello {{ $user->name }},

Your withdrawal request has been submitted successfully. It is currently pending admin approval.

Withdrawal Details:
- Amount: {{ $transaction->amount }}
- Transaction ID: {{ $transaction->transaction_id }}

Thank you.

Regards,
{{ config('app.name') }}
@endcomponent
