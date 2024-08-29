<div class="sidebar" id="sidebar">
    <br>
    <br>
    <div class="sidebar-links">
        @can('access-admin')
        <a href="{{ route('dashboard.admin') }}"
            class="{{ request()->routeIs('dashboard.admin') ? 'active-link' : '' }}">
            Dashboard
        </a>
        @endcan
        @can('access-user')
        <a href="{{ route('dashboard.user') }}"
            class="{{ request()->routeIs('dashboard.user') ? 'active-link' : '' }}">
            Dashboard
        </a>
        @endcan
        @can('access-admin')
        <a href="#">
            IPK Mahasiswa
        </a>
        @endcan
        @can('access-user')
        <a href="{{ route('siswa.ipk') }}"
            class="{{ request()->routeIs('siswa.ipk') ? 'active-link' : '' }}">
            IPK Mahasiswa
        </a>
        @endcan
        @can('access-admin')
        <a href="#">
            IPK Mahasiswa
        </a>
        @endcan
        @can('access-user')
        <a href="{{ route('siswa.prodi') }}"
            class="{{ request()->routeIs('siswa.prodi') ? 'active-link' : '' }}">
            IPK Program Studi
        </a>
        @endcan
        </a>
        <a href="#">
            IPK Angkatan
        </a>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </button>
</div>