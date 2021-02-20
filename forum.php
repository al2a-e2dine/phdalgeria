<?php
session_start();

include_once 'connect.php';

include "config.php";
$pageName=$lang['13'];

include 'function_inc.php';

// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php');
// }

if (isset($_POST['submit'])) {
    $user_id=$_SESSION['user_id'];
    $feedback = mysqli_real_escape_string($dbc, htmlentities(trim($_POST['feedback'])));

    $query="INSERT INTO `feedback`(`user_id`, `feedback`) VALUES ('$user_id','$feedback')";
    $result=mysqli_query($dbc,$query);
    $msg=$lang['34'];
}


 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $pageName ?></title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
            //include 'sidebar.html';
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php
                    include 'topbar.html';
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 text-center"><?= $pageName ?></h1>

                    <div class="row">
                        <div class="col-sm-8">
                            <h3 class="text-center">Derniers sujets</h3>
                            <!-- begin -->
                            <div class="card mb-2">
                              <div class="card-body">
                                <h4 class="card-title" style="color: #2684fe">zamch</h4>
                                <p style="color: #ffc300">MI > Informatique - 16/02/2021 10:25:12</p>
                                <hr>
                                <a href="post.php?1" class="card-link">
                                <h3 class="card-title" style="color: #ff8b00">Lorem ipsum dolor sit amet</h3>
                                </a>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <a href="" class="btn btn-outline-primary btn-block" target="_blank">Voir</a>
                              </div>
                            </div>
                            <!-- end -->
                        </div>

                        <div class="col-sm-4">
                            <h3 class="text-center">Sujets aléatoires</h3>
                            <!-- begin -->
                            <div class="card mb-2">
                              <div class="card-body">
                                <h4 class="card-title" style="color: #2684fe">zamch</h4>
                                <p style="color: #ffc300">MI > Informatique - 16/02/2021 10:25:12</p>
                                <hr>
                                <h3 class="card-title">Lorem ipsum dolor sit amet</h3>
                              </div>
                            </div>
                            <!-- end -->
                            <!-- begin -->
                            <div class="card mb-2">
                              <div class="card-body">
                                <h4 class="card-title" style="color: #2684fe">zamch</h4>
                                <p style="color: #ffc300">MI > Informatique - 16/02/2021 10:25:12</p>
                                <hr>
                                <h3 class="card-title">Lorem ipsum dolor sit amet</h3>
                              </div>
                            </div>
                            <!-- end -->
                            <!-- begin -->
                            <div class="card mb-2">
                              <div class="card-body">
                                <h4 class="card-title" style="color: #2684fe">zamch</h4>
                                <p style="color: #ffc300">MI > Informatique - 16/02/2021 10:25:12</p>
                                <hr>
                                <h3 class="card-title">Lorem ipsum dolor sit amet</h3>
                              </div>
                            </div>
                            <!-- end -->
                        </div>
                    </div>
                    
                 
                

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php
                    include 'footer.html';
                ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>