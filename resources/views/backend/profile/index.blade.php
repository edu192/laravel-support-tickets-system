<x-backend-layout>
    <h3 class="text-2xl font-bold mb-4 border-b">
        Profile
    </h3>

    <form action="{{route('backend.profile.update')}}" method="post">
        @csrf
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="name"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" id="name" name="name"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="" value="{{$user->name}}"/>
                @error('name')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="email"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" id="email" name="email"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="" value="{{$user->email}}"/>
                @error('email')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="department"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                <input type="text" id="department"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="" value="{{$user->department?->name}}" disabled/>
            </div>
            <div>
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Number</label>
                <input type="tel" id="phone" name="phone"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="" value="{{$user->phone}}"/>
                @error('phone')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

        </div>
        <div class="mb-6">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
            <input type="text" id="address" name="address"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="" value="{{$user->address}}"/>
            @error('address')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

       <div class="flex justify-end">
           <button type="submit"
                   class=" text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
               Submit
           </button>
       </div>
    </form>
    <h4 class="text-lg font-medium text-gray-800 border-b mb-6">
        Change password
    </h4>
    <form action="{{route('backend.profile.update.password')}}" method="post">
        @csrf
        <div class="mb-6">
            <label for="current_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" id="current_password" name="current_password"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="" />
            @error('current_password')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New password</label>
            <input type="password" id="password" name="password"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="" />
            @error('password')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="" />
            @error('new_password')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class=" text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                Submit
            </button>
        </div>
    </form>
</x-backend-layout>