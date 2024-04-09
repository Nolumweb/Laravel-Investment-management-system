@component('mail::message')
# Money Transfer Notification

@if ($sender->id == $recipient->id)
Hello {{ $sender->name }},

You have made a money transfer to yourself.

@else
Hello {{ $recipient->name }},

You have received a money transfer from {{ $sender->name }}.

@endif

Transfer Details:
- Amount: ${{ $amount }}
- Sender: {{ $sender->name }} ({{ $sender->email }})
- Recipient: {{ $recipient->name }} ({{ $recipient->email }})

Thank you for using our service.

Regards,<br>
{{ config('app.name') }}
@endcomponent
