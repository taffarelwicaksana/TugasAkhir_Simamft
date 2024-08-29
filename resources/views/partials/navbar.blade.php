<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand fw-medium" href="{{route('dashboard.user')}}">SIMAM FT UNDIP</a>
        <!-- Sidebar Toggle Icon Button -->
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Profile Section -->
            <div class="d-flex align-items-center ms-auto">
                <div class="profile-info">
                    <img src="https://via.placeholder.com/40" alt="Profile Photo">
                    <div>
                        @can('access-admin')
                            <div class="fw-bold">{{ Auth::user()->admin->nama }}</div>
                            <div class="text-muted">{{ Auth::user()->role->nama_role }}</div>
                        @endcan

                        @can('access-user')
                            <div class="fw-bold">{{ $siswa->nama }}</div>
                            <div class="text-muted">{{ $siswa->user->role->nama_role }}</div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>