<x-guest-layout title="Login">
    @section('styles')
    <style>
        .login {
            min-height: 100vh;
        }

        .bg-image {
            background-image: url('https://awsimages.detik.net.id/community/media/visual/2021/09/14/tempe-jadi-gastronomi-diplomasi-4.jpeg?w=1200');
            background-size: cover;
            background-position: center;
        }
    </style>
    @endsection

    <div style="overflow-x: hidden;">
        <div class="row g-0">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto">
                                <h3 class="text-dark mb-4">Welcome back!</h3>
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}">
                                        @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            value="{{ old('password') }}" autocomplete="off">
                                        @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-lg btn-primary" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>