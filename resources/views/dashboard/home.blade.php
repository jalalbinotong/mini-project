@extends('dashboard.main')

@section('content')
<div class="container-fluid mt-4">
    <div class="row gap-5">
        <!-- Post Section -->
        @foreach ($post as $p)    
            <div class="col-md-6">
                <!-- Example Post -->
                <div class="post-card card mb-3 border-light" onclick="window.location.href='{{ route('detail_post', $p->id) }}'" style="cursor: pointer;">
                    <div class="card-header d-flex justify-content-between border-light">
                        <div class="d-flex align-items-center">
                               
                            <img src="{{ $p->user->foto }}" alt="user" class="rounded-circle me-2" style="width:120px; height: 120px;border-radius: 50%; object-fit: cover;">
                            <div>
                                <strong>{{ $p->user->username }}</strong><br>
                                <small>{{ \Carbon\Carbon::parse($p->created_at)->diffForHumans() }}</small>
                            </div>
                           
                        </div>
                        <button class="btn btn-link text-white p-0"><i class="fa-solid fa-bookmark"></i></button>
                    </div>
                    <div class="card-body">
                        <p>{{ $p->deskripsi }}</p>
                        <div class="img-container">
                            <img src="{{ asset($p->gambar) }}" class="img-fluid custom-post-img " alt="heart">
                        </div>
                    </div>
                    <div class="text-center px-3">
                        <hr>
                    </div>
                    <div class="d-flex gap-4 px-3">
                        <div class="d-flex justify-content-between gap-2">
                            <i class="fa-regular fa-heart mt-1"></i>
                            <p class="mx-auto">1 Likes</p>
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <i class="fa-regular fa-comment mt-1"></i>
                            <p class="mx-auto">0 Comments</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Recommendations Section -->
        <div class="col-md-4">
            <div class="recommendations card border-light">
                <div class="card-body">
                    <h5 class="card-title">Siapa yang harus diikuti</h5>
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/50" alt="user" class="rounded-circle me-2">
                            <div>
                                <strong>imronrev</strong><br>
                                <small>Imron Reviady</small>
                            </div>
                            <button class="btn btn-primary btn-sm ms-auto">Follow</button>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/50" alt="user" class="rounded-circle me-2">
                            <div>
                                <strong>reezyx</strong><br>
                                <small>Rudiantyan Wijaya Pratama</small>
                            </div>
                            <button class="btn btn-primary btn-sm ms-auto">Follow</button>
                        </li>
                    </ul>
                    <hr>
                    <small>
                        <a href="#" class="text-muted">Terms of Service</a> • 
                        <a href="#" class="text-muted">Privacy Policy</a> • 
                        <a href="#" class="text-muted">Cookie Policy</a> • 
                        <a href="#" class="text-muted">Accessibility</a> • 
                        <a href="#" class="text-muted">Ads Info</a> • 
                        <a href="#" class="text-muted">More</a> © 2024 Sosmed
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
