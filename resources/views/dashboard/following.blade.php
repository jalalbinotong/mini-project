@extends('dashboard.main')

@section('content')
<div class="container-fluid mt-4">
    <div class="row gap-5">
        <!-- Post Section -->
        @foreach ($posts as $post)    
            <div class="col-md-6">
                <!-- Example Post -->
                <div class="post-card card mb-3 border-light" onclick="window.location.href='{{ route('detail_post', $post->id) }}'" style="cursor: pointer;">
                    <div class="card-header d-flex justify-content-between border-light">
                        <div class="d-flex align-items-center">
                            @if ($post->user->foto)
                                <img src="{{ $post->user->foto }}" alt="user" class="rounded-circle me-2" style="width:120px; height: 120px;border-radius: 50%; object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/120" alt="Profile Image" class="rounded-circle me-2" style="object-fit: cover; cursor: pointer;">
                            @endif
                            
                            <div>
                                <strong>{{ $post->user->username }}</strong><br>
                                <small>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</small>
                            </div>
                        </div>
                        <i class="fa-solid fa-bookmark fa-lg p-0 mt-5 bookmark-btn" data-post-id="{{ $post->id }}" style="color: {{ $post->isBookmarkedByUser() ? 'red' : '#fff' }}; text-decoration: none; cursor: pointer;"></i>
                    </div>
                    <div class="card-body">
                        <p>{{ $post->deskripsi }}</p>
                        <div class="img-container">
                            <img src="{{ asset($post->gambar) }}" class="img-fluid custom-post-img " alt="heart">
                        </div>
                    </div>
                    <div class="text-center px-3">
                        <hr>
                    </div>
                    <div class="d-flex gap-4 px-3">
                        <div class="d-flex justify-content-between gap-2">
                            <i class="fa-solid fa-heart mt-1 like-btn {{ $post->isLikedByUser() ? 'liked' : '' }}" data-post-id="{{ $post->id }}" style="cursor: pointer;"></i>
                            <p class="mx-auto">{{ $post->likes->count() }} Likes</p>
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <i class="fa-regular fa-comment mt-1"></i>
                            <p class="mx-auto">{{ $post->totalComments }} {{ Str::plural('Comment', $post->totalComments) }}</p>
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
                        @forelse ($recommendations as $r)
                            <li class="d-flex align-items-center mb-3">
                                @if ($r->foto)
                                    <img src="{{ $r->foto }}" alt="user" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                                @else
                                    <img src="https://via.placeholder.com/50" alt="Profile Image" class="rounded-circle me-2" style="object-fit: cover; cursor: pointer;">
                                @endif
                                
                                <div>
                                    <strong>{{ $r->username }}</strong><br>
                                    <small>{{ $r->name }}</small>
                                </div>
                                <button class="btn btn-primary btn-sm ms-auto follow-btn" data-user-id="{{ $r->id }}">Follow</button>
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
    $(document).ready(function() {
        $('.like-btn').on('click', function(event) {
            event.stopPropagation();
            let postId = $(this).data('post-id');
            let icon = $(this);

            $.ajax({
                url: '{{ route('like.post') }}',
                type: 'POST',
                data: JSON.stringify({ postLike_id: postId }),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.liked) {
                        icon.addClass('liked');
                        icon.css('color', 'red');
                    } else {
                        icon.removeClass('liked');
                        icon.css('color', '#fff');
                    }
                    location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('.bookmark-btn').on('click', function(event) {
            event.stopPropagation();
            let postId = $(this).data('post-id');
            let icon = $(this);

            $.ajax({
                url: '{{ route('bookmark.post') }}',
                type: 'POST',
                data: JSON.stringify({ postFav_id: postId }),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.bookmarked) {
                        icon.addClass('bookmarked');
                        icon.css('color', 'red');
                    } else {
                        icon.removeClass('bookmarked');
                        icon.css('color', '#fff');
                    }
                    location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
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
    });
</script>
<style>
    .like-btn.liked {
        color: red;
    }

    .bookmark-btn.bookmarked {
        color: red;
    }
</style>
@endsection