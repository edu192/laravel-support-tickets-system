<div class="w-full h-96 flex flex-col">
    <div class="flex justify-center border-b">
        <h3 class="py-4 text-xl font-medium">New ticket</h3>
    </div>
    <form action="" class="px-4 grow flex flex-col" wire:submit.prevent="create_ticket">
        <div class="mt-2">
            <div class="grid md:grid-cols-2 gap-6 h-full">
                <div>
                    <label for="title"
                           class="block text-base font-medium text-gray-700 dark:text-gray-200">Title</label>
                    <input type="text" id="title" name="title" wire:model="title"
                           class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('title')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="category"
                           class="block text-base font-medium text-gray-700 dark:text-gray-200">Category</label>
                    <select id="category" name="category" wire:model="category"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm rounded-md">
                        @forelse($categories as $category)
                            <option value="{{ $category->id }}" @selected($category->id==0) >{{ $category->name }}</option>
                            @empty
                        @endforelse
                    </select>
                    @error('category')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="grow flex flex-col">
            <label for="description"
                   class="block text-base font-medium text-gray-700 dark:text-gray-200">Description</label>
            <textarea id="description" name="description" wire:model="description"
                      class="grow mt-1 h-fit focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md resize-none"></textarea>
            @error('description')
            <span class="text-red-500">{{ $message }}</span>
            @enderror

        </div>
        <div class="flex justify-end pt-2">
            <button type="submit"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5  mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                Submit
            </button>
        </div>
    </form>
</div>