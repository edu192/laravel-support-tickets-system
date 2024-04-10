@component('mail::message')
# Ticket received
## Ticket ID: {{ $ticket->id }}
You have submitted a new ticket, and it will be attended by an agent soon.

@component('mail::button', ['url' => route('user.ticket.show',$ticket)])
View
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
