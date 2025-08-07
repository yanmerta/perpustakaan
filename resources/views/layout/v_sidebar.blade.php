<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <a href="/" class="brand-link">
            <img src="{{ asset('dist/assets/template_admin/demo1/dist/assets/media/SD.png') }}" alt="Logo"
                class="brand-image opacity-75 shadow" style="filter: brightness(10);" />
            <span class="brand-text fw-light">Perpustakaan</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @if (auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a href="/buku" class="nav-link {{ Request::is('buku*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-box-seam-fill"></i>
                            <p>Kelola Buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/peminjaman" class="nav-link {{ Request::is('peminjaman*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-pencil-square"></i>
                            <p>Peminjaman</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/pengembalian" class="nav-link {{ Request::is('pengembalian*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-arrow-return-left"></i>
                            <p>Pengembalian</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/denda" class="nav-link {{ Request::is('denda*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-currency-dollar"></i>
                            <p>Denda</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/anggota" class="nav-link {{ Request::is('anggota*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-people"></i>
                            <p>Kelola Anggota</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/buku-tamu" class="nav-link {{ Request::is('buku-tamu*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-table"></i>
                            <p>Buku Tamu</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/laporan" class="nav-link {{ Request::is('laporan') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-clipboard-fill"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/laporan_tamu" class="nav-link {{ Request::is('laporan_tamu') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-clipboard-fill"></i>
                            <p>Laporan Tamu</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->role == 'kepala_sekolah')
                    <li class="nav-item">
                        <a href="/laporan-kepala" class="nav-link {{ Request::is('laporan-kepala') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-clipboard-fill"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/laporan_tamu-kepala"
                            class="nav-link {{ Request::is('laporan_tamu-kepala') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-clipboard-fill"></i>
                            <p>Laporan Tamu</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->role == 'siswa')
                    <li class="nav-item">
                        <a href="/lihat-buku" class="nav-link {{ Request::is('lihat-buku') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-book"></i>
                            <p>Lihat Buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/lihat-peminjaman"
                            class="nav-link {{ Request::is('lihat-peminjaman') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-clock-history"></i>
                            <p>Lihat Peminjaman</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
