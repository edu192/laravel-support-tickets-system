<x-backend-layout>
    <div>
        <div class="grid grid-cols-3 gap-4 mb-4">
            {{--Tickets--}}
            <x-dashboard.card class="bg-red-500 text-white"><i
                        class="fa-solid fa-ticket"></i> {{$tickets->where('status',0)->count()}} Open
            </x-dashboard.card>
            <x-dashboard.card class="bg-yellow-500 text-white"><i
                        class="fa-solid fa-ticket"></i> {{$tickets->where('status',1)->count()}} In process
            </x-dashboard.card>
            <x-dashboard.card class="bg-green-500 text-white"><i
                        class="fa-solid fa-ticket"></i> {{$tickets->where('status',2)->count()}} Closed
            </x-dashboard.card>
            @if(auth()->user()->type==0)
                {{--Users--}}
                <x-dashboard.card class="text-white bg-cyan-500 "><i
                            class="fa-solid fa-user"></i> {{$users->where('type',0)->count()}} Admin
                </x-dashboard.card>
                <x-dashboard.card class="bg-blue-500 text-white"><i
                            class="fa-solid fa-user"></i> {{$users->where('type',1)->count()}} Customer
                </x-dashboard.card>
                <x-dashboard.card class="bg-indigo-500 text-white"><i
                            class="fa-solid fa-user"></i> {{$users->where('type',2)->count()}} Employee
                </x-dashboard.card>
            @endif
        </div>

    </div>
</x-backend-layout>