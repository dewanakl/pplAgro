<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    You're logged in!
    <button class="btn btn-info">Info</button>

    <p class="p-5 text-danger">{{ Auth::user()->hasRole('admin') ? 'admin' : 'bukan admin' }}
    </p>

</x-app-layout>