@extends('dashboard.users.main')

@section('content')
    <div class="container mt-5" style="max-width: 1200px; margin-bottom: 180px">
        <div class="d-flex justify-content-center">
            <form action="{{ route('searching') }}" method="GET" class="d-flex justify-content-between gap-1 w-full">
                <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" style="background-color: #000; color: #fff;" name="search" value="{{ request('search') }}">
                <button style="background-color: #000; border: none" class="btn ms-auto">
                    <i class="fa-solid fa-magnifying-glass fa-xl mt-3 text-white" style="cursor: pointer;"></i>
                </button>
            </form>
        </div>
        <div class="d-flex justify-content-center mt-4" style="gap: 350px">
            <div class="pl-5">
                <ul class="list-unstyled">
                    <li class="d-flex align-items-center mb-3">
                        <div>
                            <strong>Hasil Pencarian mu</strong>
                            @if(request()->has('search'))
                                @forelse ($users as $u)
                                    <div class="d-flex mt-3 gap-3">
                                        @if ($u->foto)
                                            <img src="{{ $u->foto }}" alt="user"  class="rounded-circle me-2" style="width: 80px; height: 80px; object-fit: cover">
                                        @else
                                            <img src="https://via.placeholder.com/80" alt="Profile Image" id="profileImg" class="rounded-circle me-2" style="object-fit: cover; cursor: pointer;">
                                        @endif
                                        <div class="gap-3 justify-content-between">
                                            <strong>{{ $u->username }}</strong><br>
                                            <small>{{ $u->name }}</small>
                                        </div>
                                        @if (auth()->check() && auth()->id() !== $u->id)
                                            @php
                                                $isFollowing = auth()->user()->following()->where('id_follow', $u->id)->exists();
                                            @endphp
                                            <button class="btn btn-sm ms-auto follow-btn {{ $isFollowing ? 'text-danger' : 'text-primary' }}" data-user-id="{{ $u->id }}" style="background-color: #000;">
                                                {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                                            </button>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-secondary mt-4">Tidak ada hasil yang ditemukan untuk "{{ request()->get('search') }}"</p>
                                @endforelse
                            @else
                                <p class="text-secondary mt-4">Silakan masukkan kata kunci pencarian.</p>
                            @endif 
                        </div>
                    </li>
                </ul>
            </div>
        
            <div class="col-md-4">
                <div class="recommendations card mt-3">
                    <div class="card-body">
                        <h5 class="card-title mt-4">Siapa yang harus diikuti</h5>
                        <ul class="list-unstyled">
                            @forelse ($recommendations as $f)
                                <li class="d-flex align-items-center mb-3">
                                    @if ($f->foto)
                                        <img src="{{ $f->foto }}" alt="user" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                                    @else
                                        <img src="https://via.placeholder.com/50" alt="Profile Image" id="profileImg" class="rounded-circle me-2" style="object-fit: cover; cursor: pointer;">
                                    @endif
                                    <div>
                                        <strong>{{ $f->username }}</strong><br>
                                        <small>{{ $f->name }}</small>
                                    </div>
                                    @auth
                                        <button class="btn btn-primary btn-sm ms-auto follow-btn" data-user-id="{{ $f->id }}">Follow</button>
                                    @else
                                        <button class="btn btn-primary btn-sm ms-auto"><a href="{{ route('login') }}" class="text-decoration-none text-white">Follow</a></button>
                                    @endauth
                                </li>
                            @empty
                                <li>Anda telah memfollow semua orang</li>
                            @endforelse
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
    
    <script>
        $('.follow-btn').on('click', function(event) {
            event.preventDefault();
            let userId = $(this).data('user-id');
            let button = $(this);

            $.ajax({
                url: '{{ route('follow.user') }}',
                type: 'POST',
                data: JSON.stringify({ id_follow: userId }),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.isFollowing) {
                        button.text('Unfollow').addClass('bg-danger');
                        button.removeClass('btn-primary').addClass('btn-danger');
                        
                    } else {
                        button.text('Follow').addClass('bg-primary');;
                        button.removeClass('btn-danger').addClass('btn-primary');
                    }
                    location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    </script>
@endsection