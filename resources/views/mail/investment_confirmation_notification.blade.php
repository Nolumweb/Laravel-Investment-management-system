@component('mail::message')
# Investment Confirmation

Hello {{ $investment->user->name }},

Your investment has been successfully made.

Investment Details:
- Plan: {{ $investment->plan->name }}
- Amount: {{ $investment->amount }}
- Wallet Balance: {{ $investment->user->wallet_balance }}
- Start Date: {{ $investment->start_date }}
- Due Date: {{ $investment->maturity_date }}

Thank you for choosing our platform.

Regards,
{{ config('app.name') }}
@endcomponent
