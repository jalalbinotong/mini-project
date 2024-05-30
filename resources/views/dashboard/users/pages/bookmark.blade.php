@extends('dashboard.users.main')

@section('content')
<div class="container mt-4 mb-4">
    <h4 class="mb-3">All Bookmarks</h4>
    <div class="col-md-6 d-flex gap-5">
        <!-- Example Post -->
        <div class="post-card card mb-3 border-light" style="width: 200px">
            <div class="card-header d-flex justify-content-between border-light">
                <div class="d-flex align-items-center">
                    <img src="https://via.placeholder.com/50" alt="user" class="rounded-circle me-2">
                    <div>
                        <strong>imronrev</strong><br>
                        <small>1 day ago</small>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="img-container">
                        <img src="https://via.placeholder.com/500" alt="Profile Image" class="mb-3 img-fluid" id="createImg" style="object-fit: cover; cursor: pointer;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection