<!-- balance_updated_notification.blade.php -->
@component('mail::message')
# Balance Updated

Hello {{ $user->name }},

Your balance has been {{ $transactionType === 'deduct' ? 'deducted' : 'credited' }}.

-Amount: {{ $amount }}

Thank you.

Regards,
{{ config('app.name') }}
@endcomponent
