<x-app-layout title="Profile">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Akun</li>
        </ol>
    </nav>
    <div class="card mt-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="img/undraw_profile.svg">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">{{ $user->email }}</p>
                    <p class="card-text"><small class="text-muted">
                            {{ date("Y-m-d", strtotime($user->created_at)) }}</small></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>