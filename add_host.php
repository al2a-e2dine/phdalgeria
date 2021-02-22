<?php 
session_start();
include_once 'connect.php';
include "config.php";
include 'function_inc.php';


$pageName="Partager mon hébergement";


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}else{
    $user_id=$_SESSION['user_id'];
}


if(isset($_POST['submit'])){
$wilaya=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['wilaya'])));
$adresse=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['adresse'])));
$map_url=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['map_url'])));
$description=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['description'])));
include 'uploadfile2.php'; //$file_name2
include 'uploadfile3.php'; //$file_name3

$q="INSERT INTO `host`(`user_id`, `wilaya`, `adresse`, `map_url`, `description`, `profile`, `id_card`) VALUES ('$user_id', '$wilaya', '$adresse', '$map_url', '$description', '$file_name2', '$file_name3')";
$r=mysqli_query($dbc,$q);

if ($r) {
    $msg="Le processus d'ajout a réussi";
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

                            <?php 
                            if(isset($_GET['errfile2'])){ ?>
                                <div class="alert alert-warning">
                                  <strong><?= $lang['1'] ?>!</strong> Désolé, seuls les fichiers JPG, JPEG, PNG sont autorisés.
                                </div><br>
                            <?php } ?>
                            
                            <form class="user" action="add_host.php" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                <select class="form-control" name="wilaya">
                                    <?php if($wilaya){ $wilaya_info=getInfoById('algeria_cities',$wilaya); ?>
                                        <option value="<?= $wilaya_info['id'] ?>"><?= $wilaya_info['wilaya_name'] ?></option>
                                    <?php }else{ ?>
                                <option value="">Wilaya</option>
                                <?php } ?>
                                <?php
                                $q="SELECT DISTINCT wilaya_name,id FROM `algeria_cities`";
                                $r=mysqli_query($dbc,$q);
                                while($row=(mysqli_fetch_assoc($r))){ ?>
                                
                                    <option value="<?= $row['id'] ?>"><?= $row['id']."-".$row['wilaya_name'] ?></option>
                                <?php } ?>
                                </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="adresse"
                                        placeholder="Adresse" required>
                                </div>
                                <div class="form-group">
                                    <input type="url" class="form-control form-control-user" name="map_url"
                                        placeholder="Google Map URL" required>
                                </div>
                                <div class="form-group">
                                  <textarea class="form-control" rows="5" name="description" placeholder="Déscription" required></textarea>
                                </div>

                                <label>Photo de profil</label>
                                <div class="custom-file mb-3">
                                 <input type="file" class="custom-file-input" id="uploadFile" name="fileToUpload2" required>
                                 <label class="custom-file-label" for="uploadFile"><?= $lang['29'] ?></label>
                                 </div>

                                 <label>Carte d'identité</label>
                                 <div class="custom-file mb-3">
                                 <input type="file" class="custom-file-input" id="uploadFile" name="fileToUpload3" required>
                                 <label class="custom-file-label" for="uploadFile"><?= $lang['29'] ?></label>
                                 </div>

                                <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Ajouter">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="host.php">PHD Algeria hébergement</a>
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