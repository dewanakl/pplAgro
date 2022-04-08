<x-app-layout title="Profile">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Akun</li>
        </ol>
    </nav>
    {{-- <div class="card mt-3">
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
    </div> --}}

    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">{{ session()->get('success') }}</div>
    @endif

    <div class="mb-4">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="row no-gutters m-l-0 m-r-0">
                        <div class="col-sm-4">
                            <img src="img/undraw_profile.svg" class="img-profile rounded-circle" width="310">
                        </div>
                        <div class="col-sm-8">
                            <div class="card-body">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600"><strong>Informasi</strong></h6>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">
                                            <i class="far fa-user"></i>
                                            Name
                                        </p>
                                        <h6 class="text-muted f-w-400">{{ $user->name }}</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">
                                            <i class="far fa-envelope"></i>
                                            Email
                                        </p>
                                        <h6 class="text-muted f-w-400">{{ $user->email }}</h6>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600"><strong>More Information</strong>
                                </h6>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">
                                            <i class="fas fa-user-plus"></i>
                                            Registered Date
                                        </p>
                                        <h6 class="text-muted f-w-400">Apr 8, 2022, 8:01 am</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">
                                            <i class="fas fa-sign-in-alt"></i>
                                            Last Login
                                        </p>
                                        <h6 class="text-muted f-w-400">Apr 8, 2022, 8:04 am</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 order-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-fw fa-user-cog" style="font-size:13px;"></i>
                        Edit Account
                    </h6>
                </div>
                <div class="card-body">
                    <form method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-user fa-fw" style="font-size:13px;"></i>
                                Nama :
                            </label>
                            <input type="text" placeholder="Nama" class="form-control" name="name"
                                value="{{ $user->name }}" required>
                            @error('name')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-envelope fa-fw" style="font-size:13px;"></i>
                                Email :
                            </label>
                            <input type="text" placeholder="Email" class="form-control" name="email"
                                value="{{ $user->email }}" required>
                            @error('email')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="email">
                                    <i class="fas fa-lock fa-fw" style="font-size:13px;"></i>
                                    New Password :
                                </label>
                                <input type="password" class="form-control" name="newpass">
                                @error('newpass')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-6 ">
                                <label for="email">
                                    <i class="fas fa-sync fa-fw" style="font-size:13px;"></i>
                                    Confirm New Password :
                                </label>
                                <input type="password" class="form-control" name="confnewpass">
                                @error('confnewpass')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-sm btn-secondary" data-dismiss="modal">
                                <i class="fas fa-undo" style="font-size:13px"></i>
                                Reset
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary" id="action">
                                <i class="fas fa-paper-plane" style="font-size:13px"></i>
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4 order-xl-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-fw fa-exclamation-circle" style="font-size:13px;"></i>
                        Informasi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <small>
                            <i class="fas fa-dot-circle fa-fw" style="font-size:10px;"></i>
                            <b>
                                Untuk mengubah informasi akun tanpa mengubah password,
                                silahkan kosongkan password nya.
                            </b>
                        </small>
                    </div>
                    <div class="mb-4">
                        <small>
                            <i class="fas fa-dot-circle fa-fw" style="font-size:10px;"></i>
                            <b>Harap hati hati dalam mengubah password !</b>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>