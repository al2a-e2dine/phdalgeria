<?php
session_start();

include_once 'connect.php';
include 'function_inc.php';
include "config.php";



if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}else{
    $user_id=$_SESSION['user_id'];
}

if (isset($_GET['id'])) {
    $id=$_GET['id'];

    $user_q="SELECT * FROM `users` where id='$id'";
    $user_r=mysqli_query($dbc,$user_q);
    $nbr_user=mysqli_num_rows($user_r);

    if ($nbr_user==0) {
        header('Location: index.php');
    }

}else{
    header('Location: index.php');
}

$user_info=getInfoById('users', $id);

$pageName=$user_info['firstname']." ".$user_info['lastname'];

if (isset($_POST['submit'])) {
    $user_id=$_SESSION['user_id'];
    $domaine=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['domaine'])));
    $filiere=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['filiere'])));
    $wilaya=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['wilaya'])));
    $title=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['title'])));
    $url=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['url'])));
    include 'uploadfile.php';

    if ($url and $file_name) {
        $query="INSERT INTO `files`(`user_id`, `domaine`, `filiere`, `wilaya`, `title`, `url`, `path`) VALUES ('$user_id', '$domaine', '$filiere', '$wilaya', '$title', '$url', '$file_name')";
    }elseif ($url and !$file_name) {
        $query="INSERT INTO `files`(`user_id`, `domaine`, `filiere`, `wilaya`, `title`, `url`) VALUES ('$user_id', '$domaine', '$filiere', '$wilaya', '$title', '$url')";
    }elseif (!$url and $file_name) {
        $query="INSERT INTO `files`(`user_id`, `domaine`, `filiere`, `wilaya`, `title`, `path`) VALUES ('$user_id', '$domaine', '$filiere', '$wilaya', '$title', '$file_name')";
    }

    $result=mysqli_query($dbc,$query);
    header('Location: profile.php?upload');
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

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
<br>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="text-center">
                    <h1 class="h3 mb-2 text-gray-800"><?= $pageName ?></h1>
                    <?php if($user_info['bio']!=""){ ?>
                    <h4><b><?= $lang['64'] ?> : </b><?= $user_info['bio'] ?></h4>
                    <?php } ?>
                    <h4><b><?= $lang['56'] ?> : </b><?= $user_info['email'] ?></h4>
                    <h4><b><?= $lang['65'] ?> : </b></i> <?= $user_info['phone'] ?></h4>
                    <h4>
                        <?php if($user_info['linkedin']!=""){ ?>
                        <a href="<?= $user_info['linkedin'] ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                        <?php } ?>
                        <?php if($user_info['twitter']!=""){ ?>
                        <a href="<?= $user_info['twitter'] ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                        <?php } ?>
                        <?php if($user_info['instagram']!=""){ ?>
                        <a href="<?= $user_info['instagram'] ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                        <?php } ?>
                        <?php if($user_info['facebook']!=""){ ?>
                        <a href="<?= $user_info['facebook'] ?>" target="_blank"><i class="fab fa-facebook"></i></a>
                        <?php } ?>
                    </h4>
                    </div>

                    <hr>
                    
                    <?php
                    if ($user_id==$id) {
                        include('add_file.php');
                    }
                   ?>

                    <br> 

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?= $lang['1'] ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th><?= $lang['8'] ?></th>
                                            <th><?= $lang['66'] ?></th>
                                            <th><?= $lang['9'] ?></th>
                                            <th><?= $lang['11'] ?></th>
                                            <th><?= $lang['12'] ?></th>
                                            <?php if($user_id==$id){ ?>
                                            <th><?= $lang['67'] ?></th>
                                            <?php } ?>
                                            <th><?= $lang['96'] ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //$user_id=$_SESSION['user_id'];
                                        $q2="SELECT * FROM `files` where user_id='$id' and archived=0";
                                        $r2=mysqli_query($dbc,$q2);
                                        while ($row2=mysqli_fetch_assoc($r2)) {
                                            $id_wilaya=$row2['wilaya'];
                                            $id_user=$row2['user_id'];

                                            $wilaya_data=getInfoById('algeria_cities',$id_wilaya);
                                            $user_data=getInfoById('users',$id_user);
                                            ?>
                                            <tr>
                                            <td><?= $row2['title'] ?></td>
                                            <td><?= $wilaya_data['wilaya_name'] ?></td>
                                            <td><?= $row2['date'] ?></td>
                                            <?php if ($row2['url']) { ?>
                                                    <td>
                                                        <a class="btn btn-dark btn-block" href="<?= $row2['url'] ?>" target="_blank"><?= $lang['11'] ?></a>
                                                    </td>
                                            <?php }else{ ?>
                                                <td>
                                                    <button class="btn btn-dark btn-block" href="" disabled><?= $lang['11'] ?></button>
                                                </td>
                                            <?php } ?>

                                            <?php if ($row2['path']) { ?>
                                                    <td>
                                                        <a class="btn btn-success btn-block" href="<?= $row2['path'] ?>" target="_blank"><?= $lang['12'] ?></a>
                                                    </td>
                                            <?php }else{ ?>
                                                <td>
                                                        <button class="btn btn-success btn-block" href="" disabled><?= $lang['12'] ?></button>
                                                    </td>
                                            <?php } ?>

                                            <?php if($user_id==$id){ ?>
                                            <td>
                                                <a class="btn btn-danger btn-block" href="delete_file.php?id=<?= $row2['id'] ?>"><?= $lang['67'] ?></a>
                                            </td>
                                            <?php } ?>
                                            <td>
                                                <a class="btn btn-warning btn-block" href="report.php?fid=<?= $row2['id'] ?>"><?= $lang['96'] ?></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                     
                    <?php if ($_SESSION['user_id']==1) { ?>
                        <h1 class="h3 mb-2 text-gray-800"><?= $lang['105'] ?></h1>
                        <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?= $lang['105'] ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th><?= $lang['8'] ?></th> <!-- titre -->
                                            <th><?= $lang['11'] ?></th> <!-- voir -->
                                            <th><?= $lang['12'] ?></th> <!-- télécharger -->
                                            <th><?= $lang['67'] ?></th> <!-- télécharger -->
                                            <th><?= $lang['106'] ?></th> <!-- approuvée -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q2="SELECT * FROM `files` where safe=0";
                                        $r2=mysqli_query($dbc,$q2);
                                        while ($row2=mysqli_fetch_assoc($r2)) {
                                            //$id_wilaya=$row2['wilaya'];
                                            //$id_user=$row2['user_id'];

                                            //$wilaya_data=getInfoById('algeria_cities',$id_wilaya);
                                            //$user_data=getInfoById('users',$id_user);
                                            ?>
                                            <tr>
                                            <td><?= $row2['title'] ?></td>
                                            <?php if ($row2['url']) { ?>
                                                    <td>
                                                        <a class="btn btn-dark btn-block" href="<?= $row2['url'] ?>" target="_blank"><?= $lang['11'] ?></a>
                                                    </td>
                                            <?php }else{ ?>
                                                <td>
                                                    <button class="btn btn-dark btn-block" href="" disabled><?= $lang['11'] ?></button>
                                                </td>
                                            <?php } ?>

                                            <?php if ($row2['path']) { ?>
                                                    <td>
                                                        <a class="btn btn-success btn-block" href="<?= $row2['path'] ?>" target="_blank"><?= $lang['12'] ?></a>
                                                    </td>
                                            <?php }else{ ?>
                                                <td>
                                                        <button class="btn btn-success btn-block" href="" disabled><?= $lang['12'] ?></button>
                                                    </td>
                                            <?php } ?>

                                            <td>
                                                <a class="btn btn-danger btn-block" href="unsafe_file.php?fid=<?= $row2['id'] ?>"><?= $lang['67'] ?></a>
                                            </td>

                                            <td>
                                                <a class="btn btn-warning btn-block" href="approved.php?fid=<?= $row2['id'] ?>"><?= $lang['106'] ?></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if ($_SESSION['user_id']==1) { ?>
                        <h1 class="h3 mb-2 text-gray-800"><?= $lang['107'] ?></h1>
                        <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?= $lang['107'] ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th><?= $lang['13'] ?></th> <!-- feedback -->
                                            <th><?= $lang['67'] ?></th> <!-- delete -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q2="SELECT * FROM `feedback` where archived=0";
                                        $r2=mysqli_query($dbc,$q2);
                                        while ($row2=mysqli_fetch_assoc($r2)) {
                                            //$id_wilaya=$row2['wilaya'];
                                            //$id_user=$row2['user_id'];

                                            //$wilaya_data=getInfoById('algeria_cities',$id_wilaya);
                                            //$user_data=getInfoById('users',$id_user);
                                            ?>
                                            <tr>
                                            <td><?= $row2['feedback'] ?></td>
                                            <td>
                                                <a class="btn btn-danger btn-block" href="delete_feedback.php?id=<?= $row2['id'] ?>"><?= $lang['67'] ?></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if ($_SESSION['user_id']==1) { ?>
                        <h1 class="h3 mb-2 text-gray-800">Gestion des Hébergement</h1>
                        <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Gestion des Hébergement</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Utilisateur</th> <!-- titre -->
                                            <th>Wilaya</th> <!-- voir -->
                                            <th>Numéro de téléphone</th> <!-- télécharger -->
                                            <th><?= $lang['67'] ?></th> <!-- télécharger -->
                                            <th><?= $lang['106'] ?></th> <!-- approuvée -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q2="SELECT * FROM `files` where safe=0";
                                        $r2=mysqli_query($dbc,$q2);
                                        while ($row2=mysqli_fetch_assoc($r2)) {
                                            //$id_wilaya=$row2['wilaya'];
                                            //$id_user=$row2['user_id'];

                                            //$wilaya_data=getInfoById('algeria_cities',$id_wilaya);
                                            //$user_data=getInfoById('users',$id_user);
                                            ?>
                                            <tr>
                                            <td><?= $row2['title'] ?></td>
                                            <?php if ($row2['url']) { ?>
                                                    <td>
                                                        <a class="btn btn-dark btn-block" href="<?= $row2['url'] ?>" target="_blank"><?= $lang['11'] ?></a>
                                                    </td>
                                            <?php }else{ ?>
                                                <td>
                                                    <button class="btn btn-dark btn-block" href="" disabled><?= $lang['11'] ?></button>
                                                </td>
                                            <?php } ?>

                                            <?php if ($row2['path']) { ?>
                                                    <td>
                                                        <a class="btn btn-success btn-block" href="<?= $row2['path'] ?>" target="_blank"><?= $lang['12'] ?></a>
                                                    </td>
                                            <?php }else{ ?>
                                                <td>
                                                        <button class="btn btn-success btn-block" href="" disabled><?= $lang['12'] ?></button>
                                                    </td>
                                            <?php } ?>

                                            <td>
                                                <a class="btn btn-danger btn-block" href="unsafe_file.php?fid=<?= $row2['id'] ?>"><?= $lang['67'] ?></a>
                                            </td>

                                            <td>
                                                <a class="btn btn-warning btn-block" href="approved.php?fid=<?= $row2['id'] ?>"><?= $lang['106'] ?></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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

<script>
$(document).ready(function(){
 $('.action').change(function(){
  if($(this).val() != '')
  {
   var action = $(this).attr("id");
   var query = $(this).val();
   var result = '';
   if(action == "domaine")
   {
    result = 'filiere';
   }
   $.ajax({
    url:"fetch.php",
    method:"POST",
    data:{action:action, query:query},
    success:function(data){
     $('#'+result).html(data);
    }
   })
  }
 });
});
</script>