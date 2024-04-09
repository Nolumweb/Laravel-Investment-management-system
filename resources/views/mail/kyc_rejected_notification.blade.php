<!-- kyc_rejected_notification.blade.php -->
@component('mail::message')
# KYC Document Rejected

Hello {{ $kyc->user->name }},

Your KYC document has been rejected.

-Reason: {{ $kyc->feedback }}

Thank you.

Regards,
{{ config('app.name') }}
@endcomponent
