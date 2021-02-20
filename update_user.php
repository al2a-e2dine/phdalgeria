<?php 
session_start();
include_once 'connect.php';
include 'function_inc.php';
include "config.php";
$pageName=$lang['78'];



if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}else{
    $user_id=$_SESSION['user_id'];
    $user_info=getInfoById('users', $user_id);
}

if(isset($_POST['submit'])){
$firstname=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['firstname'])));
$lastname=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['lastname'])));
$phone=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['phone'])));

if (isset($_POST['bio'])) {
    $bio=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['bio'])));
}else{
    $bio="";
}

if (isset($_POST['linkedin'])) {
    $linkedin=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['linkedin'])));
}else{
    $linkedin="";
}

if (isset($_POST['twitter'])) {
    $twitter=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['twitter'])));
}else{
    $twitter="";
}

if (isset($_POST['instagram'])) {
    $instagram=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['instagram'])));
}else{
    $instagram="";
}

if (isset($_POST['facebook'])) {
    $facebook=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['facebook'])));
}else{
    $facebook="";
}

$password=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['password'])));
$password=md5($password);

if ($_SESSION['ali_baba']==$password) {
    $q="UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`phone`='$phone',`bio`='$bio',`linkedin`='$linkedin',`twitter`='$twitter',`instagram`='$instagram',`facebook`='$facebook' WHERE `id`='$user_id'";
    $r=mysqli_query($dbc,$q);
    $msg=$lang['79'];
}else{
    $msg=$lang['80'];
}

}

if(isset($_POST['submit2'])){
$old_password=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['old_password'])));
$old_password=md5($old_password);

$password1=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['password1'])));
$password2=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['password2'])));

if ($_SESSION['ali_baba']==$old_password) {
    if ($password1==$password2) {
        $password1=md5($password1);
        $q_pass="UPDATE `users` SET `password`='$password1' WHERE `id`='$user_id'";
        $r_pass=mysqli_query($dbc,$q_pass);
        $msg=$lang['81'];
    }else{
        $msg=$lang['69'];
    }
}else{
    $msg=$lang['82'];
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
                                  <strong><?= $lang['1'] ?>!</strong> <?= $msg ?>
                                </div>
                            <?php } ?>
                            
                            <form class="user" action="update_user.php" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label><?= $lang['71'] ?></label>
                                        <input type="text" class="form-control form-control-user" name="firstname"
                                            value="<?= $user_info['firstname'] ?>" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label><?= $lang['72'] ?></label>
                                        <input type="text" class="form-control form-control-user" name="lastname"
                                            value="<?= $user_info['lastname'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><?= $lang['65'] ?></label>
                                    <input type="number" class="form-control form-control-user" name="phone"
                                        value="<?= $user_info['phone'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label><?= $lang['83'] ?></label>
                                    <input type="text" class="form-control form-control-user" name="bio"
                                        value="<?= $user_info['bio'] ?>">
                                </div>
                                <div class="form-group">
                                    <label><?= $lang['84'] ?></label>
                                    <input type="url" class="form-control form-control-user" name="linkedin"
                                        value="<?= $user_info['linkedin'] ?>">
                                </div>
                                <div class="form-group">
                                    <label><?= $lang['85'] ?></label>
                                    <input type="url" class="form-control form-control-user" name="twitter"
                                        value="<?= $user_info['twitter'] ?>">
                                </div>
                                <div class="form-group">
                                    <label><?= $lang['86'] ?></label>
                                    <input type="url" class="form-control form-control-user" name="instagram"
                                        value="<?= $user_info['instagram'] ?>">
                                </div>
                                <div class="form-group">
                                    <label><?= $lang['87'] ?></label>
                                    <input type="url" class="form-control form-control-user" name="facebook"
                                        value="<?= $user_info['facebook'] ?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="password"
                                        placeholder="<?= $lang['57'] ?>" required>
                                </div>

                                <input type="submit" name="submit" class="btn btn-success btn-user btn-block" value="<?= $lang['88'] ?>">
                            </form>
                            <hr>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><?= $lang['89'] ?></h1>
                            </div>
                            <form class="user" action="update_user.php" method="post">
                                
                                
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="old_password"
                                        placeholder="<?= $lang['90'] ?>" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            name="password1" placeholder="<?= $lang['91'] ?>" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            name="password2" placeholder="<?= $lang['73'] ?>" required>
                                    </div>
                                </div>
                                <input type="submit" name="submit2" class="btn btn-success btn-user btn-block" value="<?= $lang['88'] ?>">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="#" data-toggle="modal" data-target="#deleteuser" class="btn btn-danger btn-block">
                                <?= $lang['92'] ?>
                                </a>

                                <!--  Modal-->
                <div class="modal fade" id="deleteuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?= $lang['92'] ?></h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body"><?= $lang['93'] ?></div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal"><?= $lang['21'] ?></button>
                                <a class="btn btn-danger" href="delete_user.php"><?= $lang['94'] ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="profile.php?id=<?= $user_id ?>"><?= $lang['16'] ?></a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="index.php"><?= $lang['46'] ?></a>
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