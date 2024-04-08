@php
    function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ticket-attached-files-modal.blade.php' . $units[$pow];
    }
@endphp
<div class="w-full flex flex-col">
    <div class="flex justify-center border-b">
        <h3 class="py-4 text-xl font-medium">Ticket attached files</h3>
    </div>
    <div class="px-4 py-12">
        <ul class="mb-12 text-lg">
            @forelse($ticket->files as $file)
                <li> {{$file->name}} <span
                            class="text-gray-500 text-sm">{{formatBytes(Storage::size("public/uploads/$file->name"))}}</span>
                    <a href="{{route('download.file',$file)}}" class="ms-2"><i
                                class="fa-solid fa-file-arrow-down"></i></a></li>
            @empty
            @endforelse
        </ul>
    </div>

</div>