<x-app-layout title="Profile">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Akun</li>
        </ol>
    </nav>
    <p>{{ $user->name }}</p>
    <p>{{ $user->email }}</p>
</x-app-layout>