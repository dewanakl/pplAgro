<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot> --}}
    {{-- <div class="h-screen drawer drawer-mobile w-full">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle">
        <div class="drawer-content flex flex-col items-center justify-center">
            <!-- Page content here -->
            <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">Open drawer</label>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200"> --}}
                            <div class="flex flex-col w-full border-opacity-50">
                                <div class="grid h-20 card bg-base-300 rounded-box place-items-center">
                                    <p> {{ $user->name }}</p>
                                    <p> {{ $user->email }}</p>
                                </div>
                            </div>
                            {{--
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>