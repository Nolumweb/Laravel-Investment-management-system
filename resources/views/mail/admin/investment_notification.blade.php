@component('mail::message')
# New Investment Made

Hello Admin,

A new investment has been made on the platform.

Investment Details:
- User: {{ $investment->user->name }}
- Plan: {{ $investment->plan->name }}
- Amount: {{ $investment->amount }}

Regards,
{{ config('app.name') }}
@endcomponent
