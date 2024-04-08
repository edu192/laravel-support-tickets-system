<div class="w-full flex flex-col">
    <div class="flex justify-center border-b">
        <h3 class="py-4 text-xl font-medium">Edit User: {{$user->id}}</h3>
    </div>
    <form action="" class="px-4 grow flex flex-col" wire:submit.prevent="update_user">
        <div class="mt-2">
            <div>
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
            <div class="grid md:grid-cols-2 gap-6 h-full">
                <div>
                    <label for="type"
                           class="block text-base font-medium text-gray-700 dark:text-gray-200">Type</label>
                    <select id="type" name="type" wire:model="type" wire:change="departmentInputStatus"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm rounded-md">
                        <option value="1" @selected($department_id==1)>Customer</option>
                        <option value="2" @selected($department_id==2)>Employee</option>
                        <option value="0" @selected($department_id==0)>Admin</option>
                    </select>
                    @error('type')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="department"
                           class="block text-base font-medium text-gray-700 dark:text-gray-200">Department</label>
                    <select id="department" name="department" wire:model="department_id" @disabled($isDisabled)
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm rounded-md">
                        @forelse($departments as $department)
                            <option value="{{ $department->id }}" @selected($department->id==0) >{{ $department->name }}</option>
                        @empty
                        @endforelse
                    </select>
                    @error('department_id')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="grid md:grid-cols-2 gap-6 h-full">
            <div>
                <label for="email"
                       class="block text-base font-medium text-gray-700 dark:text-gray-200">Email</label>
                <input type="email" id="email" name="email" wire:model="email"
                       class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('email')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="phone"
                       class="block text-base font-medium text-gray-700 dark:text-gray-200">Phone</label>
                <input type="text" id="phone" name="phone" wire:model="phone"
                       class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('phone')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div>
            <label for="address"
                   class="block text-base font-medium text-gray-700 dark:text-gray-200">Address</label>
            <input type="text" id="address" name="address" wire:model="address"
                   class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            @error('address')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="password"
                   class="block text-base font-medium text-gray-700 dark:text-gray-200">Password</label>
            <input type="password" id="password" name="password" wire:model="password"
                   class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            @error('password')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="password_confirmed"
                   class="block text-base font-medium text-gray-700 dark:text-gray-200">Password</label>
            <input type="password" id="password_confirmed" name="password_confirmed" wire:model="password_confirmation"
                   class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            @error('password')
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