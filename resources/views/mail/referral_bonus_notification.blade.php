<!-- referral_bonus_notification.blade.php -->
@component('mail::message')
# Referral Bonus Notification

Hello {{ $user->name }},

You have received a referral bonus commission.

Amount: {{ $commission }}

Thank you for your participation in our referral program.

Regards,
{{ config('app.name') }}
@endcomponent

