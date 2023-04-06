<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update User') }}
        </h2>
    </x-slot>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <p class="text-white font-medium text-xl">Update user</p>
    </div>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{route('users.update', ['user' => $user])}}" method="post"
                          class="flex items-center justify-between">
                        @csrf
                        <div>
                            <input class="text-black" type="text" name="name" placeholder="Name"
                                   value="{{$user->name}}"/>
                            <input class="text-black" type="text" name="email" placeholder="Email"
                                   value="{{$user->email}}"/>
                            <button class="bg-blue-600 px-2 py-2 text-white uppercase ml-2" type="submit">Update
                            </button>
                        </div>
                        <a class="bg-white px-2 py-2 text-black uppercase ml-2" href="{{route('dashboard')}}">Go
                            back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

