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
                    <p class="text-center"><?= $lang['35'] ?></p>
                    <div class="alert alert-info text-center">
                        « إنما الصدقات للفقراء والمساكين والعاملين عليها والمؤلفة قلوبهم وفي الرقاب والغارمين وفي سبيل الله وابن السبيل فريضة من الله والله عليم حكيم - التوبة »
                    </div>
                    <hr>
                    <?php
                        if (isset($_SESSION['user_id'])) { ?>
                            
                    <a class="btn btn-success btn-block mb-2" href="" data-toggle="modal" data-target="#upload"><?= $lang['36'] ?></a><br>

                            <?php 
                            if(isset($msg)){ ?>
                                <div class="alert alert-info">
                                  <strong>PHD Algeria!</strong> <?= $msg ?>
                                </div>
                            <?php } ?>

                <!-- The Modal -->
              <div class="modal fade" id="upload">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title"><?= $lang['36'] ?></h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                      <form class="user" action="feedback.php" method="post">

                                <div class="form-group">
                                  <textarea class="form-control" rows="5" name="feedback" placeholder="<?= $lang['37'] ?>" required></textarea>
                                </div>

                                <input type="submit" name="submit" class="btn btn-success btn-user btn-block" value="<?= $lang['38'] ?>">
                            </form>
                    </div>
                    
                    <!-- Modal footer  -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $lang['21'] ?></button>
                    </div>
                    
                  </div>
                </div>
              </div>

              <?php } ?>

                    <br>

                <?php 
                $q="SELECT * FROM `feedback` WHERE `archived`=0 order by id desc";
                $r=mysqli_query($dbc,$q);
                while ($row=mysqli_fetch_assoc($r)) {
                    $id_user=$row['user_id'];
                    $user_data=getInfoById('users',$id_user);
                    ?>
                    <div class="card mb-2">
                      <div class="card-body">
                        <h4 class="card-title"><?= $user_data['firstname']." ".$user_data['lastname'] ?></h4>
                        <p class="card-text"><?= $row['feedback'] ?></p>
                      </div>
                    </div>
                <?php } ?>
                 
                

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