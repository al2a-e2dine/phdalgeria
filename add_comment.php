<?php 
session_start();
include_once 'connect.php';
include "config.php";


$pageName="Proposer une solution";


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}else{
    $user_id=$_SESSION['user_id'];
}


if (!isset($_GET['id'])) {
    header('Location: forum.php');
}else{
    $post_id=$_GET['id'];
}

if(isset($_POST['submit'])){
$comment=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['description'])));
include 'uploadfile.php';

$q="INSERT INTO `comment`(`user_id`, `post_id`, `comment`, `file`) VALUES ('$user_id','$post_id','$comment','$file_name')";
$r=mysqli_query($dbc,$q);

if ($r) {
    $msg="Le processus d'ajout d'un commentaire a réussi";
}else{
    $msg="Il y a une erreur";
}

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
                            
                            <form class="user" action="add_comment.php?id=<?= $post_id ?>" method="post" enctype="multipart/form-data">
                                
                                <div class="form-group">
                                  <textarea class="form-control" rows="5" name="description" placeholder="Déscription" required></textarea>
                                </div>

                                <div class="custom-file mb-3">
                                 <input type="file" class="custom-file-input" id="uploadFile" name="fileToUpload" required>
                                 <label class="custom-file-label" for="uploadFile"><?= $lang['29'] ?></label>
                                 </div>

                                <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Ajouter">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="post.php?id=<?= $post_id ?>">Retour</a>
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