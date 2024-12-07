<x-backend-layout>
    <div>
        <div class="grid grid-cols-3 gap-4 mb-4">
            {{--Tickets--}}
            <x-dashboard.card class="bg-red-500 text-white"><i
                    class="fa-solid fa-ticket"></i> {{$tickets->where('status',0)->count()}} Abiertos
            </x-dashboard.card>
            <x-dashboard.card class="bg-yellow-500 text-white"><i
                    class="fa-solid fa-ticket"></i> {{$tickets->where('status',1)->count()}} En proceso
            </x-dashboard.card>
            <x-dashboard.card class="bg-green-500 text-white"><i
                    class="fa-solid fa-ticket"></i> {{$tickets->where('status',2)->count()}} Cerrados
            </x-dashboard.card>
            @if(auth()->user()->type==0)
                {{--Usuarios--}}
                <x-dashboard.card class="text-white bg-cyan-500 "><i
                        class="fa-solid fa-user"></i> {{$users->where('type',0)->count()}} Administradores
                </x-dashboard.card>
                <x-dashboard.card class="bg-blue-500 text-white"><i
                        class="fa-solid fa-user"></i> {{$users->where('type',1)->count()}} Clientes
                </x-dashboard.card>
                <x-dashboard.card class="bg-indigo-500 text-white"><i
                        class="fa-solid fa-user"></i> {{$users->where('type',2)->count()}} Empleados
                </x-dashboard.card>
            @endif
        </div>

    </div>
</x-backend-layout>
