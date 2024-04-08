<div class="w-full flex flex-col">
    <div class="flex justify-center border-b">
        <h3 class="py-4 text-xl font-medium">Assign agent to the ticket ID: {{$ticket->id}}</h3>
    </div>
    <form action="" class="px-4 grow flex flex-col" wire:submit.prevent="assign">
        <div class="mt-2">
            <label for="agent_id"
                   class="block text-base font-medium text-gray-700 dark:text-gray-200">Agent</label>
            <select id="agent_id" name="agent_id" wire:model="agent_id"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm rounded-md">
                @forelse($agents as $agent)
                    <option value="{{ $agent->id }}" @selected($agent->id==0) >{{ $agent->name }}</option>
                @empty
                @endforelse
            </select>
            @error('agent_id')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-2">
            <label for="department"
                   class="block text-base font-medium text-gray-700 dark:text-gray-200 mb-4">Assigned Agents</label>
            <p class="text 2xl font-medium flex flex-wrap">
                @foreach($assigned_agents as $agent)
                    <span class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                        <button type="button" wire:click="remove_agent({{$agent->id}})" class="text-red-500 font-bold">x</button>
                        {{$agent->name}}
                    </span>
                @endforeach
            </p>
        </div>
        <div class="flex justify-end pt-2">
            <button type="submit"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5  mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                Update
            </button>
        </div>
    </form>
</div>