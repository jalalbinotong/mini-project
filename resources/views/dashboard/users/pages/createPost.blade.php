@extends('dashboard.main')

@section('content')
<div class="container mt-4 mb-4 d-flex align-items-center justify-content-center">
    <div class="col-md-6">
        <div class="post-card card mb-3 border-light">
            <div class="card-header d-flex justify-content-between border-light">
                <div class="d-flex align-items-center">
                    @if (Auth::user()->foto)
                        <img src="{{ Auth::user()->foto }}" alt="user" class="rounded-circle me-2" style="width:120px; height: 120px;border-radius: 50%; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/50" alt="Profile Image" class="rounded-circle me-2" style="object-fit: cover; cursor: pointer;">
                    @endif
                    <div>
                        <strong>{{ Auth::user()->username }}</strong>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('done_create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control text-white mb-3" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}" style="background-color:  #000;" placeholder="Deskripsi Postingan">
                    <div class="img-container">
                        <img src="https://via.placeholder.com/500x300" alt="Profile Image" class="mb-3 img-fluid" id="createImg" style="object-fit: cover; cursor: pointer;">
                        <input type="file" id="createImageUpload" name="gambar" accept="image/*" style="display: none;">
                    </div>
                    <div class="text-center">
                        <hr>
                    </div>
                    <div class="text-end mb-2">
                        <button class="btn btn-info bordered" type="submit">Posting</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#createImg').click(function() {
            $('#createImageUpload').click();
        });

        $('#createImageUpload').change(function(event) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#createImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(event.target.files[0]);
        });
    });
</script>

@endsection