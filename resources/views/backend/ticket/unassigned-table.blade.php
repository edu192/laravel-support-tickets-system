<x-backend-layout>
    <h3 class="text-2xl font-bold mb-4 border-b">
        Tickets no asignados
    </h3>
    <div class="py-4 text-gray-600">
        La tabla a continuación muestra una lista de todos los tickets no asignados que coinciden con tu departamento, {{@ auth()->user()->department->name}}.
    </div>
    <div class="flex justify-end">
        <button type="button" onclick="Livewire.dispatch('openModal', { component: 'frontend.ticket.create-modal' })"
                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
            Nuevo Ticket
        </button>
    </div>
    <livewire:backend.ticket.unassigned-table/>
</x-backend-layout>
