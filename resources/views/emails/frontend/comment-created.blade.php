@component('mail::message')
# New comment

A new comment has been added to your ticket.

{{ $comment->description }}

@component('mail::button', ['url' => route('user.ticket.show', $comment->ticket)])
    View
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
