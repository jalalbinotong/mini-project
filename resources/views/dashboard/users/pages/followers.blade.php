@extends('dashboard.users.main')

@section('content')
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container-fluid flex-column mt-2">
        <div class="text-center">
            <h3>{{ Auth::user()->username }}</h3>
        </div>
        <div class="navbar-nav gap-3">
            <a class="nav-link" href="{{ route('see_followers', Auth::user()->id) }}">Followers</a>
            <a class="nav-link" href="{{ route('see_followings', Auth::user()->id) }}">Followings</a>
        </div>
    </div>
</nav>

<div class="container mt-5" style="max-width: 1200px; margin-bottom: 180px">
    <div class="d-flex justify-content-center">
        <div class="d-flex justify-content-between align-items-center gap-3">
            <div class="d-flex justify-content-center align-items-center mt-5">
                <form action="{{ route('see_followers' , Auth::user()->id) }}" method="GET" class="d-flex justify-content-between gap-1 w-full">
                    <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" style="background-color: #000; color: #fff;" name="search">
                    <button style="background-color: #000; border: none" class="btn ms-auto">
                        <i class="fa-solid fa-magnifying-glass fa-xl mt-3 text-white" style="cursor: pointer;"></i>
                    </button>
                </form>
            </div>

            <div class="col-md-6">
                <div class="card mt-5" style="background-color: #000; border: none">
                    <div class="card-body">
                        <h5 class="card-title">List All Followers</h5>
                        <ul class="list-unstyled">
                            @if (request()->has('search'))
                                @forelse ($followers as $f)
                                    <li class="d-flex align-items-center mb-3">
                                        <img src="{{ asset($f->foto) }}" alt="user"  class="rounded-circle me-2" style="width: 80px; height: 80px; object-fit: cover">
                                        <div>
                                            <strong>{{ $f->username }}</strong><br>
                                            <small>{{ $f->name }}</small>
                                        </div>
                                    </li>
                                @empty
                                    <p class="text-secondary mt-4">Tidak ada hasil yang ditemukan untuk "{{ request()->get('search') }}"</p>
                                @endforelse
                            @else
                                @forelse ($followers as $f)
                                    <li class="d-flex align-items-center mb-3">
                                        <img src="{{ asset($f->foto) }}" alt="user"  class="rounded-circle me-2" style="width: 80px; height: 80px; object-fit: cover">
                                        <div>
                                            <strong>{{ $f->username }}</strong><br>
                                            <small>{{ $f->name }}</small>
                                        </div>
                                    </li>
                                @empty
                                    <p>tidak ada follower</p>
                                @endforelse
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection