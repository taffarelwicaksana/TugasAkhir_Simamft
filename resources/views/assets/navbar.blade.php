<nav class="navbar navbar-expand navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand fw-medium" href="{{route('dashboard.user')}}">SIMAM FT UNDIP</a>
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="d-flex align-items-center ms-auto">
                <div class="profile-info">
                    <div>
                        @can('access-admin')
                            <div class="fw-bold">{{ $user->admin->nama_admin }}</div>
                            <div class="text-muted">{{$user->role->nama_role }}</div>
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