<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="grid grid-rows-5 grid-cols-3 h-[38rem] rounded-md border shadow-sm">
                        <div class="row-span-5 col-span-1 ">
                            @include('frontend.ticket.partials._ticket', ['ticket' => $ticket])
                        </div>
                        <div class="row-span-3 col-span-2 h-auto">

                            <div class="flex flex-col h-full">

                                <div class="p-2 text-center  text-gray-800 font-medium text-lg bg-gray-100">
                                    Comments
                                </div>

                                <div class="grow flex flex-col overflow-y-scroll"
                                     x-init="$el.scrollTop = $el.scrollHeight">
                                    @forelse($ticket->comments as $comment)
                                        @include('frontend.ticket.partials._comment', ['comment' => $comment])
                                    @empty

                                    @endforelse
                                </div>
                            </div>

                        </div>
                        <div class="row-span-2 col-span-2 h-auto border-t">
                            @can('post_comment', $ticket)
                                @include('frontend.ticket.partials._comment_input')
                            @endcan

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>