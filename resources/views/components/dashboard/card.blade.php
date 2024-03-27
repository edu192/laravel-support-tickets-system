<div {{ $attributes->merge([ 'class' => 'flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800']) }} >
    <p class="text-2xl ">

        {{ $slot }}

    </p>
</div>