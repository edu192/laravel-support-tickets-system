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
        <form class="shadow-md p-4 border-gray-300" wire:submit.prevent="save_files">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                file</label>
            <input multiple wire:model="files"
                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                   aria-describedby="file_input_help" id="file_input" type="file">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX.
                800x400px).</p>
            <div class="flex justify-end">
                <button type="submit" wire:model="files"
                        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                    Submit
                </button>
            </div>
            @error('files.*')
            <div class="text-red-500 text-sm">{{$message}}</div>
            @enderror
        </form>
    </div>

</div>