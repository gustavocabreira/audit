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
                        <input class="text-black" type="text" name="name" placeholder="Name"/>
                        <input class="text-black" type="text" name="email" placeholder="Email"/>
                        <input class="text-black" type="text" name="password" placeholder="Password"/>
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
        @foreach($users as $user)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul>
                        <li class="flex items-center justify-between">
                            {{$user->name}}
                            <div>
                                <a class="bg-orange-500 px-2 py-2 text-white uppercase ml-2"
                                   href="{{route('users.show', ['user' => $user])}}">update</a>
                                <a class="bg-red-500 px-2 py-2 text-white uppercase ml-2"
                                   href="{{route('users.delete', ['user' => $user])}}">delete</a>
                            </div>
                        </li>
                        <p class="mt-5 mb-2">Historic</p>
                        @foreach($user->historic as $key => $historic)
                            <div>
                                {{ ucfirst($historic->event) }} {{isset($historic->author) ? 'by' : ''}}
                                <span class="text-green-300 font-semibold">
                                    {{$historic->author->name ?? ''}}
                                </span>
                                <span>
                                    at {{$historic->when->format('Y/m/d')}} - <a href="">View changes</a>
                                </span>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach

    </div>
</x-app-layout>

