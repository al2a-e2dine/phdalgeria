<?php 
session_start();
include_once 'connect.php';
include "config.php";
include 'function_inc.php';


$pageName="Modifier un sujet";


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}else{
    $user_id=$_SESSION['user_id'];
}

if (!isset($_GET['id'])) {
    header('Location: forum.php');
}else{
    $p_id=$_GET['id'];
}

$postInfo=getInfoById('post',$p_id);
if ($postInfo['user_id']==$user_id and $postInfo['archived']=0) {
    if(isset($_POST['submit'])){
$title=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['title'])));
$description=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['description'])));
$domaine=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['domaine'])));
$filiere=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['filiere'])));
include 'uploadfile.php';

//echo $file_name; exit();
if ($file_name=="") {
    $q="UPDATE `post` SET `user_id`='$user_id',`domaine`='$domaine',`filiere`='$filiere',`title`='$title',`description`='$description' WHERE `id`='$p_id'";
}else{
    $q="UPDATE `post` SET `user_id`='$user_id',`domaine`='$domaine',`filiere`='$filiere',`title`='$title',`description`='$description',`file`='$file_name' WHERE `id`='$p_id'";
}

//echo $q; exit();
$r=mysqli_query($dbc,$q);

if ($r) {
    $msg="Le processus de modification d'un sujet a réussi";
}else{
    $msg="Il y a une erreur";
}

}
}else{
    header('Location: forum.php');
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

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</head>

<body class="bg-gradient-white">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><?= $pageName ?></h1>
                            </div>

                            <?php 
                            if(isset($msg)){ ?>
                                <div class="alert alert-info">
                                  <strong><?= $lang['1'] ?> !</strong> <?= $msg ?>
                                </div>
                            <?php } ?>
                            
                            <form class="user" action="update_post.php?id=<?= $p_id ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                <select class="form-control action" name="domaine" id="domaine" required>
                                <option value="<?= $postInfo['domaine'] ?>"><?= $lang['4'] ?></option>
                                <?php 
                                    $qd="SELECT * FROM `domaine`";
                                    $rd=mysqli_query($dbc,$qd);
                                    while ($rowd=mysqli_fetch_assoc($rd)) { ?>
                                        <option value="<?= $rowd['id'] ?>"><?= $rowd['domaine'] ?></option>
                                    <?php } ?>
                                </select>
                                </div>

                                <div class="form-group">
                                <select class="form-control action" name="filiere" id="filiere" required>
                                <option value="<?= $postInfo['filiere'] ?>"><?= $lang['5'] ?></option>
                                </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="title"
                                        value="<?= $postInfo['title'] ?>" required>
                                </div>
                                <div class="form-group">
                                  <textarea class="form-control" rows="5" name="description" required>
                                      <?= $postInfo['description'] ?>
                                  </textarea>
                                </div>

                                <div class="custom-file mb-3">
                                 <input type="file" class="custom-file-input" id="uploadFile" name="fileToUpload">
                                 <label class="custom-file-label" for="uploadFile"><?= $lang['29'] ?></label>
                                 </div>

                                <input type="submit" name="submit" class="btn btn-success btn-user btn-block" value="Modifier">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="post.php?id=<?= $p_id ?>">Retour</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="forum.php">PHD Algeria Forum</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="profile.php?id=<?= $user_id ?>"><?= $lang['16'] ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

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