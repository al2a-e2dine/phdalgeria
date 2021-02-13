<?php 
$pageName="PHD Algeria";
include_once 'connect.php';
session_start();



include 'function_inc.php';

// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php');
// }

if (isset($_POST['submit'])) {
    $user_id=$_SESSION['user_id'];
    $domaine=$_POST['domaine'];
    $filiere=$_POST['filiere'];
    $wilaya=$_POST['wilaya'];
    $title=$_POST['title'];
    $url=$_POST['url'];
    include 'uploadfile.php';

    if ($url and $file_name) {
        $query="INSERT INTO `files`(`user_id`, `domaine`, `filiere`, `wilaya`, `title`, `url`, `path`) VALUES ('$user_id', '$domaine', '$filiere', '$wilaya', '$title', '$url', '$file_name')";
    }elseif ($url and !$file_name) {
        $query="INSERT INTO `files`(`user_id`, `domaine`, `filiere`, `wilaya`, `title`, `url`) VALUES ('$user_id', '$domaine', '$filiere', '$wilaya', '$title', '$url')";
    }elseif (!$url and $file_name) {
        $query="INSERT INTO `files`(`user_id`, `domaine`, `filiere`, `wilaya`, `title`, `path`) VALUES ('$user_id', '$domaine', '$filiere', '$wilaya', '$title', '$file_name')";
    }

    $result=mysqli_query($dbc,$query);
    header('Location: index.php?upload');
}

if (isset($_POST['filtrer'])) {
    $domaine=$_POST['domaine'];
    $filiere=$_POST['filiere'];
    $wilaya=$_POST['wilaya'];

    if ($domaine and $filiere and $wilaya) {
        $q2="SELECT * FROM `files` WHERE `domaine`='$domaine' and `filiere`='$filiere' and `wilaya`='$wilaya' and archived=0";
    }elseif ($domaine and !$filiere and !$wilaya) {
        $q2="SELECT * FROM `files` WHERE `domaine`='$domaine' and archived=0";
    }elseif ($domaine and $filiere and !$wilaya) {
        $q2="SELECT * FROM `files` WHERE `domaine`='$domaine' and `filiere`='$filiere' and archived=0";
    }elseif ($domaine and !$filiere and $wilaya) {
        $q2="SELECT * FROM `files` WHERE `domaine`='$domaine' and `wilaya`='$wilaya' and archived=0";
    }elseif (!$domaine and $filiere and !$wilaya) {
        $q2="SELECT * FROM `files` WHERE `filiere`='$filiere' and archived=0";
    }elseif (!$domaine and $filiere and $wilaya) {
        $q2="SELECT * FROM `files` WHERE `filiere`='$filiere' and `wilaya`='$wilaya' and archived=0";
    }elseif (!$domaine and !$filiere and $wilaya) {
        $q2="SELECT * FROM `files` WHERE `wilaya`='wilaya'";
    }else{
        $q2="SELECT * FROM `files` where archived=0";
    }

    //echo $q2;exit();
    $r2=mysqli_query($dbc,$q2);


    }else{
        $q2="SELECT * FROM `files` where archived=0";
        $r2=mysqli_query($dbc,$q2);
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

                

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 text-center"><?= $pageName ?></h1>
                    <p class="text-center"><b>PHD Algeria</b> est un site éducatif dont l'objectif de fournir toutes les leçons et synthèses dont l'ingénieur algérien a besoin pour les différentes universités pour préparer le concours de doctorat</p>
                    <div class="alert alert-info text-center">
                        « إنما الصدقات للفقراء والمساكين والعاملين عليها والمؤلفة قلوبهم وفي الرقاب والغارمين وفي سبيل الله وابن السبيل فريضة من الله والله عليم حكيم - التوبة »
                    </div>
                    <hr>
                    
                   <?php
                   include('add_file.php');
                   ?>

                    <br> 

                    <form class="user" action="index.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                <select class="form-control action" name="domaine" id="domaine">
                                    <?php if($domaine){ $domaine_info=getInfoById('domaine',$domaine); ?>
                                        <option value="<?= $domaine_info['id'] ?>"><?= $domaine_info['domaine'] ?></option>
                                    <?php }else{ ?>
                                <option value="">Choisir un domaine</option>
                                <?php } ?>
                                <?php 
                                    $qd="SELECT * FROM `domaine`";
                                    $rd=mysqli_query($dbc,$qd);
                                    while ($rowd=mysqli_fetch_assoc($rd)) { ?>
                                        <option value="<?= $rowd['id'] ?>"><?= $rowd['domaine'] ?></option>
                                    <?php } ?>
                                </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                <select class="form-control action" name="filiere" id="filiere">
                                    <?php if($filiere){ $filiere_info=getInfoById('filiere',$filiere); ?>
                                        <option value="<?= $filiere_info['id'] ?>"><?= $filiere_info['filiere'] ?></option>
                                    <?php }else{ ?>
                                <option value="">Choisir la filière</option>
                                     <?php } ?>
                                </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                <select class="form-control" name="wilaya">
                                    <?php if($wilaya){ $wilaya_info=getInfoById('algeria_cities',$wilaya); ?>
                                        <option value="<?= $wilaya_info['id'] ?>"><?= $wilaya_info['wilaya_name'] ?></option>
                                    <?php }else{ ?>
                                <option value="">Ce fichier est pour la wilaya</option>
                                <?php } ?>
                                <?php
                                $q="SELECT DISTINCT wilaya_name,id FROM `algeria_cities`";
                                $r=mysqli_query($dbc,$q);
                                while($row=(mysqli_fetch_assoc($r))){ ?>
                                
                                    <option value="<?= $row['id'] ?>"><?= $row['id']."-".$row['wilaya_name'] ?></option>
                                <?php } ?>
                                </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <input type="submit" name="filtrer" class="btn btn-primary btn-user btn-block" value="Filtrer">
                            </div>
                        </div>
                                
                            </form>
                        <br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">PHD Algeria</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Titre</th>
                                            <th>Date</th>
                                            <th>Par</th>
                                            <th>Voir</th>
                                            <th>Télécharger</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        while ($row2=mysqli_fetch_assoc($r2)) {
                                            $id_wilaya=$row2['wilaya'];
                                            $id_user=$row2['user_id'];

                                            $wilaya_data=getInfoById('algeria_cities',$id_wilaya);
                                            $user_data=getInfoById('users',$id_user);
                                            ?>
                                            <tr>
                                            <td><?= $row2['title'] ?></td>
                                            <td><?= $row2['date'] ?></td>
                                            <td>
                                                <a href="profile.php?id=<?= $id_user ?>">
                                                <?= $user_data['firstname']." ".$user_data['lastname'] ?>
                                                </a>
                                            </td>
                                            <?php if ($row2['url']) { ?>
                                                    <td>
                                                        <a class="btn btn-dark btn-block" href="<?= $row2['url'] ?>" target="_blank">Voir</a>
                                                    </td>
                                            <?php }else{ ?>
                                                <td>
                                                    <button class="btn btn-dark btn-block" href="" disabled>Voir</button>
                                                </td>
                                            <?php } ?>

                                            <?php if ($row2['path']) { ?>
                                                    <td>
                                                        <a class="btn btn-success btn-block" href="<?= $row2['path'] ?>" target="_blank">Télécharger</a>
                                                    </td>
                                            <?php }else{ ?>
                                                <td>
                                                        <button class="btn btn-success btn-block" href="" disabled>Télécharger</button>
                                                    </td>
                                            <?php } ?>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
    <!-- <script src="js/demo/datatables-demo.js"></script> -->

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