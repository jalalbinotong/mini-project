<div class="sidebar d-flex flex-column p-3">
    <div class="sidebar-title d-flex">
        @auth
            <div class="d-flex justify-content-between border-light mb-3">
                <div class="d-flex align-items-center">
                    
                    @if (Auth::user()->foto)
                        <img src="{{ Auth::user()->foto }}" id="profile-img" alt="user" class="rounded-circle me-2" style="width:80px; height: 90px;border-radius: 50%; object-fit: cover; cursor:pointer">
                    @else
                        <img src="https://via.placeholder.com/80" alt="Profile Image" class="rounded-circle me-2" style="object-fit: cover; cursor: pointer;">
                    @endif
                    <div>
                        <strong id="profile-username" style="cursor: pointer">{{ Auth::user()->username }}</strong><br>
                        <small id="profile-name" style="cursor: pointer">{{ Auth::user()->name }}</small>
                    </div>
                </div>
            </div>
        @else
            <div class="d-flex justify-content-between align-items-center gap-4">
                <i class="fa-solid fa-n fa-rotate-by mb-3" style="--fa-rotate-angle: 40deg; color: #00f; font-size: 2rem;"></i>
                <div class="mb-3">
                    <strong class="mx-auto">Silahkan Login Dahulu</strong>
                    <small>ayo login</small>
                </div>
            </div>
        @endauth
    </div>
    <div class="sidebar-item d-flex">
        <div class="d-flex justify-content-between gap-3">
            <i class="fa-solid fa-house mt-1"></i>
            <a href="/" class="mx-auto">Beranda</a>
        </div>
    </div>
    <div class="sidebar-item d-flex">
        <div class="d-flex justify-content-between gap-3">
            <i class="fa-solid fa-magnifying-glass mt-1"></i>
            <a href="{{ route('searching') }}" class="mx-auto">Explore</a>
        </div>
    </div>
    
    @auth
        <div class="sidebar-item d-flex">
            <div class="d-flex justify-content-between gap-3">
                <i class="fa-solid fa-bell mt-1"></i>
                <a href="{{ route('notif') }}" class="mx-auto">Notifikasi</a>
            </div>
        </div>
        <div class="sidebar-item d-flex">
            <div class="d-flex justify-content-between gap-3">
                <i class="fa-solid fa-plus mt-1"></i>
                <a href="{{ route('create_post') }}" class="mx-auto">Posting</a>
            </div>
        </div>
        <div class="sidebar-item d-flex">
            <div class="d-flex justify-content-between gap-3">
                <i class="fa-solid fa-bookmark mt-1"></i>
                <a href="{{ route('bookmark_post') }}" class="mx-auto">Bookmarks</a>
            </div>
        </div>
        <div class="sidebar-item d-flex">
            <div class="d-flex justify-content-between gap-3">
                <i class="fa-solid fa-arrow-right-from-bracket mt-1"></i>
                <a href="{{ route('logout') }}" class="mx-auto">Logout</a>
            </div>
        </div>
    @else
        <div class="sidebar-item d-flex">
            <div class="d-flex justify-content-between gap-3">
                <i class="fa-solid fa-arrow-left mt-1"></i>
                <a href="{{ route('login') }}" class="mx-auto">Login</a>
            </div>
        </div>
    @endauth
</div>
<script>
    $(document).ready(function() {
        var profileUrl = "/profile"; // Ganti dengan URL halaman profil yang sesuai

        $('#profile-img, #profile-name, #profile-username').on('click', function() {
            window.location.href = profileUrl;
        });
    });
</script>
