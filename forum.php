<?php
session_start();

include_once 'connect.php';

include "config.php";
$pageName="PHD Algeria Forum";

include 'function_inc.php';

if (isset($_POST['filtrer'])) {
    $domaine=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['domaine'])));
    $filiere=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['filiere'])));

    if ($domaine and $filiere) {
        $q2="SELECT * FROM `post` WHERE `domaine`='$domaine' and `filiere`='$filiere'and archived=0";
    }elseif ($domaine and !$filiere) {
        $q2="SELECT * FROM `post` WHERE `domaine`='$domaine' and archived=0";
    }elseif (!$domaine and $filiere) {
        $q2="SELECT * FROM `post` WHERE `filiere`='$filiere' and archived=0";
    }else{
        $q2="SELECT * FROM `post` where archived=0 order by id desc";
    }

    //echo $q2;exit();
    $r2=mysqli_query($dbc,$q2);


    }else{
        $q2="SELECT * FROM `post` where archived=0 order by id desc";
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
                    <br>
                    <h1 class="h3 mb-2 text-gray-800 text-center"><?= $pageName ?></h1>
                    
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <hr>
                            <a href="add_post.php" class="btn btn-primary btn-block">Publier un sujet</a>
                            <br>
                    <?php } ?>


                    <form class="user" action="forum.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                <select class="form-control action" name="domaine" id="domaine">
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
                            <div class="col-sm-5">
                                <div class="form-group">
                                <select class="form-control action" name="filiere" id="filiere">
                                    <?php if($filiere){ $filiere_info=getInfoById('filiere',$filiere); ?>
                                        <option value="<?= $filiere_info['id'] ?>"><?= $filiere_info['filiere'] ?></option>
                                    <?php }else{ ?>
                                <option value=""><?= $lang['5'] ?></option>
                                     <?php } ?>
                                </select>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <input type="submit" name="filtrer" class="btn btn-primary btn-user btn-block" value="<?= $lang['7'] ?>">
                            </div>
                        </div>
                                
                            </form>
                        <br>
                            

                    <div class="row">
                        <div class="col-sm-8">
                            <h3 class="text-center">Derniers sujets</h3>

                            <?php 
                            if(isset($_GET['post_deleted'])){ ?>
                                <div class="alert alert-success">
                                  <strong><?= $lang['1'] ?>!</strong> Publication supprimé avec succès
                                </div><br>
                            <?php } ?>

                            <?php 
                            //$q2="SELECT * FROM `post` where archived=0 order by id desc";
                            //$r2=mysqli_query($dbc,$q2);
                            while ($row=mysqli_fetch_assoc($r2)) {
                                $userInfo=getInfoById('users',$row['user_id']);
                                $domaineInfo=getInfoById('domaine',$row['domaine']);
                                $filiereInfo=getInfoById('filiere',$row['filiere']);
                                ?>
                            
                             
                            <!-- begin -->
                            <div class="card mb-2">
                              <div class="card-body">
                                <a href="profile.php?id=<?= $userInfo['id'] ?>">
                                <h6 class="card-title" style="color: #2684fe"><?= $userInfo['firstname']." ".$userInfo['lastname'] ?></h6></a>
                                <p><?= $domaineInfo['domaine'] ?> > <?= $filiereInfo['filiere'] ?> - <?= $row['date'] ?></p>
                                <hr>
                                <a href="post.php?id=<?= $row['id'] ?>" class="card-link">
                                <h5 class="card-title" style="color: #ff8b00"><?= $row['title'] ?></h5>
                                </a>
                                <p class="card-text"><?= $row['description'] ?></p>

                                <?php 
                                if($_SESSION['user_id']==$row['user_id']){ ?>
                                 <div class="row">
                                     <div class="col-sm-8">
                                        <a href="<?= $row['file'] ?>" class="btn btn-outline-info btn-block" target="_blank">Télécharger</a>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="update_post.php?id=<?= $row['id'] ?>" class="btn btn-outline-success btn-block">Modifier</a>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="delete_post.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger btn-block">Supprimer</a>
                                    </div>
                                 </div>
                                <?php }else{ ?>
                                    <a href="<?= $row['file'] ?>" class="btn btn-outline-info btn-block" target="_blank">Télécharger</a>
                                <?php } ?>
                                
                              </div>
                            </div>
                            <!-- end -->

                            <?php } ?>
                        </div>

                        <div class="col-sm-4">
                            <h3 class="text-center">Sujets aléatoires</h3>
                            <?php 
                            $q="SELECT * FROM `post` where archived=0 order by rand() limit 5";
                            $r=mysqli_query($dbc,$q);
                            while ($row=mysqli_fetch_assoc($r)) {
                                $userInfo=getInfoById('users',$row['user_id']);
                                $domaineInfo=getInfoById('domaine',$row['domaine']);
                                $filiereInfo=getInfoById('filiere',$row['filiere']);
                                ?>
                            <!-- begin -->
                            <div class="card mb-2">
                              <div class="card-body">
                                <a href="profile.php?id=<?= $userInfo['id'] ?>">
                                <h6 class="card-title" style="color: #2684fe"><?= $userInfo['firstname']." ".$userInfo['lastname'] ?></h6></a>
                                <p><?= $domaineInfo['domaine'] ?> > <?= $filiereInfo['filiere'] ?> - <?= $row['date'] ?></p>
                                <hr>
                                <a href="post.php?id=<?= $row['id'] ?>" class="card-link">
                                <h5 class="card-title" style="color: #ff8b00"><?= $row['title'] ?></h5>
                                </a>
                              </div>
                            </div>
                            <!-- end -->
                            <?php } ?>
                            
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