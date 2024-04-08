@php
    $type=match ($user->type)
    {
        '0' => 'Admin',
        '1' => 'Customer',
        '2' => 'Employee',
        default => 'Customer',
    };
@endphp
<div class="flex flex-col py-12 px-6">
    <div>
        <p class="text 2xl font-medium">Name: <span class="text-base font-normal text-gray-600">{{$user->name}}</span>
        </p>
    </div>
    <div>
        <p class="text 2xl font-medium">Email: <span
                    class="text-base font-normal text-gray-600">{{$user->email}}</span></p>
    </div>
    <div>
        <p class="text 2xl font-medium">Type: <span
                    class="text-base font-normal text-gray-600">{{$type}}</span></p>
    </div>
    <div>
        <p class="text 2xl font-medium">Phone: <span
                    class="text-base font-normal text-gray-600">{{$user->phone}}</span></p>
    </div>
    <div>
        <p class="text 2xl font-medium">Address: <span
                    class="text-base font-normal text-gray-600">{{$user->address}}</span></p>
    </div>
    <div>
        <p class="text 2xl font-medium">Department: <span
                    class="text-base font-normal text-gray-600">{{$user?->department?->name}}</span></p>
    </div>
</div>
