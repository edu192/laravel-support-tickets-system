<div {{ $attributes->merge([ 'class' => 'flex items-center justify-center h-24 rounded  dark:bg-gray-800']) }} >
    <p class="text-2xl ">

        {{ $slot }}

    </p>
</div>