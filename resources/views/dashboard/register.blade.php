<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            box-sizing: border-box
        }

        html,
        body {
            margin: 0;
            padding: 0;
            /* padding-left: 300px; */
            background-color: #151515;
        }

        .login {
            padding: 7px 38px;
        }
    </style>

</head>

<body>
    {{-- register page --}}
    <section>
        <div class="container vh-100 d-flex align-items-center">
            <div class="row w-100">
                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-n fa-rotate-by" style="font-size: 11rem; color: #00f; --fa-rotate-angle: 40deg;"></i>
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <div class="w-100" style="max-width: 500px;">
                        <!-- error message -->
                        @if (session('error'))
                            <div class="alert alert-danger mb-3">{{ session('error') }}</div>
                        @endif

                        <!-- success message -->
                        @if (session('success'))
                            <div class="alert alert-success mb-3">{{ session('success') }}</div>
                        @endif

                        <h1 class="px-5 mb-4 text-white">Register</h1>
                        <form action="{{ route('done_register') }}" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <div class="d-flex gap-3" style="width: 130%">
                                    <div>
                                        <label class="text-white mb-1" for="username">Username</label>
                                        <input type="text" name="username" id="username" class="form-control"
                                            placeholder="Masukan Username Kamu">
                                        @error('username')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="text-white mb-1" for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Masukan name Kamu">
                                        @error('name')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="text-white mb-1" for="email">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Masukan Email Kamu">
                                @error('email')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <div class="form-text">
                                    <label for="password" class="text-white">Password</label>
                                    <i  class="fa-solid fa-eye-slash text-white" id="toggle-password" style="cursor: pointer;"></i>
                                </div>
                                <input type="password" class="form-control " id="password" name="password" placeholder="Password">
                                @error('password')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <div class="form-text">
                                    <label for="password_confirmation" class="text-white">Konfirmasi Password</label>
                                    <i class="fa fa-eye-slash text-white" id="toggle-confirm-password" style="cursor: pointer;"></i>
                                </div>
                                <input type="password" class="form-control " id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password">
                                @error('password_confirmation')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary w-50">Register</button>
                            </div>
                        </form>
                        <div class="text-center mt-5">
                            <small class="text-white">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Login</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        document.getElementById('toggle-password').addEventListener('click', function (e) {
            const password = document.getElementById('password');
            if (password.type === 'password') {
                password.type = 'text';
                e.target.classList.remove('fa-eye-slash');
                e.target.classList.add('fa-eye');
            } else {
                password.type = 'password';
                e.target.classList.remove('fa-eye');
                e.target.classList.add('fa-eye-slash');
            }
        });

        document.getElementById('toggle-confirm-password').addEventListener('click', function (e) {
            const confirmPassword = document.getElementById('password_confirmation');
            if (confirmPassword.type === 'password') {
                confirmPassword.type = 'text';
                e.target.classList.remove('fa-eye-slash');
                e.target.classList.add('fa-eye');
            } else {
                confirmPassword.type = 'password';
                e.target.classList.remove('fa-eye');
                e.target.classList.add('fa-eye-slash');
            }
        });
    </script>
</body>

</html>