<div class="w-full flex flex-col">
    <div class="flex justify-center border-b">
        <h3 class="py-4 text-xl font-medium">Create category</h3>
    </div>
    <form action="" class="px-4 grow flex flex-col" wire:submit.prevent="create">
        <div class="mt-2">
            <div class="mt-2">
                <div>
                    <label for="name"
                           class="block text-base font-medium text-gray-700 dark:text-gray-200">Name</label>
                    <input type="text" id="name" name="name" wire:model="name"
                           class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mt-2">
                <label for="department"
                       class="block text-base font-medium text-gray-700 dark:text-gray-200">Department</label>
                <select id="department" name="department" wire:model="department_id"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm rounded-md">
                    @forelse($departments as $department)
                        <option value="{{ $department->id }}" @selected($department->id==0) >{{ $department->name }}</option>
                    @empty
                    @endforelse
                </select>
                @error('department')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="flex justify-end pt-2">
            <button type="submit"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5  mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                Create
            </button>
        </div>
    </form>
</div>