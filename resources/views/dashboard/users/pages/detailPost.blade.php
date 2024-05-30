@extends('dashboard.users.main')

@section('content')
<div class="container mt-5 mb-4">
    <div class="row">
        <div class="col-2">
            <a href="/" class="text-white"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="row mt-3 border bordered" style="border-radius: 10px;">
        <div class="col-8">
            <div class="card text-white" style="background-color: #000;">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $post->user->foto }}" alt="User Avatar" class="rounded-circle" style="width:120px; height: 120px;border-radius: 50%; object-fit: cover;">
                        <div class="ms-3">
                            <h3 class="card-title mb-0">{{ $post->user->username }}</h3>
                        </div>
                        <button class="btn btn-primary btn-sm ms-auto">Follow</button>
                    </div>
                    <p class="card-text">{{ $post->deskripsi }}</p>
                    <div class="img-container">
                        <img src="{{ asset($post->gambar) }}" alt="Heart Image" class="img-fluid custom-post-img ">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 mt-5">
            <h5>Komentar</h5>
            @forelse ($post->comments as $comment)
                <div class="comment mb-3" id="comment-{{ $comment->id }}">
                    <div class="d-flex align-items-start">
                        <img src="{{ $comment->user->foto }}" alt="User Avatar" class="rounded-circle" width="40" height="40" style="object-fit: cover">
                        <div class="ms-3">
                            <p class="mb-1"><strong>{{ $comment->user->username }}</strong></p>
                            <p class="mb-1">{{ $comment->comment }}</p>
                            <div class="d-flex align-items-center">
                                <i class="far fa-heart me-2"></i>
                                <span>0 Likes</span>
                                @auth
                                    @if(auth()->id() == $comment->user->id)
                                        <span class="ms-3 comment-actions text-danger delete-comment" data-comment-id="{{ $comment->id }}" style="cursor: pointer">Hapus</span>
                                    @endif
                                    <span class="ms-3 comment-actions reply-btn" data-comment-id="{{ $comment->id }}" style="cursor: pointer;">Reply</span>
                                @endauth
                            </div>
                            <div class="replies mt-3 ms-5">
                                @foreach ($comment->replies as $reply)
                                    <div class="comment mb-3" id="reply-{{ $reply->id }}">
                                        <div class="d-flex justify-content-start">
                                            <img src="{{ $reply->user->foto }}" alt="User Avatar" class="rounded-circle" width="40" height="40" style="object-fit: cover">
                                            <div class="ms-3">
                                                <p class="mb-1"><strong>{{ $reply->user->username }}</strong></p>
                                                <p class="mb-1">{{ $reply->comment }}</p>
                                                <div class="d-flex align-items-center">
                                                    <i class="far fa-heart me-2"></i>
                                                    <span>0 Likes</span>
                                                    @auth
                                                        @if(auth()->id() == $reply->user->id)
                                                            <span class="ms-3 comment-actions text-danger delete-reply" data-reply-id="{{ $reply->id }}" style="cursor: pointer">Hapus</span>
                                                        @endif
                                                    @endauth
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @auth
                                <form action="{{ route('reply', $comment->id) }}" method="POST" class="reply-form d-none mt-2">
                                    @csrf
                                    <input type="text" name="comment" class="form-control text-white " placeholder="Tambahkan balasan" style="background-color: #000;">
                                    <button type="submit" class="btn btn-outline-success btn-send mt-2" >Kirim</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-secondary text-center mt-4">Belum Ada Komentar.</p>
            @endforelse

            @auth
                <form action="{{ route('comment', $post->id) }}" method="POST" class="d-flex mt-3 mb-3">
                    @csrf
                    <input class="form-control me-2 text-white" style="background-color: #000;" type="text" name="comment" placeholder="Tambahkan komentar">
                    <button class="btn btn-outline-success btn-send" type="submit">Kirim</button>
                </form>
            @else
                <p class="mt-5">Silakan <a href="{{ route('login') }}">Login</a> untuk memberikan komentar.</p>
            @endauth
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.reply-btn').click(function() {
            var commentId = $(this).data('comment-id');
            $(this).closest('.comment').find('.reply-form').toggleClass('d-none');
        });

        $('.delete-comment').click(function() {
            var commentId = $(this).data('comment-id');
            var commentElement = $('#comment-' + commentId);

            $.ajax({
                url: '/comments/' + commentId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        commentElement.remove();
                        alert('Berhasil menghapus komentar.');
                    } else {
                        alert('Gagal menghapus komentar.');
                    }
                },
                error: function(response) {
                    alert('Gagal menghapus komentar.');
                }
            });
        });

        $('.delete-reply').click(function() {
            var replyId = $(this).data('reply-id');
            var replyElement = $('#reply-' + replyId);

            $.ajax({
                url: '/replies/' + replyId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        replyElement.remove();
                        alert('Berhasil menghapus balasan.');
                    } else {
                        alert('Gagal menghapus balasan.');
                    }
                },
                error: function(response) {
                    alert('Gagal menghapus balasan.');
                }
            });
        });
    });
</script>
@endsection