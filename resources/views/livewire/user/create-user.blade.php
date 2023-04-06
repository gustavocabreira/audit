<form wire:submit.prevent="create" method="post">
    @csrf
    <input wire:model="name" class="text-black" type="text" name="name" placeholder="Name"/>
    <input wire:model="email" class="text-black" type="text" name="email" placeholder="Email"/>
    <input wire:model="password" class="text-black" type="text" name="password" placeholder="Password"/>
    <button class="bg-blue-600 px-2 py-2 text-white uppercase ml-2" type="submit">Create</button>
</form>

