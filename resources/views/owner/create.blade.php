<x-app-layout>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('agen.index') }}">Agen</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Agen</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Create new Agen</div>
                <div class="card-body">
                    <form action="{{ route('agen.store') }}" method="post">
                        @csrf
                        <div class="mb-2">
                            <input type="text" name="name" id="name"
                                class="form-control me-2 @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <input type="email" name="email" id="email"
                                class="form-control me-2 @error('email') is-invalid @enderror"
                                value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <input type="password" name="password" id="password"
                                class="form-control me-2 @error('password') is-invalid @enderror"
                                value="{{ old('password') }}">
                            @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>