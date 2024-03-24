@props(['comment'])
<div class="mb-2 p-2">
    <div class="flex @if($comment->user_id==auth()->user()->id) justify-end @endif">
        <div class="w-1/2 bg-gray-100 rounded-sm shadow-sm">
            <div class="flex justify-between gap-2  p-2">
                <p class="font-medium">
                    {{$comment->user->name}}
                </p>
                <p class="font-medium">
                    {{$comment->created_at->diffForHumans()}}
                </p>
            </div>
            <p class="p-2 text-gray-800">
                {{$comment->description}}
            </p>
        </div>
    </div>
</div>