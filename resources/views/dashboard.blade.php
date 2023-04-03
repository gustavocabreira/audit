<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3 mt-6">
        <p class="text-white font-medium text-xl">Create new user</p>
    </div>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{route('users.store')}}" method="post">
                        @csrf
                        <input type="text" name="name" placeholder="Name"/>
                        <input type="text" name="email" placeholder="Email"/>
                        <input type="text" name="password" placeholder="Password"/>
                        <button class="bg-blue-600 px-2 py-2 text-white uppercase ml-2" type="submit">Create
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6 mb-3">
        <p class="text-white font-medium text-xl">Users list</p>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <ul>
                    @foreach($users as $user)
                        <li class="flex items-center justify-between">
                            {{$user->name}}
                            <div>
                                <a class="bg-orange-500 px-2 py-2 text-white uppercase ml-2"
                                   href="{{route('users.show', ['user' => $user])}}">update</a>
                                <a class="bg-red-500 px-2 py-2 text-white uppercase ml-2"
                                   href="{{route('users.delete', ['user' => $user])}}">delete</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
