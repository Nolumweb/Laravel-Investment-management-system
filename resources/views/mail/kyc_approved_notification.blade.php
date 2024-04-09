<!-- kyc_approved_notification.blade.php -->
@component('mail::message')
# KYC Document Approved

Hello {{ $kyc->user->name }},

Your KYC document has been approved.

Thank you.

Regards,
{{ config('app.name') }}
@endcomponent

