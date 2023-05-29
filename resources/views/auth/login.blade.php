<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts._headerlib')
</head>

<body class="">

    <div class="container-fluid position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 mx-4">
                    <div class="container-fluid pe-0">
                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="#">
                            <img src="{{ asset('assets/img/logos/tegal-border.png')}}" alt="Logo" style="width: 25px; margin-right: 5px;">
                            Pemerintah Kabupaten Tegal
                        </a>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>

    <main class="main-content mt-0">

        <div class="container-lg" style="position: absolute;">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-7"></div>
                <div class="col-md-6 col-lg-5">
                    <div class="card bg-white mt-6" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; padding: 30px;">
                        <div class="card-header pb-0 bg-white">
                            <h3 class="font-weight-bolder">LOGIN SSO</h3>
                            <p style="font-size: 13px;">Login menggunakan SSO untuk mengakses berbagai macam aplikasi</p>
                        </div>
                        <div class="card-body">
                            @if(session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Maaf, </strong> {{ session('loginError') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <form action="{{ url('/login_sso') }}" method="POST">
                                @csrf
                                <label>NIP</label>
                                <div class="mb-3">
                                    <input type="text" name="nip" class="form-control" placeholder="NIP" aria-label="Username">
                                    @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <label>Password</label>
                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="text-center mb-3">
                                    <button type="submit" class="btn btn-success w-100 mt-4 mb-0" style="background-color: #10ac84;">{{ __('Login') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <img src="{{ asset('assets/img/auth/auth-image.png')}}" alt="Auth-Image" class="img-fluid" style="height: 100vh; object-fit: cover;">
                </div>
            </div>
        </div>

    </main>
</body>

</html>