<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container-scroller">
        <div class="content-wrapper">
            <div class="container-fluid page-body-wrapper">
                <div class="main-panel">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Apps</h4>
                                @if (session('gagal'))
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ session('gagal') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('hapus'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        {{ session('hapus') }}
                                    </div>
                                @endif
                                <a href="/baru" class="btn btn-info btn-fw">Create New</a>
                                <div class="table-hover">
                                    @if ($apps->isEmpty())
                                        <p>No data available.</p>
                                    @else
                                        <table class="table" id="apps-table">
                                            <thead>
                                                <tr>
                                                    <th>No. Urut</th>
                                                    <th>Nama</th>
                                                    <th>Jenis</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $count = 1;
                                                @endphp
                                                @foreach ($apps as $app)
                                                    <tr
                                                        onclick="window.location.href='/dashboard/{{ $app->id }}';">
                                                        <td
                                                            onclick="window.location.href='/dashboard/{{ $app->id }}';">
                                                            {{ $count++ }}</td>
                                                        <td
                                                            onclick="window.location.href='/dashboard/{{ $app->id }}';"">
                                                            {{ $app->nama_app }}</td>
                                                        <td
                                                            onclick="window.location.href='/dashboard/{{ $app->id }}';"">
                                                            {{ $app->jenis }}</td>
                                                        <td>
                                                            <a href="{{ route('hapus-app', $app->id) }}"
                                                                class="btn btn-danger"
                                                                onclick="return confirm('Yakin ingin menghapus data kriteria?')">Hapus</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer fixed-bottom">
        <!-- Footer code here -->
    </footer>

    <!-- Footer -->

    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
</body>

</html>
