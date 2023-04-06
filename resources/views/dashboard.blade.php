<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3 mt-6">
        <p class="text-white font-medium text-xl">Create new user</p>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <livewire:user.create-user/>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6 mb-3">
        <p class="text-white font-medium text-xl">Users list</p>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <livewire:user.list-user/>
    </div>
</x-app-layout>

