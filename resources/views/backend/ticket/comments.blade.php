@php
    $status=match ($ticket->status)
    {
        0 => ['Open','green'],
        1 => ['In Progress','yellow'],
        2 => ['Closed','red'],
        default => ['Open','green'],
    };
@endphp

<x-backend-layout>
    <div class="h-full flex flex-col">
        <h3 class="text-2xl font-bold mb-4 border-b flex items-center gap-4">
            <span>Ticket ID: {{$ticket->id}}</span>
            <x-badge :color="$status[1]" :text="$status[0]" />
        </h3>
        <div class="flex justify-end">
            <button onclick="Livewire.dispatch('openModal', { component: 'backend.ticket.view-modal', arguments: { ticket: {{ $ticket->id }} }})"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                View
            </button>
            <button type="button"
                    onclick="Livewire.dispatch('openModal', { component: 'backend.ticket.attached-files-modal', arguments:{ ticket:{{$ticket->id}} }})"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                Attached Files
            </button>
            @if($ticket->status!==2)
                <button type="button"

                        onclick="Livewire.dispatch('openModal', { component: 'backend.ticket.close-ticket-modal', arguments:{ ticket:{{$ticket->id}} }})"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    Close Ticket
                </button>
            @endif
        </div>
        <div class="grow shadow-md overflow-y-auto rounded-t-md bg-gray-100 p-4 space-y-2"
             x-init="$el.scrollTop = $el.scrollHeight">
            @forelse($ticket->comments as $comment)
                <div class="flex flex-col p-4 border-b bg-white">
                    <div class="flex justify-between border-b">
                        <p class="text-sm font-bold">{{$comment->user->name}}</p>
                        <p class="text-sm font-normal text-gray-600">{{$comment->created_at}}</p>
                    </div>
                    <div class="pt-4">
                        <p class="text-lg text-gray-800">{{$comment->description}}</p>
                    </div>
                </div>

            @empty
            @endforelse
        </div>
        @can('post_comment',$ticket)

            <div class="">
                <form action="{{route('backend.ticket.post-comment',$ticket)}}" method="post">
                    @csrf
                    <div class="flex flex-col">
                        <label for="description" class="text-lg font-medium py-2">Comment</label>
                        <textarea name="comment" id="description" cols="30" rows="10"
                                  class="w-full p-2 border border-gray-300 rounded-md"></textarea>
                        @error('comment')
                        <div class="text-red-500 text-sm">{{$message}}</div>
                        @enderror

                        <button type="submit"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            Comment
                        </button>
                    </div>
                </form>
            </div>

        @endcan
    </div>


</x-backend-layout>