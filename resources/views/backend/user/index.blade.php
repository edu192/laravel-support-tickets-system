<x-backend-layout>
    <div class="flex justify-end">
        <button type="button" onclick="Livewire.dispatch('openModal', { component: 'backend.user-create-modal'})"
                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
            New User
        </button>
    </div>
    <livewire:backend-users-table/>
</x-backend-layout>