<form wire:submit.prevent="update" method="post"
      class="flex items-center justify-between">
    @csrf
    <div>
        <input wire:model="name" class="text-black" type="text" name="name" placeholder="Name"/>
        <input wire:model="email" class="text-black" type="text" name="email" placeholder="Email"/>
        <button class="bg-blue-600 px-2 py-2 text-white uppercase ml-2" type="submit">Update</button>
    </div>
    <a class="bg-white px-2 py-2 text-black uppercase ml-2" href="{{route('dashboard')}}">Go
        back</a>
</form>
<script>
    window.addEventListener('updatedUser', _ => {
        alert('User has been updated!');
    })
</script>
