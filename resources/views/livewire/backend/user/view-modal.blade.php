@php
    $type=match ($user->type)
    {
        '0' => 'Administrador',
        '1' => 'Cliente',
        '2' => 'Empleado',
        default => 'Cliente',
    };
@endphp
<div class="flex flex-col py-12 px-6">
    <div>
        <p class="text 2xl font-medium">Nombre: <span class="text-base font-normal text-gray-600">{{$user->name}}</span>
        </p>
    </div>
    <div>
        <p class="text 2xl font-medium">Correo Electrónico: <span
                class="text-base font-normal text-gray-600">{{$user->email}}</span></p>
    </div>
    <div>
        <p class="text 2xl font-medium">Tipo: <span
                class="text-base font-normal text-gray-600">{{$type}}</span></p>
    </div>
    <div>
        <p class="text 2xl font-medium">Teléfono: <span
                class="text-base font-normal text-gray-600">{{$user->phone}}</span></p>
    </div>
    <div>
        <p class="text 2xl font-medium">Dirección: <span
                class="text-base font-normal text-gray-600">{{$user->address}}</span></p>
    </div>
    <div>
        <p class="text 2xl font-medium">Departamento: <span
                class="text-base font-normal text-gray-600">{{$user?->department?->name}}</span></p>
    </div>
</div>
