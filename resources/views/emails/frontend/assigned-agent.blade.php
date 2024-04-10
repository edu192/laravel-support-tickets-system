@component('mail::message')
# Ticket response

A new agent have been assigned to your ticket.

@component('mail::button', ['url' => route('user.ticket.show', $ticket)])
View
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
