@extends('dashboard.users.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10">
            <div class="d-flex align-items-center mb-4">
                @if (Auth::user()->foto)
                    <img src="{{ Auth::user()->foto }}" alt="Profile Image" class="me-4" style="width:120px; height: 120px;border-radius: 50%; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/120" alt="Profile Image" id="profileImg" class="rounded-circle me-2" style="object-fit: cover; cursor: pointer;">
                @endif
                
                <div>
                    <h3 class="m-0 mb-2">{{ Auth::user()->username }}</h3>
                    <div class="d-flex">
                        <p class="me-3">{{ $post->count() }} Posts</p>
                        <p class="me-3"><a href="{{ route('see_followers', Auth::user()->id) }}" class="text-decoration-none text-white">{{ $followers->count() }} Followers</a></p>
                        <p class="me-3"><a href="{{ route('see_followings', Auth::user()->id) }}" class="text-decoration-none text-white">{{ $following->count() }} Following</a></p>
                    </div>
                    <p>{{ Auth::user()->name }}</p>
                </div>
                
                <div class="ms-auto">
                    <button class="btn btn-link text-white" data-bs-toggle="modal" data-bs-target="#confirmPasswordModal">
                        <i class="fa-solid fa-gear"></i>
                    </button>
                </div>
            </div>
            <p>{{ Auth::user()->bio }}</p>
            <hr class="bg-secondary">
            <div class="d-flex gap-3 mt-5">
                @forelse ($post as $p)
                <!-- Example Post -->
                <div class="post-card d-flex card mb-3 border-light" style="width: 250px">
                    <div class="card-body">
                        <form action="">
                            <div class="img-container">
                                <img src="{{ $p->gambar }}" alt="Profile Image" class="mb-3 img-fluid" id="createImg" width="250px" height="200px" style="object-fit: cover; cursor: pointer;">
                            </div>
                        </form>
                    </div>
                </div>
                @empty
            </div>
            <div class="text-center mt-5">
                <p class="text-secondary">Belum ada postingan yang dapat ditampilkan</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmPasswordModal" tabindex="-1" aria-labelledby="confirmPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color:  #000;">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmPasswordModalLabel">Konfirmasi Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="confirmPasswordForm">
                    <div class="mb-3">
                        <input type="hidden" id="password-auth" value="{{ Auth::user()->password }}">
                        <input type="password" class="form-control" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-success rounded">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#confirmPasswordForm').on('submit', function(event) {

            event.preventDefault();
            var password = $('#password').val();

            const password_auth = document.querySelector('#password-auth');
   
            if (password === password ) {
                window.location.href = '/EditProfile'; // Redirect ke halaman edit profil
            } else {
                alert('Password incorrect');
            }
        });
    });
</script>
@endsection
