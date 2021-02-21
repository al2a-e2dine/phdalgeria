<?php
session_start();

include_once 'connect.php';

include "config.php";


include 'function_inc.php';

if (isset($_GET['id'])) {
    $id=$_GET['id'];

    $q="SELECT * FROM `post` where id='$id'";
    $r=mysqli_query($dbc,$q);
    $num=mysqli_num_rows($r);

    if($num==0){
        header('location: forum.php');
    }

}else{
    header('location: forum.php');
}

$postInfo=getInfoById('post',$id);

if ($postInfo['archived']==1) {
    header('location: forum.php');
}

$pageName=$postInfo['title'];

$userInfo=getInfoById('users',$postInfo['user_id']);
$domaineInfo=getInfoById('domaine',$postInfo['domaine']);
$filiereInfo=getInfoById('filiere',$postInfo['filiere']);



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

                <br>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 text-center"><?= $pageName ?></h1>

                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <hr>
                            <a href="add_post.php" class="btn btn-primary btn-block">Publier un sujet</a>
                            <br>
                    <?php } ?>

                    <div class="row">
                        <div class="col-sm">
                            <!-- begin -->
                            <div class="card mb-2">
                              <div class="card-body">
                                <a href="profile.php?id=<?= $userInfo['id'] ?>">
                                <h4 class="card-title" style="color: #2684fe"><?= $userInfo['firstname']." ".$userInfo['lastname'] ?></h4></a>
                                <p><?= $domaineInfo['domaine'] ?> > <?= $filiereInfo['filiere'] ?> - <?= $postInfo['date'] ?></p>
                                <hr>
                                <a href="post.php?id=<?= $postInfo['id'] ?>" class="card-link">
                                <h3 class="card-title" style="color: #ff8b00"><?= $postInfo['title'] ?></h3>
                                </a>
                                <p class="card-text"><?= $postInfo['description'] ?></p>
                                <!-- <a href="<?= $postInfo['file'] ?>" class="btn btn-outline-success btn-block" target="_blank">Télécharger</a> -->

                                <?php 
                                if($_SESSION['user_id']==$postInfo['user_id']){ ?>
                                 <div class="row">
                                     <div class="col-sm-8">
                                        <a href="<?= $postInfo['file'] ?>" class="btn btn-outline-info btn-block" target="_blank">Télécharger</a>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="update_post.php?id=<?= $postInfo['id'] ?>" class="btn btn-outline-success btn-block">Modifier</a>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="delete_post.php?id=<?= $postInfo['id'] ?>" class="btn btn-outline-danger btn-block">Supprimer</a>
                                    </div>
                                 </div>
                                <?php }else{ ?>
                                    <a href="<?= $postInfo['file'] ?>" class="btn btn-outline-info btn-block" target="_blank">Télécharger</a>
                                <?php } ?>
                              </div>
                            </div>
                            <!-- end -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <h3 class="text-center">Commentaires</h3>

                            <?php 
                            if(isset($_GET['comment_deleted'])){ ?>
                                <div class="alert alert-success">
                                  <strong><?= $lang['1'] ?>!</strong> Commentaire supprimé avec succès
                                </div><br>
                            <?php } ?>

                            <?php if (isset($_SESSION['user_id'])) { ?>
                        <hr>
                            <a href="add_comment.php?id=<?= $id ?>" class="btn btn-info btn-block">Proposer une solution</a>
                            <br>
                    <?php } ?>

                            <?php 
                            $q="SELECT * FROM `comment` where post_id='$id' and archived=0 order by id desc";
                            $r=mysqli_query($dbc,$q);
                            while ($row=mysqli_fetch_assoc($r)) {
                                $userInfo=getInfoById('users',$row['user_id']);
                                $postInfo=getInfoById('post',$id);
                                //$domaineInfo=getInfoById('domaine',$row['domaine']);
                                //$filiereInfo=getInfoById('filiere',$row['filiere']);
                                ?>

                            <!-- begin -->
                            <div class="card mb-2">
                              <div class="card-body">

                                <?php 
                                    $q0="SELECT * FROM `reaction` WHERE `post_id`='$id' and reaction=1";
                                    $r0=mysqli_query($dbc,$q0);
                                    $num0=mysqli_num_rows($r0);
                                 ?>

                                <div class="row">
                                    <div class="col-sm-1">
                                        <a href="like.php?id=<?= $id ?>" class="btn btn-success btn-block"><?= $num0 ?> <i class="fas fa-thumbs-up"></i></a>
                                    </div>
                                    <div class="col-sm-11">
                                        <a href="profile.php?id=<?= $userInfo['id'] ?>">
                                        <h4 class="card-title" style="color: #2684fe"><?= $userInfo['firstname']." ".$userInfo['lastname'] ?></h4>
                                        </a>
                                    </div>
                                </div>

                                <?php 
                                    $q0="SELECT * FROM `reaction` WHERE `post_id`='$id' and reaction=2";
                                    $r0=mysqli_query($dbc,$q0);
                                    $num0=mysqli_num_rows($r0);
                                 ?>

                                <div class="row">
                                    <div class="col-sm-1">
                                        <a href="dislike.php?id=<?= $id ?>" class="btn btn-danger btn-block"><?= $num0 ?> <i class="fas fa-thumbs-down"></i></a>
                                    </div>
                                    <div class="col-sm-11">
                                        <p><?= $row['date'] ?></p>
                                    </div>
                                </div>

                                
                                
                                <hr>
                                <p class="card-text"><?= $row['comment'] ?></p>
                                <!-- <a href="<?= $row['file'] ?>" class="btn btn-outline-success btn-block" target="_blank">Télécharger</a> -->

                                <?php 
                                if($_SESSION['user_id']==$row['user_id']){ ?>
                                 <div class="row">
                                     <div class="col-sm-10">
                                        <a href="<?= $row['file'] ?>" class="btn btn-outline-success btn-block" target="_blank">Télécharger</a>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="delete_comment.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger btn-block">Supprimer</a>
                                    </div>
                                 </div>
                                <?php }else{ ?>
                                    <a href="<?= $row['file'] ?>" class="btn btn-outline-success btn-block" target="_blank">Télécharger</a>
                                <?php } ?>
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