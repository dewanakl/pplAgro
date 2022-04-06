<x-guest-layout title="Login">
    @section('styles')
    <style>
        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }
    </style>
    @endsection
    {{-- <main class="form-signin">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1 class="h3 mb-3">Please sign in</h1>
            <div class="mb-4">
                <label for="floatingInput" class="form-label">Email address</label>
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email"
                    :value="old('email')" autofocus required>
            </div>
            <div class="mb-4">
                <label for="floatingPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password"
                    required>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            @if (Route::has('password.request'))
            <a class="mt-5 mb-3 text-muted" href="{{ route('password.request') }}">Lupa password ?</a>
            @endif
            <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
        </form>
    </main> --}}
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label">email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}">
                                @error('email')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    value="{{ old('password') }}">
                                @error('password')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>