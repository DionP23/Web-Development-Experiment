<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Users</title>

    <!-- Custom fonts for this template-->
    <link href="../../assets/sb-admin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/sb-admin2/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include '../component/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../component/nav.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Users</h1>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Users data</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center ">
                                        <div class="col-8">
                                            <form action="store.php" method="POST" enctype="multipart/form-data">
                                                <div class="form-input mb-5">
                                                    <label for="name">Name</label>
                                                    <input placeholder="Input nama barang" type="text" name="name" id="name" class="form-control">
                                                </div>
                                                <div class="form-input mb-5">
                                                    <label for="email">email</label>
                                                    <input type="email" name="email" id="email" class="form-control">
                                                </div>
                                                <div class="form-input mb-5">
                                                    <label for="password">passoword</label>
                                                    <input  type="password" name="password" id="password" class="form-control">
                                                </div>
                                                <div class="form-input mb-5">
                                                    <label for="password">Level</label>
                                                    <select name="level" class="form-control">
                                                        <option value="users">Pilih level</option>
                                                        <option value="users">Users</option>
                                                        <option value="admin">Admin</option>
                                                    </select>
                                                </div>
                                                <div class="form-input mb-5">
                                                    <button type="submit" class="btn btn-dark">Create data</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/sb-admin2/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/sb-admin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/sb-admin2/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/sb-admin2/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../assets/sb-admin2/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../assets/sb-admin2/js/demo/chart-area-demo.js"></script>
    <script src="../../assets/sb-admin2/js/demo/chart-pie-demo.js"></script>

</body>

</html>