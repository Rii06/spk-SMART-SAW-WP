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
                                <h4 class="card-title">Buat baru</h4>
                                <p class="card-description"> </p>
                                <form action="{{ route('apps.store') }}" method="POST" class="forms-sample">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputAppName">Nama aplikasi</label>
                                        <input type="text" class="form-control font-light" id="exampleInputAppName"
                                            placeholder="Nama aplikasi" name="nama_app">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputMethod">Jenis Metode</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis" id="sawMethod"
                                                value="saw">
                                            <label class="form-check-label" for="sawMethod">SAW</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis"
                                                id="smartMethod" value="smart">
                                            <label class="form-check-label" for="smartMethod">SMART</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis" id="wpMethod"
                                                value="wp">
                                            <label class="form-check-label" for="wpMethod">WP</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-dark">Cancel</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer fixed-bottom">
        <div class="card-footer d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                bootstrapdash.com
                2020</span>
        </div>
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
