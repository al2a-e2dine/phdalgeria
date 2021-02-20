<?php 
session_start();
include_once 'connect.php';
include "config.php";
$pageName=$lang['1']; 




include 'function_inc.php';

// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php');
// }

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
    header('Location: index.php?upload');
}

if (isset($_POST['filtrer'])) {
    $domaine=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['domaine'])));
    $filiere=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['filiere'])));
    $wilaya=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['wilaya'])));

    if ($domaine and $filiere and $wilaya) {
        $q2="SELECT * FROM `files` WHERE `domaine`='$domaine' and `filiere`='$filiere' and `wilaya`='$wilaya' and archived=0 and safe='1'";
    }elseif ($domaine and !$filiere and !$wilaya) {
        $q2="SELECT * FROM `files` WHERE `domaine`='$domaine' and archived=0 and safe='1'";
    }elseif ($domaine and $filiere and !$wilaya) {
        $q2="SELECT * FROM `files` WHERE `domaine`='$domaine' and `filiere`='$filiere' and archived=0 and safe='1'";
    }elseif ($domaine and !$filiere and $wilaya) {
        $q2="SELECT * FROM `files` WHERE `domaine`='$domaine' and `wilaya`='$wilaya' and archived=0 and safe='1'";
    }elseif (!$domaine and $filiere and !$wilaya) {
        $q2="SELECT * FROM `files` WHERE `filiere`='$filiere' and archived=0 and safe='1'";
    }elseif (!$domaine and $filiere and $wilaya) {
        $q2="SELECT * FROM `files` WHERE `filiere`='$filiere' and `wilaya`='$wilaya' and archived=0 and safe='1'";
    }elseif (!$domaine and !$filiere and $wilaya) {
        $q2="SELECT * FROM `files` WHERE `wilaya`='wilaya'";
    }else{
        $q2="SELECT * FROM `files` where archived=0 and safe='1'";
    }

    //echo $q2;exit();
    $r2=mysqli_query($dbc,$q2);


    }else{
        $q2="SELECT * FROM `files` where archived=0 and safe='1'";
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

    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">

    <script>
    $(document).ready(function(){
        $("#notification").modal('show');
    });
</script>

</head>

<body id="page-top" class="bg-light">

    <!-- The Modal -->
  <div class="modal fade" id="notification">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">PHD Algeria Team</h4>
          <button type="button" class="close" data-dismiss="modal" onclick = "$('.modal').hide()">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body text-center">
            <!-- <h3>Bienvenue</h3> -->
            <!-- <p>
Nous, en tant qu'équipe de production, veillons au développement du site <br>
Mais nous ne pouvons pas remplir le site avec des leçons dans tous les domaines <br>
Aidez-nous à enrichir le site</p> -->
<h3>مرحبا بك</h3>
<p>
نحن كفريق الإنتاج نسهر على تطوير الموقع <br>
لكن لا يمكننا ملأ الموقع بدروس في جميع المجالات <br>
ساعدنا في إثراء الموقع و أجرك عند الله</p>

            <div class="alert alert-info text-center">
                صدقة العلم نشره
                    </div>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

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

                <div id="carouselExampleSlidesOnly" class="carousel slide mb-3" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="img/banner.jpg" class="d-block w-100" alt="banner">
    </div><!-- 
    <div class="carousel-item">
      <img src="img/privacypolicy.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/privacypolicy.png" class="d-block w-100" alt="...">
    </div> -->
  </div>
</div>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 text-center"><?= $pageName ?></h1>

                    <p class="text-center"><b><?= $lang['1'] ?></b> <?= $lang['2'] ?></p>
                    <div class="alert alert-info text-center">
                        « إنما الصدقات للفقراء والمساكين والعاملين عليها والمؤلفة قلوبهم وفي الرقاب والغارمين وفي سبيل الله وابن السبيل فريضة من الله والله عليم حكيم - التوبة »
                    </div>
                    <hr>
                    
                   <?php
                   include'add_file.php';
                   ?>

                    <br> 

                        <?php 
                            if(isset($_GET['errfile'])){ ?>
                                <div class="alert alert-warning">
                                  <strong><?= $lang['1'] ?>!</strong> <?= $lang['3'] ?>
                                </div><br>
                            <?php } ?>

                            <?php 
                            if(isset($_GET['report'])){ ?>
                                <div class="alert alert-warning">
                                  <strong><?= $lang['1'] ?>!</strong> <?= $lang['97'] ?>
                                </div><br>
                            <?php } ?>

                    <form class="user" action="index.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                <select class="form-control action" name="domaine" id="domaine2">
                                    <?php if($domaine){ $domaine_info=getInfoById('domaine',$domaine); ?>
                                        <option value="<?= $domaine_info['id'] ?>"><?= $domaine_info['domaine'] ?></option>
                                    <?php }else{ ?>
                                <option value=""><?= $lang['4'] ?></option>
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
                                <select class="form-control action" name="filiere" id="filiere2">
                                    <?php if($filiere){ $filiere_info=getInfoById('filiere',$filiere); ?>
                                        <option value="<?= $filiere_info['id'] ?>"><?= $filiere_info['filiere'] ?></option>
                                    <?php }else{ ?>
                                <option value=""><?= $lang['5'] ?></option>
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
                                <option value=""><?= $lang['6'] ?></option>
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
                                <input type="submit" name="filtrer" class="btn btn-primary btn-user btn-block" value="<?= $lang['7'] ?>">
                            </div>
                        </div>
                                
                            </form>
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
                                            <th><?= $lang['9'] ?></th>
                                            <th><?= $lang['10'] ?></th>
                                            <th><?= $lang['11'] ?></th>
                                            <th><?= $lang['12'] ?></th>
                                            <th><?= $lang['96'] ?></th>
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
                                                <a class="btn btn-warning btn-block" href="report.php?fid=<?= $row2['id'] ?>"><?= $lang['96'] ?></a>
                                            </td>
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

<script>
$(document).ready(function(){
 $('.action').change(function(){
  if($(this).val() != '')
  {
   var action = $(this).attr("id");
   var query = $(this).val();
   var result = '';
   if(action == "domaine2")
   {
    result = 'filiere2';
   }
   $.ajax({
    url:"fetch2.php",
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