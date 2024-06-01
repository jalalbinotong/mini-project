@extends('dashboard.users.main')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container-fluid flex-column mt-2">
            <div class="text-center">
                <h3>Notifikasi</h3>
            </div>
            <div class="navbar-nav gap-3">
                <a class="nav-link" href="#">Semua</a>
                <a class="nav-link" href="#">Komentar</a>
                <a class="nav-link" href="#">Disukai</a>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 100px; padding-left: 130px">
        <strong>Semua Notifikasi</strong>
        <div class="d-flex justify-content-between align-items-center">
            <ul class="list-unstyled">
                @forelse ($like as $f)    
                    <li class="d-flex align-items-center mb-3">
                        {{-- <img src="https://via.placeholder.com/50" alt="user" class="rounded-circle me-2"> --}}
                        @if ($f->post->user->foto)
                            <img src="{{ $f->post->user->foto }}" alt="user" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                        @else
                            <img src="https://via.placeholder.com/50" alt="Profile Image" class="rounded-circle me-2" style="object-fit: cover; cursor: pointer;">
                        @endif
                        
                        <div class="gap-5">
                            <strong>{{ $f->post->user->username }}</strong>
                            <small>menyukai postingan anda</small>
                            {{-- <img src="https://via.placeholder.com/50" alt="user" class="rounded-circle me-2 text-end"> --}}
                        </div>
                    </li>
                @empty
                    <p>gak ada Notifikasi</p>
                @endforelse   
                  
            </ul>
        </div>
    </div>
@endsection