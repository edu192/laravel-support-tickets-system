@component('mail::message')
    # New Ticket

    A new ticket that belongs to your department has been created with the following details:
    ID: {{ $ticket->id }}
    Title: {{ $ticket->title }}
    Description: {{ $ticket->description }}
    Category: {{ $ticket->category->name }}
    Department: {{$ticket->category->department->name}}

    @component('mail::button', ['url' => route('backend.ticket.index')])
        View
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
