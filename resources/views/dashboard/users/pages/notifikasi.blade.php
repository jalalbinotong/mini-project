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
                <li class="d-flex align-items-center mb-3">
                    <img src="https://via.placeholder.com/50" alt="user" class="rounded-circle me-2">
                    <div class="gap-5">
                        <strong>imronrev</strong>
                        <small>mulai mengikuti anda</small>
                        <img src="https://via.placeholder.com/50" alt="user" class="rounded-circle me-2 text-end">
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection