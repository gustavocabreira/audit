<div>
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
