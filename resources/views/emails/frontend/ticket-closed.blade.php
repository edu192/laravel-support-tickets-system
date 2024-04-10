@component('mail::message')
# Ticket have been closed.

The ticket you opened has been closed. If you have any questions or concerns, please feel free to reply to this email.

@component('mail::button', ['url' => route('user.ticket.show', $ticket->id)])
View
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
