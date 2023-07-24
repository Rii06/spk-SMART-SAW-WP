<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href=""><img src="assets/images/logo.png" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href=""><img src="assets/images/logo-mini.svg"
                alt="logo" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <!-- Profile section -->
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Sistem Pendukun Keputusan</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="dashboard">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="kriteria">
                <span class="menu-icon">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                </span>
                <span class="menu-title">Kriteria</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="data">
                <span class="menu-icon">
                    <i class="mdi mdi-database"></i>
                </span>
                <span class="menu-title">Data</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="hitung">
                <span class="menu-icon">
                    <i class="mdi mdi-chart-line"></i>
                </span>
                <span class="menu-title">Hasil</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('end-session') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-logout"></i>
                </span>
                <span class="menu-title">Keluar</span>
            </a>
        </li>
    </ul>
</nav>
