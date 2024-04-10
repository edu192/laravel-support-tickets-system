@props(['ticket'])
@php
    $status=match ($ticket->status)
    {
        0 => 'Open',
        1 => 'In Progress',
        2 => 'Closed',
        default => 'Open',
    };
    $priority=match ($ticket->priority)
    {
        0 => 'Low',
        1 => 'Medium',
        2 => 'High',
        default => 'Low',
    };
@endphp

    <div class="border-r h-full flex flex-col">
        <div class="p-2 text-center  text-gray-800 font-medium text-lg bg-gray-100">
            Ticket ID: {{$ticket->id}}
        </div>

        <div class="px-2 pt-4 pb-2 grow flex flex-col justify-between">
            <div class="flex flex-col gap-2">
                <div class="text-lg font-bold">
                    Title: <span class="text-base font-normal text-gray-700">{{$ticket->title}}</span>
                </div>

                <div class="text-lg font-bold">
                    Status: <span class="text-base font-normal text-gray-700">{{$status}}</span>
                </div>

                <div class="text-lg font-bold">
                    Priority: <span class="text-base font-normal text-gray-700">{{$priority}}</span>
                </div>

                <div class="text-lg font-bold">
                    Category: <span
                            class="text-base font-normal text-gray-700">{{$ticket->category->name}}</span>
                </div>

                <div class="text-lg font-bold">
                    Description: <span
                            class="text-base font-normal text-gray-700">{{$ticket->description}}</span>
                </div>
            </div>

            <button type="button"
                    onclick="Livewire.dispatch('openModal', { component: 'frontend.ticket.attached-files-modal', arguments:{ ticket:{{$ticket->id}} }})"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                Attached Files
            </button>
        </div>
    </div>