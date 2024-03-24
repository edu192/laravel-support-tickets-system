<form class="flex flex-col h-full" action="{{route('user.ticket.comment',$ticket)}}" method="post">
    @csrf
    <textarea class="w-full grow border-none  resize-none" name="comment"></textarea>
    <div class="p-2 flex justify-end border-t">
        <button class="text-center py-2 px-4 bg-gray-200" type="submit">Submit</button>
    </div>
</form>