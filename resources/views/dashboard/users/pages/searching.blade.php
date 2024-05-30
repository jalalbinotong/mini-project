@extends('dashboard.users.main')

@section('content')
    <div class="container mt-5 mb-5" style="max-width: 1200px">
        <div class="d-flex justify-content-center">
            <form id="searchForm" class="d-flex justify-content-between gap-1 w-full">
                <input class="form-control me-2" type="search" id="searchInput" placeholder="Search" aria-label="Search" style="background-color: #000; color: #fff;">
                <i class="fa-solid fa-magnifying-glass fa-xl mt-3" id="searchIcon" style="cursor: pointer;"></i>
            </form>
        </div>
        <div class="d-flex justify-content-center mt-4" style="gap: 350px">
            <div class="pl-5">
                <ul class="list-unstyled">
                    <li class="d-flex align-items-center mb-3">
                        <div>
                            <strong>Hasil Pencarian mu</strong>
                            <div class="d-flex mt-3 gap-3">
                                <img src="https://via.placeholder.com/50" alt="user" class="rounded-circle me-2">
                                <div class="gap-3 justify-content-between">
                                    <strong>imronrev</strong><br>
                                    <small>Imron Reviady</small>
                                </div>
                                <button class="btn btn-primary btn-sm ms-auto">Follow</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        
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

    <script>
        $(document).ready(function() {
            $('#searchIcon').on('click', function() {
                var searchQuery = $('#searchInput').val().trim();
                if (searchQuery) {
                    // Redirect to search results page or perform search action
                    alert("Searching for: " + searchQuery);
                    // Example: window.location.href = '/search?q=' + encodeURIComponent(searchQuery);
                } else {
                    alert("Please enter a search term.");
                }
            });

            // Optional: Allow pressing Enter to trigger the search
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                $('#searchIcon').click();
            });
        });
    </script>
@endsection