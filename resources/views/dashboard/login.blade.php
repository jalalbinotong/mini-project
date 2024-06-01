<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
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
        /* .container {
            padding-left: 200px;
        } */
        .login {
            padding: 7px 38px;
        }
    </style>
</head>
<body>
    <section>
        <div class="container vh-100 w-auto d-flex align-items-center">
            <div class="col-md-3 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-n fa-rotate-by" style="font-size: 8rem; color: #00f; --fa-rotate-angle: 40deg;"></i>
            </div>
            <div class="row w-100">
                <div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <div class="w-100" style="max-width: 500px;">
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <!-- success message -->
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <h1 class="px-5 mb-4 text-white">Login</h1>
                            <form action="{{ route('done_login') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="text-white mb-1" for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Masukan Username Kamu" required>
                                    @error('username')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="text-white mb-1" for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Masukan Password Kamu" required>
                                    @error('password')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-light w-50">Login</button>
                                </div>
                            </form>
                            <div class="text-center mt-5">
                                <small class="text-white">Belum punya akun? <a href="{{ route('register') }}" class="text-primary">Register</a></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>