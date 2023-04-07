<form wire:submit.prevent="create" method="post">
    @csrf
    <div class="flex align-items-center mb-3">
        <input wire:model="title" class="w-1/2 text-black" type="text" name="name" placeholder="Title"/>
        <input wire:model="publish_date" class="w-1/2 ml-3 text-black" type="date" name="publish_date"/>
    </div>
    <textarea wire:model="body" class="text-black w-full" type="text" name="email" placeholder="Body"></textarea>

    <button class="bg-blue-600 px-2 py-2 text-white uppercase" type="submit">Create</button>
</form>
