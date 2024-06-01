@extends('dashboard.users.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="text-center mb-4">
                    @if ($users->foto)
                        <img src="{{ $users->foto }}" alt="Profile Image" class="mb-3 border" name="foto" id="profileImg" style="width:120px; height:120px; border-radius: 50%; object-fit: cover; cursor: pointer;">
                    @else
                        <img src="https://via.placeholder.com/120" alt="Profile Image" id="profileImg" class="rounded-circle me-2" style="object-fit: cover; cursor: pointer;">
                    @endif
                    <input type="file" id="profileImageUpload" name="foto" accept="image/*" style="display: none;">
                    <h3>Edit Profile</h3>
                </div>
                    <div class="mb-3 row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control text-white" id="username" name="username" value="{{ old('username', Auth::user()->username) }}" style="background-color:  #000;">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control text-white" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" style="background-color:  #000;">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="bio" class="col-sm-3 col-form-label">Bio</label>
                        <div class="col-sm-9">
                            <textarea class="form-control text-white" id="bio" name="bio" rows="4"  value="{{ old('bio', $users->bio) }}" style="background-color:  #000;"></textarea>
                        </div>
                    </div>
                    <div class="text-end mb-4">
                        <button type="submit" class="btn btn-primary w-25">Edit</button>
                    </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#profileImg').click(function() {
            $('#profileImageUpload').click();
        });

        $('#profileImageUpload').change(function(event) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#profileImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(event.target.files[0]);
        });
    });
</script>
@endsection