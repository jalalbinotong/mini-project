@extends('dashboard.users.main')

@section('content')
<div class="container mt-4 mb-4">
    <h4 class="mb-3">All Bookmarks</h4>
    <div class="row justify-content-center">
        @foreach ($bookmark as $book)
            <div class="col-md-3">
                <!-- Example Post -->
                <div class="post-card card mb-3 border-light" style="width: 200px">
                    <div class="card-header d-flex justify-content-between border-light">
                        <div class="d-flex align-items-center">
                            <img src="{{ $book->post->user->foto }}" alt="user" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                            <div>
                                <strong>{{ $book->post->user->username }}</strong><br>
                                <small>{{ \Carbon\Carbon::parse($book->created_at)->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="img-container">
                            <img src="{{ asset($book->post->gambar) }}" alt="Profile Image" class="mb-3 img-fluid" style="object-fit: cover; cursor: pointer;">
                        </div>
                        <p>{{ $book->post->deskripsi }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection