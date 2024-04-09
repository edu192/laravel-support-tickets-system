@php
    $status=match ($ticket->status)
    {
        '0' => 'Open',
        '1' => 'In Progress',
        '2' => 'Closed',
        default => 'Open',
    };
    $priority=match ($ticket->priority)
    {
        '0' => 'Low',
        '1' => 'Medium',
        '2' => 'High',
        default => 'Low',
    };
@endphp
<div class="flex flex-col pt-12 pb-4 px-6">
    <div>
        <p class="text 2xl font-medium">Title: <span
                    class="text-base font-normal text-gray-600">{{$ticket->title}}</span>
        </p>
    </div>
    <div>
        <p class="text 2xl font-medium">Status: <span
                    class="text-base font-normal text-gray-600">{{$status}}</span></p>
    </div>
    <div>
        <p class="text 2xl font-medium">Priority: <span
                    class="text-base font-normal text-gray-600">{{$priority}}</span></p>
    </div>
    <div>
        <p class="text 2xl font-medium">Last update: <span
                    class="text-base font-normal text-gray-600">{{$ticket->updated_at}}</span></p>
    </div>
    <div>
        <p class="text 2xl font-medium">Description: <span
                    class="text-base font-normal text-gray-600">{{$ticket->description}}</span></p>
    </div>
    <div>
        <p class="text 2xl font-medium">Category: <span
                    class="text-base font-normal text-gray-600">{{$ticket->category->name}}</span></p>
    </div>
    <div>
        <p class="text 2xl font-medium">Assigned agents:
            @foreach($ticket->assigned_agent as $agent)
                <span class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{$agent->name}}</span>
            @endforeach
        </p>
    </div>
    <div class="flex justify-end">
        <button wire:click="show_comments"
                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
            Comments
        </button>
    </div>
</div>
