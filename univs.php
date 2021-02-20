<?php
session_start();

include_once 'connect.php';

include "config.php";
$pageName="قائمة مواقع الجامعات الجزائرية 48 ولاية";

include 'function_inc.php';

if (isset($_POST['searchbtn'])) {
    $search=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['search'])));

    $q_univ="SELECT * FROM `univ` where name like '%$search%'";
    $r_univ=mysqli_query($dbc,$q_univ);
}else{
    $q_univ="SELECT * FROM `univ`";
    $r_univ=mysqli_query($dbc,$q_univ);
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
                    <hr>

                    <form action="univs.php" method="post">
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group">
                                <input type="text" class="form-control" placeholder="Recherche" name="search" required autofocus="true">
                              </div>
                            </div>
                            <div class="col-sm-2">
                                <input type="submit" name="searchbtn" class="btn btn-success btn-block" value="Recherche">
                            </div>
                        </div>
                    </form>

                    <div class="row mb-3">
                            <?php 
                            
                            while($row_univ=mysqli_fetch_assoc($r_univ)){ ?>
                             
                            

                            <div class="col-md-3">
                              <div class="card mb-4 box-shadow">
                                <a href="<?= $row_univ['url'] ?>" target="_blank">
                              <img class="img-thumbnail img-fluid mx-auto d-block card-img-top" src="univ/univ.jpg" alt="univ">
                              </a>
                                <div class="card-body">
                                  <p class="card-text text-center"><?= $row_univ['id']." - ".$row_univ['name'] ?></p>
                                </div>
                              </div>
                            </div>

                        <?php } ?>

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