<?php
require_once '../../database/query.php';

use Timekeepers\Database\App;
use Timekeepers\Database\Query;
// session_start();
$db = new App();
$query = new Query();

$data = $query->select('*')->from('users')->get();


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Barang</title>

    <!-- Custom fonts for this template-->
    <?php include_once '../component/head.php' ?>

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
                                    <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col">
                                            <?php
                                            // var_dump($_SESSION);
                                            if (isset($_SESSION['message']) && isset($_SESSION['message_type'])) {
                                                $message = $_SESSION['message'];
                                                $message_type = $_SESSION['message_type'];


                                                unset($_SESSION['message']);
                                                unset($_SESSION['message_type']);


                                                echo '<div class="alert alert-' . $message_type . '">' . $message . '</div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <a href="create.php" class="btn btn-dark">Create data</a>
                                        </div>
                                        
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Users</th>
                                                    <th>Email</th>
                                                    <th>Level</th>
                                                    <th>Action</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Users</th>
                                                    <th>Email</th>
                                                    <th>Level</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php $i = 1 ?>
                                                <?php foreach ($data as $item) : ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $item->name ?></td>
                                                        <td><?= $item->email ?></td>
                                                        <td><?= $item->level ?></td>
                                                        <td>
                                                            <a class="btn btn-warning" href="edit.php?id=<?= $item->id ?>">Edit</a>
                                                            <form action="delete.php" method="POST">
                                                                <button name="id" value="<?= $item->id ?>" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
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

    <?php include_once '../component/foot.php' ?>



</body>

</html>