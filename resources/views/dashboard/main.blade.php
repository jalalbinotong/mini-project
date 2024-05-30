<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amandemy Social Media</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    @include('dashboard.layout.navbar')

    <main class="content flex-grow-1 mt-4 px-3" style="background-color:  #000; min-height:88vh;">
        @include('dashboard.layout.sidebar')
        
        @yield('content')
        @include('dashboard.layout.footer')
    </main>
    @guest    
        <div class="bg-info" style="position:fixed; bottom:0; width:100%; height:100px;">
            <div class="container">
                <div class="d-flex justify-content-around align-items-center">
                    <div class="mt-4" style="margin-left: -200px">
                        <strong class="fs-5 text-white">Jangan ketinggalan berita terbaru</strong>
                        <p class="text-white">Login, untuk pengalaman terbaru</p>
                    </div>
                    <div>
                        <button class="btn btn-info border bordered">
                            <a href="{{ route('login') }}" class="text-decoration-none text-white">Login</a>
                        </button>
                        <button class="btn btn-light bordered">
                            <a href="{{ route('register') }}" class="text-decoration-none text-dark">Register</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endguest

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>